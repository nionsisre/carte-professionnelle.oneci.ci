<?php

namespace App\Http\Services;

use App\Helpers\GeneratedTokensOrIDs;
use App\Models\AbonnesPreIdentifie;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class NGSerAPI {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Get NGSER API payment link method<br/><br/>
     * <b>array</b> getPaymentLinkCinetPayAPI(<b>object</b> $customer_informations, <b>string</b> $payment_type='', <b>bool</b> $iframe_view_enabled=false)<br/>
     * @param object $customer_informations <p>Client Request object.</p>
     * @param string $payment_type <p>Client Request object.</p>
     * @param bool $iframe_view_enabled <p>Client Request object.</p>
     * @return array Value of result
     */
    public function getPaymentLink($customer_informations, $payment_type='', $price=1000, $iframe_view_enabled=false) {
        $client = new Client();
        try {
            //$transaction_id = date('Y', time()). (new GeneratedTokensOrIDs())->generateUniqueNumberID('transaction_id');
            //$transaction_id = $customer_informations->numero_dossier.env('NGSER_SERVICE_SALT').$customer_informations->numero_de_telephone;
            $transaction_id = $customer_informations->numero_dossier.env('NGSER_SERVICE_SALT').$customer_informations->numero_de_telephone.env('NGSER_SERVICE_SALT').date('Y', time()).(new GeneratedTokensOrIDs())->generateUniqueNumberID('transaction_id');

            $response = $client->post(env('NGSER_RECETTE_URL').'/v3/sessions', [
                'verify' => false,
                'headers' => [
                    'Content-type' => 'application/json',
                    'Cache-Control' => 'no-cache'
                ],
                'json' => [
                    "name" => env("NGSER_NAME"),
                    "authentication_token" => env('NGSER_AUTHENTICATION_TOKEN'),
                    "order" => $transaction_id,
                    "currency" => env('NGSER_CURRENCY'),
                    "transaction_amount" => intval($price),
                    "operation_token" => env('NGSER_OPERATION_TOKEN')
                ]
            ]);
            $ngser_api_result = json_decode($response->getBody()->getContents(),true);
            /* Response check up */
            if(!empty($ngser_api_result['payment_token'])){
                if($iframe_view_enabled) {
                    return [
                        'has_error' => false,
                        'message' => $ngser_api_result['payment_url'],
                        'data' => $ngser_api_result,
                        'transaction_id' => $transaction_id,
                        'payment_type' => $payment_type
                    ];
                } else {
                    return [
                        'has_error' => false,
                        'message' => '<a id="payment-link" target="_blank" href="'.$ngser_api_result['payment_url'].'" class="button payment-link" style="margin-bottom: 0"><i class="fa fa-sack-dollar text-white"></i> &nbsp; Procéder au paiement...</a>',
                        'data' => $ngser_api_result,
                        'transaction_id' => $transaction_id,
                        'payment_type' => $payment_type
                    ];
                }
            } else {
                return [
                    'has_error' => true,
                    'message' => 'Payment failed'
                ];
            }
        } catch (GuzzleException $guzzle_exception) {
            /* Moving here if something is wrong with CinetPay API */
            return [
                'has_error' => true,
                'message' => 'NGSer API client exception : ['
                    .$guzzle_exception->getMessage()
                    .' -- Code : '.$guzzle_exception->getCode().']'
            ];
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * NGSER transaction ID Verification (works in "Staging" and "Production" only, not "Local" environment)<br/><br/>
     * <b>array</b> verify(<b>Request</b> $request)<br/>
     * @param String $transaction_id <p>Transaction ID.</p>
     * @return array Value of result
     */
    public function verify($transaction_id, $payment_type="") {

        // Retrouver le type de paiement, le numéro de dossier et le numéro de téléphone à actualiser à partir du numéro de transaction
        if($payment_type == env('PAYMENT_TYPE') || strpos($transaction_id, env("NGSER_SERVICE_SALT"))) {
            $payment_type = env('PAYMENT_TYPE');
        }

        /*
            NGSer getting authentication token
        */
        $client = new Client();
        try {
            $response_token = $client->post(env('NGSER_RECETTE_URL').'/service/auth', [
                'verify' => false,
                'headers' => [
                    'Content-type' => 'application/json',
                    'Cache-Control' => 'no-cache'
                ],
                'json' => [
                    "auth" => [
                        "name" => env('NGSER_NAME'),
                        "authentication_token" => env('NGSER_AUTHENTICATION_TOKEN'),
                        "order" => $transaction_id
                    ]
                ]
            ]);
            $response_token = json_decode($response_token->getBody()->getContents(),true);
            if(!empty($response_token["auth_token"])) {
                /*
                    NGSer transaction Status Verification
                */
                try {
                    $response = $client->request('POST', env('NGSER_RECETTE_URL').'/check_payment_status/'.$transaction_id, [
                        'verify' => false,
                        'headers' => [
                            'Authorization' => 'Bearer '.$response_token["auth_token"],
                            'Content-type' => 'application/json',
                            'Cache-Control' => 'no-cache'
                        ]
                    ]);
                    $ngser_api_result = json_decode($response->getBody(), true);
                    /* Response check up */
                    if ($ngser_api_result['code'] == "1") {
                        return [
                            'has_error' => false,
                            'message' => 'Payment done !',
                            'data' => $ngser_api_result,
                            'transaction_id' => $transaction_id,
                            'payment_type' => $payment_type
                        ];
                    } else {
                        return [
                            'has_error' => true,
                            'message' => 'Payment failed',
                            'data' => $ngser_api_result,
                            'transaction_id' => $transaction_id,
                            'payment_type' => $payment_type
                        ];
                    }
                } catch (GuzzleException $ge) {
                    /* Moving here if something is wrong with NGSer API */
                    return [
                        'has_error' => true,
                        'message' => 'NGSer API client exception : ['
                            .$ge->getMessage()
                            .' -- Code : '.$ge->getCode().']'
                    ];
                }
            }
        } catch (GuzzleException $guzzle_exception) {
            /* Moving here if something is wrong with NGSer API */
            return [
                'has_error' => true,
                'message' => 'NGSer API client token exception : ['
                    .$guzzle_exception->getMessage()
                    .' -- Code : '.$guzzle_exception->getCode().']'
            ];
        }

    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Notification de Paiement par l'API NGSER<br/><br/>
     * <b>RedirectResponse</b> notify(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function notify(Request $request) {
        /*
           NGSER envoie une requête POST vers cette methode après chaque paiement effectué censé mettre à jour
           le statut au cas où le navigateur du client s'est déconnecté avant la synchronisation du statut lors de
           son paiement ou en cas de reclamation de paiement non synchronisé
        */
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', 'string', 'max:100'], // Numéro de transaction (Numéro de dossier + sel + Numéro de téléphone)
            'status_id' => ['nullable', 'string', 'max:100'], // Code de Statut de la transaction (1 pour success)
            'transaction_id' => ['nullable', 'string', 'max:100'], // Référence de paiement de l'opérateur télécom
            'transaction_amount' => ['nullable', 'string', 'max:100'], // Cout de la transaction
            'currency' => ['nullable', 'string', 'max:100'], // Devise de la transaction
            'paid_transaction_amount' => ['nullable', 'string', 'max:100'], // Montant actuellement payé pour la transaction
            'paid_currency' => ['nullable', 'string', 'max:100'], // Devise d'achat
            'change_rate' => ['nullable', 'string', 'max:100'], // Taux de change
            'conflictual_transaction_amount' => ['nullable', 'string', 'max:100'], // Montant en cas de transaction conflictuelle
            'conflictual_currency' => ['nullable', 'string', 'max:100'], // Devise en cas de transaction conflictuelle
            'wallet' => ['nullable', 'string', 'max:100'], // Mode de paiement
            'wallet_' => ['nullable', 'string', 'max:100'], // Mode de paiement avec underscore pour les espaces
            'payment_type' => ['nullable', 'string', 'max:100'] // Type de paiement
        ]);
        if ($validator->fails()) {
            return response([
                'has_error' => true,
                'message' => 'Des paramètres sont manquants : '.$validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        } else {
            /* Vérification de l'ID de transaction chez NGSER */
            if(empty($request->input('order_id'))) {
                return response([
                    'has_error' => true,
                    'message' => 'Echec de la synchronisation...'
                ], Response::HTTP_OK);
            }
            $payment_data = $this->verify($request->input('order_id'));
            if($payment_data['has_error']) {
                return response([
                    'has_error' => true,
                    'message' => 'Echec de la synchronisation du paiement, votre numéro de transaction n\'est pas reconnu...'
                ], Response::HTTP_OK);
            } else {
                // Retrouver le numéro de dossier et le numéro de téléphone à actualiser à partir du numéro de transaction
                $payment_type = "";
                if(strpos($request->input('order_id'), env("NGSER_SERVICE_SALT"))) {
                    $metadata = explode(env("NGSER_SERVICE_SALT"), $request->input('order_id'));
                    $form_number = $metadata[0];
                    $payment_type = env('PAYMENT_TYPE');
                }

                // Convertir la chaîne en objet DateTime
                $date = DateTime::createFromFormat('d/m/Y H:i', $payment_data['data']['data']['transaction_date']);
                // Formater la date dans le format requis
                $transaction_date = $date->format('Y-m-d H:i:s');

                if($payment_type === env('PAYMENT_TYPE_2')) {
                    /* Vérification de la correspondance des numéros de validation pour éviter d'affecter le coupon de paiement
                    d'un dossier à celui d'une autre personne */
                    if (!empty($form_number)) {
                        AbonnesPreIdentifie::where('numero_dossier', '=', $form_number)->first()->update([
                            'transaction_id' => $request->input('order_id'),
                            'integrator_api_response_id' => $payment_data['data']['code'],
                            'integrator_code' => $payment_data['data']['description'],
                            'integrator_message' => "SUCCES", //$payment_data['data']['message'],
                            'integrator_data_amount' => $payment_data['data']['data']['paid_transaction_amount'],
                            'integrator_data_currency' => $payment_data['data']['data']['currency'],
                            'integrator_data_status' => "ACCEPTED", //$payment_data['data']['data']['status'],
                            'integrator_data_payment_method' => $payment_data['data']['data']['wallet'],
                            'integrator_data_description' => env('PAYMENT_TYPE_2'),
                            'integrator_data_metadata' => $form_number, //$payment_data['data']['data']['metadata'],
                            'integrator_data_operator_id' => $payment_data['data']['data']['transaction_id'],
                            'integrator_data_payment_date' => $transaction_date,
                            'enroll_download_link' => md5($form_number . $request->input('order_id') . $payment_data['data']['data']['transaction_id'])
                        ]);

                        return response([
                            'has_error' => false,
                            'message' => 'Synchronisation effectuée ! Le paiement du certificat a été pris en compte et est désormais disponible pour le téléchargement.'
                        ], Response::HTTP_OK);
                    }
                } elseif($payment_type === env('PAYMENT_TYPE_1')) {
                    /* Vérification de la correspondance des numéros de validation pour éviter d'affecter le coupon de paiement
                    d'un dossier à celui d'une autre personne */
                    if (!empty($form_number) && !empty($msisdn)) {
                        /* Récupération des numéros de telephone de l'abonné à partir du numéro de validation */
                        $abonne_numero = DB::table('abonnes_numeros')
                            ->select('*')
                            ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                            ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                            ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                            ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                            ->where('abonnes.numero_dossier', '=', $form_number)
                            ->where('abonnes_numeros.numero_de_telephone', '=', $msisdn)
                            ->first();
                        /* Vérification du statut du numéro de téléphone : seuls les numéros valides sont autorisés */
                        if (!isset($abonne_numero->numero_de_telephone) || $abonne_numero->code_statut !== 'NUI') {
                            return response([
                                'has_error' => true,
                                'message' => 'Echec de la synchronisation du paiement, le numéro de téléphone saisi ne correspond pas au numéro identifié par le dossier : '.$request->input('cpm_custom')
                            ], Response::HTTP_OK);
                        }
                        /* Récupération du numéro de telephone valide et sauvegarde les informations de paiement en base de données */
                        DB::table('abonnes_numeros')
                            ->where('abonne_id', '=', $abonne_numero->abonne_id)
                            ->where('numero_de_telephone', '=', $abonne_numero->numero_de_telephone)
                            ->update([
                                'transaction_id' => $request->input('order_id'),
                                'cinetpay_api_response_id' => $payment_data['data']['code'],
                                'cinetpay_code' => $payment_data['data']['description'],
                                'cinetpay_message' => "SUCCES", //$payment_data['data']['message'],
                                'cinetpay_data_amount' => $payment_data['data']['data']['paid_transaction_amount'],
                                'cinetpay_data_currency' => $payment_data['data']['data']['currency'],
                                'cinetpay_data_status' => "ACCEPTED", //$payment_data['data']['data']['status'],
                                'cinetpay_data_payment_method' => $payment_data['data']['data']['wallet'],
                                'cinetpay_data_description' => env('PAYMENT_TYPE_1'),
                                'cinetpay_data_metadata' => $form_number, //$payment_data['data']['data']['metadata'],
                                'cinetpay_data_operator_id' => $payment_data['data']['data']['transaction_id'],
                                'cinetpay_data_payment_date' => $transaction_date,
                                'certificate_download_link' => md5($form_number . $request->input('order_id') . $payment_data['data']['data']['transaction_id'])
                            ]);
                        return response([
                            'has_error' => false,
                            'message' => 'Synchronisation effectuée ! Le paiement du certificat a été pris en compte et est désormais disponible pour le téléchargement.'
                        ], Response::HTTP_OK);
                    }
                } else {
                    return response([
                        'has_error' => true,
                        'message' => 'Echec de la synchronisation du paiement, votre numéro de transaction n\'appartient pas au service demandé...'
                    ], Response::HTTP_OK);
                }
                return response([
                    'has_error' => true,
                    'message' => 'Cet ID de transaction n\'appartient pas au numéro de dossier : '.$request->input('cpm_custom')
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Vue de retour après paiement l'API NGSER<br/><br/>
     * <b>RedirectResponse</b> notify(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Application|Factory|View
     */
    public function return(Request $request) {

        $this->notify($request);
        /* Retourner vue resultat */
        return view('pages.payment.done', [
            'mobile_header_enabled' => true,
        ]);

    }


}
