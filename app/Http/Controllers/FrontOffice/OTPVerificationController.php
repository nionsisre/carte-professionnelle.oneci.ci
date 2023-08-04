<?php

namespace App\Http\Controllers\FrontOffice;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Controllers\Controller;
use App\Models\AbonnesNumerosOtp;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    identification-abonnes-mobile
 * @subpackage Controller
 * @author     ONECI-DEV <info@oneci.ci>
 * @github     https://github.com/oneci-dev
 */
class OTPVerificationController extends Controller {

    private const MAX_ATTEMPTS = 5;
    private const OTP_DIGITS = 6;

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Soumission d'une demande d'envoi de code OTP par SMS<br/><br/>
     * <b>RedirectResponse</b> sendSMS(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Response $request <p>Server Response object.</p>
     */
    public function sendOTP(Request $request) {
        /* Valider variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'tn' => ['required', 'string', 'max:100'], // Token du client
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier de l'abonne
            'idx' => ['required', 'numeric', 'max:10'], // Index de position du numero de l'abonne
        ]);
        /* Vérification du Token client */
        try {
            $client_otp_msisdn_token = $request->input('tn');
            $session_otp_msisdn_tokens = session()->get('otp_msisdn_tokens');
            for ($i=0;$i<sizeof($session_otp_msisdn_tokens);$i++) {
                if ((new GeneratedTokensOrIDs())->checkToken($client_otp_msisdn_token, $session_otp_msisdn_tokens[$i])) {
                    $is_token_correct = true;
                    break;
                }
            }
            if (!isset($is_token_correct)) {
                return response([
                    'has_error' => true,
                    'message' => 'Invalid Token'
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                /* Récupération des numéros de telephone de l'abonné à partir du numéro de dossier */
                $abonne_numeros = DB::table('abonnes_numeros')
                    ->select('*')
                    ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                    ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                    ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                    ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                    ->where('abonnes.numero_dossier', '=', $request->input('fn'))
                    ->get();
                /* Récupération du numéro de telephone à vérifier via OTP grâce à l'index reçu */
                if(!empty($abonne_numeros)) {
                    $msisdn_infos = $abonne_numeros[$request->input('idx')];
                    /*
                    |--------------------------------------------------------------------------
                    | Envoi de SMS classique pour la vérification des numéros à identifier
                    |--------------------------------------------------------------------------
                    |
                    | Ici il s'agit d'une demande d'envoi de SMS en vue de s'assurer que l'abonné possède effectivement le
                    | numéro de téléphone afin de changer le statut de ce dernier à document en attente de vérification
                    |
                    */
                    if (!empty($msisdn_infos) && property_exists($msisdn_infos, 'numero_de_telephone') && $msisdn_infos->code_statut === 'NNV') {
                        /* Vérification de l'existence d'anciennes tentatives en base */
                        $otp_attempts = AbonnesNumerosOtp::where('msisdn', '=', $msisdn_infos->numero_de_telephone)
                            ->where('form_number', '=', $request->input('fn'))
                            ->where('created_at', '>', Carbon::today())
                            ->orderByDesc('id')
                            ->get();
                        if (sizeof($otp_attempts) <= 0) { /* Aucun SMS précédemment envoyé pour ce numéro de téléphone ou quota journalier non atteint */
                            /* SMS sending using MTN API */
                            $sms_sent = $this->sendSMS($msisdn_infos);
                            if ($sms_sent['has_error']) {
                                return response([
                                    'has_error' => true,
                                    'message' => 'Une erreur est survenue lors de l\'envoi du SMS, veuillez actualiser la page et/ou réessayer plus tard SVP...',
                                    'message_service' => $sms_sent['message'],
                                    'remaining_sec' => '120'
                                ], Response::HTTP_SERVICE_UNAVAILABLE);
                            } else {
                                return response([
                                    'has_error' => false,
                                    'message' => 'SMS envoyé avec succès !',
                                    'remaining_sec' => '120'
                                ], Response::HTTP_OK);
                            }
                        } elseif (sizeof($otp_attempts) <= $this::MAX_ATTEMPTS) {
                            if ($otp_attempts[0]->otp_verification_status == 1) {
                                $last_otp_date = strtotime($otp_attempts[0]->created_at);
                                $current_date = time();
                                if (($current_date - $last_otp_date) / 60 > sizeof($otp_attempts) * 2) { // Check If Time interval reached (OTP sent after 2 minutes * number of attempts)
                                    /* SMS sending using MTN API */
                                    $sms_sent = $this->sendSMS($msisdn_infos);
                                    if ($sms_sent['has_error']) {
                                        return response([
                                            'has_error' => true,
                                            'message' => 'Une erreur est survenue lors de l\'envoi du SMS, veuillez actualiser la page et/ou réessayer plus tard SVP...',
                                            'message_service' => $sms_sent['message'],
                                            'remaining_sec' => '120'
                                        ], Response::HTTP_SERVICE_UNAVAILABLE);
                                    } else {
                                        return response([
                                            'has_error' => false,
                                            'message' => 'SMS envoyé avec succès !',
                                            'remaining_sec' => '120'
                                        ], Response::HTTP_OK);
                                    }
                                } else {
                                    /* Time interval between two OTP sent is not reached */
                                    return response([
                                        'has_error' => true,
                                        'message' => 'Temps d\'intervalle avant l\'envoi d\'un nouveau code non atteint...',
                                        'remaining_sec' => round(((sizeof($otp_attempts) * 2) - (($current_date - $last_otp_date) / 60)) * 60)
                                    ], Response::HTTP_SERVICE_UNAVAILABLE);
                                }
                            } else {
                                return response([
                                    'has_error' => true,
                                    'message' => 'Vous avez déjà vérifié ce numéro !',
                                    'remaining_sec' => '480'
                                ], Response::HTTP_CONFLICT);
                            }
                        } else { /* Nombre de SMS précédemment envoyés et supérieurs au maximum journalier pour ce numéro */
                            return response([
                                'has_error' => true,
                                'message' => 'Vous avez atteint votre quota de SMS de vérification, veuillez réessayer un autre jour SVP',
                                'remaining_sec' => '120'
                            ], Response::HTTP_TOO_MANY_REQUESTS);
                        }
                    /*
                    |------------------------------------------------------------------------------
                    | Vérification OTP pour le téléchargement du certificat d'identification ONECI
                    |------------------------------------------------------------------------------
                    |
                    | Ici l'abonné est déjà identifié et demande à télécharger son certificat, il faut donc s'assurer
                    | qu'il s'agit bien de l'abonné qui fait le certificat et pas une autre personne.
                    |
                    */
                    } elseif (!empty($msisdn_infos) && property_exists($msisdn_infos, 'numero_de_telephone') && $msisdn_infos->code_statut === 'NUI') {
                        /* Vérification de l'existence d'anciennes tentatives en base */
                        $otp_attempts = AbonnesNumerosOtp::where('msisdn', '=', $msisdn_infos->numero_de_telephone)
                            ->where('form_number', '=', $request->input('fn'))
                            ->where('created_at', '>', Carbon::today())
                            ->orderByDesc('id')
                            ->get();
                        if (sizeof($otp_attempts) <= 0) { /* Aucun SMS précédemment envoyé pour ce numéro de téléphone ou quota journalier non atteint */
                            /* SMS sending using MTN API */
                            $sms_sent = $this->sendSMS($msisdn_infos);
                            if ($sms_sent['has_error']) {
                                return response([
                                    'has_error' => true,
                                    'message' => 'Une erreur est survenue lors de l\'envoi du SMS, veuillez actualiser la page et/ou réessayer plus tard SVP...',
                                    'message_service' => $sms_sent['message'],
                                    'remaining_sec' => '120'
                                ], Response::HTTP_SERVICE_UNAVAILABLE);
                            } else {
                                return response([
                                    'has_error' => false,
                                    'message' => 'SMS envoyé avec succès !',
                                    'remaining_sec' => '120'
                                ], Response::HTTP_OK);
                            }
                        } elseif (sizeof($otp_attempts) <= $this::MAX_ATTEMPTS) {
                            $last_otp_date = strtotime($otp_attempts[0]->created_at);
                            $current_date = time();
                            if (($current_date - $last_otp_date) / 60 > sizeof($otp_attempts) * 2) { // Check If Time interval reached (OTP sent after 2 minutes * number of attempts)
                                /* SMS sending using MTN API */
                                $sms_sent = $this->sendSMS($msisdn_infos);
                                if ($sms_sent['has_error']) {
                                    return response([
                                        'has_error' => true,
                                        'message' => 'Une erreur est survenue lors de l\'envoi du SMS, veuillez actualiser la page et/ou réessayer plus tard SVP...',
                                        'message_service' => $sms_sent['message'],
                                        'remaining_sec' => '120'
                                    ], Response::HTTP_SERVICE_UNAVAILABLE);
                                } else {
                                    return response([
                                        'has_error' => false,
                                        'message' => 'SMS envoyé avec succès !',
                                        'remaining_sec' => '120'
                                    ], Response::HTTP_OK);
                                }
                            } else {
                                /* Time interval between two OTP sent is not reached */
                                return response([
                                    'has_error' => true,
                                    'message' => 'Temps d\'intervalle avant l\'envoi d\'un nouveau SMS non atteint...',
                                    'remaining_sec' => round(((sizeof($otp_attempts) * 2) - (($current_date - $last_otp_date) / 60)) * 60)
                                ], Response::HTTP_SERVICE_UNAVAILABLE);
                            }
                        } else { /* Nombre de SMS précédemment envoyés et supérieurs au maximum journalier pour ce numéro */
                            return response([
                                'has_error' => true,
                                'message' => 'Vous avez atteint votre quota de SMS de vérification, veuillez réessayer un autre jour SVP',
                                'remaining_sec' => '120'
                            ], Response::HTTP_TOO_MANY_REQUESTS);
                        }
                    }
                }
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return response([
                    'has_error' => true,
                    'message' => 'Veuillez actualiser la page et/ou réessayer plus tard SVP',
                    'remaining_sec' => '120'
                ], Response::HTTP_UNAUTHORIZED);
        }
        return response([
            'has_error' => true,
            'message' => '...',
            'remaining_sec' => '120'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Vérification du code OTP envoyé par SMS<br/><br/>
     * <b>RedirectResponse</b> verifyOTP(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    public function verifyOTP(Request $request) {
        /* Valider variables du formulaire */
        $validator = Validator::make($request->all(), [
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier de l'abonne
            'idx' => ['required', 'numeric', 'max:10'], // Index de position du numero de l'abonne
            'otp-code' => ['required', 'string', 'min:6', 'max:6'], // Code OTP de l'abonne a verifier
        ]);
        if ($validator->fails()) {
            return redirect()->route('front_office.page.consultation')->withErrors($validator)->withInput();
        }
        /* Récupération des numéros de telephone de l'abonné à partir du numéro de dossier */
        $abonne_numeros = DB::table('abonnes_numeros')
            ->select('*')
            ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
            ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
            ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
            ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
            ->where('abonnes.numero_dossier', '=', $request->input('fn'))
            ->get();
        /* Récupération du numéro de telephone à vérifier via OTP grâce à l'index reçu */
        if(!empty($abonne_numeros)) {
            $abonne_numero = $abonne_numeros[$request->input('idx')];
            /*
            |--------------------------------------------------------------------------
            | Envoi de SMS classique pour la vérification des numéros à identifier
            |--------------------------------------------------------------------------
            |
            | Ici il s'agit d'une demande d'envoi de SMS en vue de s'assurer que l'abonné possède effectivement le
            | numéro de téléphone afin de changer le statut de ce dernier à document en attente de vérification
            |
            */
            if (!empty($abonne_numero) && property_exists($abonne_numero, 'code_statut') && $abonne_numero->code_statut === 'NNV') {
                /* Obtention des messages OTP envoyés à ce numéro du jour (validité 1 jour) */
                $otp_history_messages = AbonnesNumerosOtp::where('form_number', '=', $request->input('fn'))
                    ->where('msisdn', '=', $abonne_numero->numero_de_telephone)
                    ->where('otp_verification_status', '=', '1')
                    ->where('created_at', '>', Carbon::today())
                    ->orderByDesc('id')
                    ->first();
                /* Comparaison entre le code OTP soumis et le dernier code OTP envoyé à ce numéro */
                if (isset($otp_history_messages->otp_code) && $otp_history_messages->otp_code == $request->input('otp-code')) {
                    /* Changement de statut du numéro et ajout des informations OTP sur la ligne du numéro de téléphone */
                    $otp_history_messages->otp_verification_status = '2';
                    $otp_history_messages->save();
                    DB::table('abonnes_numeros')
                        ->where('abonne_id', '=', $abonne_numero->abonne_id)
                        ->where('numero_de_telephone', '=', $abonne_numero->numero_de_telephone)
                        ->update([
                            'otp_code' => $otp_history_messages->otp_code,
                            'otp_sms' => $otp_history_messages->otp_sms_message,
                            'abonnes_statut_id' => '2',
                            'updated_at' => Carbon::today()
                        ]);
                    /* Récupération des numéros de telephone de l'abonné à jour du numéro de dossier */
                    $abonne_numeros = DB::table('abonnes_numeros')
                        ->select('*')
                        ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                        ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                        ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                        ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                        ->where('abonnes.numero_dossier', '=', $request->input('fn'))
                        ->get();
                    if ($request->input('cli') === route('front_office.page.identification')) {
                        return redirect()->route('front_office.page.identification')->with('abonne_numeros', $abonne_numeros)
                            ->with('success', ['message' => 'Numéro de téléphone vérifié avec succès !']);
                    } else {
                        return redirect()->route('front_office.page.consultation')->with('abonne_numeros', $abonne_numeros)
                            ->with('success', ['message' => 'Numéro de téléphone vérifié avec succès !']);
                    }
                }
            /*
            |------------------------------------------------------------------------------
            | Vérification OTP pour le téléchargement du certificat d'identification ONECI
            |------------------------------------------------------------------------------
            |
            | Ici l'abonné est déjà identifié et demande à télécharger son certificat, il faut donc s'assurer
            | qu'il s'agit bien de l'abonné qui fait le certificat et pas une autre personne.
            |
            */
            } elseif(!empty($abonne_numero) && property_exists($abonne_numero, 'code_statut') && $abonne_numero->code_statut === 'NUI') {
                /* Obtention des messages OTP envoyés à ce numéro du jour (validité 1 jour) */
                $otp_history_messages = AbonnesNumerosOtp::where('form_number', '=', $request->input('fn'))
                    ->where('msisdn', '=', $abonne_numero->numero_de_telephone)
                    ->where('otp_verification_status', '=', '1')
                    ->where('created_at', '>', Carbon::today())
                    ->orderByDesc('id')
                    ->first();
                /* Comparaison entre le code OTP soumis et le dernier code OTP envoyé à ce numéro */
                if (isset($otp_history_messages->otp_code) && $otp_history_messages->otp_code == $request->input('otp-code')) {
                    /* Changement de statut du numéro et ajout des informations OTP sur la ligne du numéro de téléphone */
                    $otp_history_messages->otp_verification_status = '2';
                    $otp_history_messages->save();
                    /* Téléchargement du fichier PDF si la date d'expiration n'est pas encore expiré */
                    $date_expiration = date('Y-m-d', strtotime('+1 year', strtotime($abonne_numero->cinetpay_data_payment_date)) );
                    $date_du_jour = date('Y-m-d', time());
                    if($date_du_jour <= $date_expiration) {
                        /* PDF Download document generation */
                        $data = [
                            'title' => 'Certificat d\'identification',
                            'qrcode' => (new QrCode())->generateQrBase64(route('front_office.auth.certificat_identification.url') . '?c=' . $abonne_numero->certificate_download_link, 183, 1),
                            'numero_dossier' => $abonne_numero->numero_dossier,
                            'uniqid' => $abonne_numero->uniqid,
                            'msisdn' => $abonne_numero->numero_de_telephone,
                            'date_emission' => date('d/m/Y', strtotime($abonne_numero->cinetpay_data_payment_date)),
                            'date_expiration' => date('d/m/Y', strtotime('+1 year', strtotime($abonne_numero->cinetpay_data_payment_date))),
                            'nom' => $abonne_numero->nom . ((!empty($abonne_numero->nom_epouse)) ? ' epse ' . $abonne_numero->nom_epouse : ''),
                            'prenoms' => $abonne_numero->prenoms,
                            'date_de_naissance' => date('d/m/Y', strtotime($abonne_numero->date_de_naissance)),
                            'lieu_de_naissance' => $abonne_numero->lieu_de_naissance,
                            'lieu_de_residence' => $abonne_numero->domicile,
                            'nationalite' => $abonne_numero->nationalite,
                            'profession' => $abonne_numero->profession,
                            'email' => $abonne_numero->email,
                            'id_operateur' => $abonne_numero->abonnes_operateur_id,
                            'document_justificatif' => $abonne_numero->libelle_piece,
                            'numero_document_justificatif' => $abonne_numero->numero_document,
                        ];
                        $filename = 'identification-' . $abonne_numero->nom . '-' . $abonne_numero->numero_dossier . '.pdf';
                        $pdf_certificat_identification = Pdf::loadView('layouts.certificat-identification', $data)->setPaper([0, -10, 445, 617.5]);

                        return $pdf_certificat_identification->download($filename);
                    }
                }
                return redirect()->route('front_office.page.consultation')->with('abonne_numeros', $abonne_numeros)->withErrors([
                    'not-found' => 'Le téléchargement du certificat d\'identification a échoué : Code OTP Incorrect !'
                ]);
            }
        }

        return redirect()->route('front_office.page.consultation')->with('abonne_numeros', $abonne_numeros)->withErrors(['not-found' => 'Code OTP Incorrect !']);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * SMS sending using MTN API<br/><br/>
     * <b>void</b> sendSMS(<b>object</b> $msisdn_infos)<br/>
     * @param object $msisdn_infos <p>MSISDN User Infos.</p>
     * @return array Value of result
     */
    public function sendSMS($msisdn_infos) {
        /* OTP SMS rendering */
        $otp_code = str_pad(rand(0, pow(10, $this::OTP_DIGITS)-1), $this::OTP_DIGITS, '0', STR_PAD_LEFT); // Generate random OTP Code
        $sms_msisdn = "225".str_replace(" ", "", $msisdn_infos->numero_de_telephone); // SMS Sender msisdn
        $sms_title = "Vérification de Numéro de téléphone"; // SMS Title message
        $message = "Le code de vérification de votre numéro de téléphone est : ".$otp_code; // SMS Text message
        /* SMS sending using MTN API */
        $client = new Client();
        try {
            /*$response = $client->get('https://smspro.mtn.ci/bms/Soap/Messenger.asmx/HTTP_SendSms', [
                'verify' => false,
                'stream' => true,
                'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
                'query' => [
                    'customerID' => env('SMS_CUSTOMER_ID'),
                    'userName' => env('SMS_USERNAME'),
                    'userPassword' => env('SMS_PASSWORD'),
                    'originator' => env('SMS_ORIGINATOR'),
                    'messageType' => 'ArabicWithLatinNumbers',
                    'defDate' => '',
                    'blink' => 'false',
                    'flash' => 'false',
                    'Private' => 'false',
                    'recipientPhone' => $sms_msisdn,
                    'smsText' => $message
                ]
            ]);
            // Read bytes off of the stream until the end of the stream is reached
            $body = $response->getBody();
            $contents = ''; while (!$body->eof()) $contents .= $body->read(1024);
            // Parse stream content into a xml object
            $xml = simplexml_load_string($contents);
            if($xml){
                //@TODO: Créer des colonnes pour sauvegarder aussi le retour XML en base
                $xml->Result;
                $xml->TransactionID;
                $xml->NetPoints;
            AbonnesNumerosOtp::create([
                    'msisdn' => $msisdn_infos->numero_de_telephone,
                    'form_number' => $msisdn_infos->numero_dossier,
                    'otp_code' => $otp_code,
                    'otp_sms_title' => $sms_title,
                    'otp_sms_message' => $message,
                    'otp_verification_status' => 1
                ]);
                if($xml->Result == 'OK') {
                    return [
                        'has_error' => false,
                        'message' => 'SMS successfully sent !',
                        'data' => $xml
                    ];
                } else {
                    return [
                        'has_error' => true,
                        'message' => $xml->Result.' ['.$xml->TransactionID.']'
                    ];
                }
            }*/
            $response = $client->post('https://api.smscloud.ci/v1/campaigns', [
                'headers' => [
                    'Authorization' => 'Bearer '.env('SMS_ACCESS_TOKEN'),
                    'Content-type' => 'application/json',
                    'Cache-Control' => 'no-cache'
                ],
                'json' => [
                    'sender' => env('SMS_SENDER'),
                    'recipients' => [$sms_msisdn],
                    'content' => $message,
                    'dlrUrl' => 'https://identification-abonnes.oneci.ci/sms/callback/done'
                ]
            ]);
            $contents = json_decode($response->getBody()->getContents(),true);
            if($contents['smsCount']){
                //@TODO: Créer des colonnes pour sauvegarder aussi le retour JSON en base
                /*$contents['id']
                $contents['smsCount']
                $contents['createdAt']
                $contents['failed']*/
                AbonnesNumerosOtp::create([
                    'msisdn' => $msisdn_infos->numero_de_telephone,
                    'form_number' => $msisdn_infos->numero_dossier,
                    'otp_code' => $otp_code,
                    'otp_sms_title' => $sms_title,
                    'otp_sms_message' => $message,
                    'otp_verification_status' => 1
                ]);
                if($contents['smsCount'] >= 1) {
                    return [
                        'has_error' => false,
                        'message' => 'SMS successfully sent !',
                        'data' => $contents
                    ];
                } else {
                    return [
                        'has_error' => true,
                        'message' => 'SMS sending failed ['.$contents['id'].']'
                    ];
                }
            } else {
                return [
                    'has_error' => true,
                    'message' => 'Empty response'
                ];
            }
        } catch (GuzzleException $guzzle_exception) {
            /* Moving here if something is wrong with MTN SMS API */
            return [
                'has_error' => true,
                'message' => 'SMS client exception : ['
                    .$guzzle_exception->getMessage()
                    .' -- Code : '.$guzzle_exception->getCode().']'
            ];
        }
    }

}
