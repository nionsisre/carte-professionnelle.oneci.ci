<?php

namespace App\Http\Services;

use App\Helpers\GeneratedTokensOrIDs;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CinetPayAPI {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Get CinetPay API payment link method<br/><br/>
     * <b>void</b> getPaymentLinkCinetPayAPI(<b>Array</b> $abonne_infos)<br/>
     * @param array $request <p>Client Request object.</p>
     * @return array Value of result
     */
    public function getPaymentLink($abonne_infos) {
        $client = new Client();
        try {
            $transaction_id = date('Y', time()). (new GeneratedTokensOrIDs())->generateUniqueNumberID('transaction_id');
            $response = $client->request('POST', 'https://api-checkout-oneci.cinetpay.com/v2/payment', [
                'verify' => false,
                'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'apikey' => env('CINETPAY_API_KEY'),
                    'site_id' => env('CINETPAY_SERVICE_KEY'),
                    'transaction_id' => $transaction_id,
                    'amount' => env('CINETPAY_SERVICE_AMOUNT'),
                    'currency' => 'XOF',
                    'alternative_currency' => '',
                    'description' => 'Paiement Certificat Identification',
                    'customer_id' => $abonne_infos->numero_dossier,
                    'customer_name' => $abonne_infos->nom,
                    'customer_surname' => $abonne_infos->prenoms,
                    'customer_email' => $abonne_infos->email,
                    'customer_phone_number' => $abonne_infos->numero_de_telephone,
                    'customer_address' => 'Antananarivo',
                    'customer_city' => 'Antananarivo',
                    'customer_country' => 'CM',
                    'customer_state' => 'CM',
                    'customer_zip_code' => '065100',
                    'channels' => 'ALL',
                    'metadata' => $abonne_infos->numero_dossier,
                    'designation' => $abonne_infos->numero_de_telephone,
                    'lang' => 'FR',
                    'invoice_data' => [
                        'Numéro de validation' => $abonne_infos->numero_dossier
                    ],
                ]
            ]);
            $cinetpay_api_result = json_decode($response->getBody(), true);
            /* Response check up */
            if ($cinetpay_api_result['code']=='201') {
                return [
                    'has_error' => false,
                    'message' => '<a id="payment-link" target="_blank" href="'.$cinetpay_api_result['data']['payment_url'].'" class="button payment-link" style="margin-bottom: 0"><i class="fa fa-sack-dollar text-white"></i> &nbsp; Procéder au paiement...</a>',
                    'data' => $cinetpay_api_result['data'],
                    'transaction_id' => $transaction_id
                ];
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
                'message' => 'CinetPay API client exception : ['
                    .$guzzle_exception->getMessage()
                    .' -- Code : '.$guzzle_exception->getCode().']'
            ];
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * CinetPAY transaction ID Verification (works in "Staging" and "Production" only, not "Local" environment)<br/><br/>
     * <b>void</b> verify(<b>Request</b> $request)<br/>
     * @param String $transaction_id <p>Transaction ID.</p>
     * @return array Value of result
     */
    public function verify($transaction_id) {
        /* CinetPAY transaction ID Verification */
        $client = new Client();
        try {
            $response = $client->request('POST', env('CINETPAY_CHECK_URL'), [
                'verify' => false,
                'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'apikey' => env('CINETPAY_API_KEY'),
                    'site_id' => env('CINETPAY_SERVICE_KEY'),
                    'transaction_id' => $transaction_id,
                ]
            ]);
            $cinetpay_api_result = json_decode($response->getBody(), true);
            /* Response check up */
            if ($cinetpay_api_result['data']['status']=='ACCEPTED') {
                return [
                    'has_error' => false,
                    'message' => 'Payment done !',
                    'data' => $cinetpay_api_result,
                    'transaction_id' => $transaction_id
                ];
            } else {
                return [
                    'has_error' => true,
                    'message' => 'Payment failed',
                    'data' => $cinetpay_api_result,
                    'transaction_id' => $transaction_id
                ];
            }
        } catch (GuzzleException $guzzle_exception) {
            /* Moving here if something is wrong with CinetPay API */
            return [
                'has_error' => true,
                'message' => 'CinetPay API client exception : ['
                    .$guzzle_exception->getMessage()
                    .' -- Code : '.$guzzle_exception->getCode().']'
            ];
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Notification de Paiement par l'API CinetPay<br/><br/>
     * <b>RedirectResponse</b> notify(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function notify(Request $request) {
        /*
           CinetPAY envoie une requête POST vers cette methode après chaque paiement effectué censée mettre à jour
           le statut au cas où le navigateur du client s'est déconnecté avant la synchronisation du statut lors de
           son paiement ou en cas de réclamattion de paiement non synchronisé
        */
        $validator = Validator::make($request->all(), [
            'cpm_site_id' => ['required', 'string', 'max:100'], // Token generique
            'cpm_trans_id' => ['required', 'string', 'max:100'], // ID de transaction
            'cpm_custom' => ['required', 'string', 'max:100'], // Numero de dossier contenu dans la variable Metadata
            'cpm_designation' => ['required', 'string', 'max:20'], // Numero de telephone a actualiser
            /*'cpm_trans_date' => ['required', 'string', 'max:10'], // Numero de dossier (validation)
            'cpm_amount' => ['required', 'numeric', 'max:10'], // Index de position du numero de telephone
            'cpm_currency' => ['required', 'string', 'max:70'], // Operator ID (CinetPAY)
            'signature' => ['required', 'string', 'max:70'], // API Response ID (CinetPAY)
            'payment_method' => ['required', 'string', 'max:70'], // Code (CinetPAY)
            'cel_phone_num' => ['nullable', 'string', 'max:150'], // Message retour API CinetPAY
            'cpm_phone_prefixe' => ['required', 'string', 'max:150'], // Methode de paiement CinetPAY
            'cpm_payment_config' => ['required', 'string', 'max:150'], // Date de paiement CinetPAY*/
        ]);
        if ($validator->fails()) {
            return response([
                'has_error' => true,
                'message' => 'Some parameters are missing : '.$validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        } else {
            /* Vérification de l'ID de transaction chez CinetPAY */
            if(env('CINETPAY_SERVICE_KEY') !== $request->input('cpm_site_id')) {
                return response([
                    'has_error' => true,
                    'message' => 'Echec de la synchronisation...'
                ], Response::HTTP_OK);
            }
            $payment_data = $this->verify($request->input('cpm_trans_id'));
            if($payment_data['has_error']) {
                return response([
                    'has_error' => true,
                    'message' => 'Echec de la synchronisation du paiement, votre numéro de transaction n\'est pas reconnu...'
                ], Response::HTTP_OK);
            } else {
                /* Vérification de la correspondance des numéros de validation pour éviter d'affecter le coupon de paiement
                   d'un dossier à celui d'une autre personne */
                if ($request->input('cpm_custom') === $payment_data['data']['data']['metadata']) {
                    /* Récupération des numéros de telephone de l'abonné à partir du numéro de validation */
                    $abonne_numero = DB::table('abonnes_numeros')
                        ->select('*')
                        ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                        ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                        ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                        ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                        ->where('abonnes.numero_dossier', '=', $request->input('cpm_custom'))
                        ->where('abonnes_numeros.numero_de_telephone', '=', $request->input('cpm_designation'))
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
                            'transaction_id' => $payment_data['transaction_id'],
                            'cinetpay_api_response_id' => $payment_data['data']['api_response_id'],
                            'cinetpay_code' => $payment_data['data']['code'],
                            'cinetpay_message' => $payment_data['data']['message'],
                            'cinetpay_data_amount' => $payment_data['data']['data']['amount'],
                            'cinetpay_data_currency' => $payment_data['data']['data']['currency'],
                            'cinetpay_data_status' => $payment_data['data']['data']['status'],
                            'cinetpay_data_payment_method' => $payment_data['data']['data']['payment_method'],
                            'cinetpay_data_description' => $payment_data['data']['data']['description'],
                            'cinetpay_data_metadata' => $payment_data['data']['data']['metadata'],
                            'cinetpay_data_operator_id' => $payment_data['data']['data']['operator_id'],
                            'cinetpay_data_payment_date' => $payment_data['data']['data']['payment_date'],
                            'certificate_download_link' => md5($request->input('fn') . $payment_data['transaction_id'] . $payment_data['data']['data']['operator_id']),
                        ]);
                    return response([
                        'has_error' => false,
                        'message' => 'Synchronisation effectuée ! Le paiement du certificat a été pris en compte et est désormais disponible pour le téléchargement.'
                    ], Response::HTTP_OK);
                } else {
                    return response([
                        'has_error' => true,
                        'message' => 'Cet ID de transaction n\'appartient pas au numéro de dossier : '.$request->input('cpm_custom')
                    ], Response::HTTP_OK);
                }
            }
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * retour de Paiement par l'API CinetPay<br/><br/>
     * <b>RedirectResponse</b> return(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function return(Request $request) {
        /* Après le paiement une redirection est effectuee vers l'espace de consultation si le transaction_id exist dans la base */
        if(!empty($request->input('transaction_id'))) {
            $abonne_numeros = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                ->where('abonnes.transaction_id', '=', $request->get('transaction_id'))
                ->get();
            if (sizeof($abonne_numeros) !== 0) {
                /* Génération d'un token certificat pour chaque numéro de téléphone < Identifié > en session */
                return (new GeneratedTokensOrIDs())->applyCertificatedTokenToEachMSISDNs($abonne_numeros);
            }
        }
        /* Sinon retourner sur le formulaire de consultation */
        return redirect()->route('consultation_statut_identification');
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Annulation de Paiement par l'API CinetPay<br/><br/>
     * <b>RedirectResponse</b> cancelCinetPayAPI(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function cancel(Request $request) {
        /* En cas d'annulation d'un paiement */
        return response([
            'has_error' => false,
            'message' => 'Impossible d\'annuler un paiement'
        ], Response::HTTP_OK);
    }

}
