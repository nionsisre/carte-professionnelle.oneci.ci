<?php

namespace App\Http\Controllers;

use App\Models\AbonnesNumerosOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    private $max_attempts = 6;

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Soumission d'une demande d'envoi de SMS<br/><br/>
     * <b>RedirectResponse</b> sendSMS(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Response $request <p>Server Response object.</p>
     */
    public function sendSMS(Request $request) {
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
                if ($this->checkToken($client_otp_msisdn_token, $session_otp_msisdn_tokens[$i])) {
                    $is_token_correct = true;
                    break;
                }
            }
            if (!isset($is_token_correct)) {
                return response([
                    'error' => true,
                    'error_message' => 'Forbidden',
                    'remaining_sec' => '120'
                ], Response::HTTP_FORBIDDEN);
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
                $msisdn = $abonne_numeros[$request->input('idx')]->numero_de_telephone;
                /* Vérification de l'existence d'anciennes tentatives en base */
                $otp_attempts = AbonnesNumerosOtp::get(['msisdn' => $msisdn])->all();
                if (empty($otp_attempts)) { /* Aucun SMS précédemment envoyé pour ce numéro de téléphone */
                    /* @TODO: Envoi de SMS */
                } else if (sizeof($otp_attempts) <= $this->max_attempts) { /* Nombre de SMS précédemment envoyés et inférieurs au maximum journalier pour ce numéro */
                    /* @TODO: Envoi de SMS */
                } else { /* Nombre de SMS précédemment envoyés et supérieurs au maximum journalier pour ce numéro */
                    return response([
                        'error' => true,
                        'error_message' => 'Vous avez atteint votre quota de SMS de vérification, veuillez réessayer un autre jour SVP',
                        'remaining_sec' => '120'
                    ], Response::HTTP_TOO_MANY_REQUESTS);
                }
                /* Retour résultat JSON */
                return response($abonne_numeros, Response::HTTP_OK);
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return response([
                'error' => true,
                'error_message' => 'Forbidden',
                'remaining_sec' => '120'
            ], Response::HTTP_FORBIDDEN);
        }
        /*  */
        /*
        if(!empty($recepisse_number) && !empty($msisdn)) {
            $sms_arr = $RequestUsers->getSMS(0, str_replace(" ", "", $msisdn));
            if(!$sms_arr) { // Never sent OTP before for this recepisse number
                // Generate OTP Code and send it via SMS
                $otp_digits = 6; // Number of verification code digits
                // Create SMS verification token
                $otp_code["value"] = str_pad(rand(0, pow(10, $otp_digits)-1), $otp_digits, '0', STR_PAD_LEFT);
                $otp_code['otp_verification_start_time'] = time();
                $verification_code = $otp_code["value"];
                // SMS Sender msisdn
                $SMS_RECIPIENT_PHONE = "225".str_replace(" ", "", $msisdn);
                // SMS Title message
                $title = "Vérification de Numéro de téléphone";
                // SMS Text message
                $message = "Le code de vérification de votre numéro de téléphone est : ".$verification_code;
                // Send SMS Text using MTN API
                $data = array(
                    's' => $message
                );
                $url = "https://smspro.mtn.ci/bms/Soap/Messenger.asmx/HTTP_SendSms?customerID=".$SMS_CUSTOMER_ID."&userName=".$SMS_USERNAME."&userPassword=".$SMS_USER_PASSWORD."&originator=".$SMS_ORIGINATOR."&messageType=ArabicWithLatinNumbers&defDate=&blink=false&flash=false&Private=false&recipientPhone=".$SMS_RECIPIENT_PHONE."&smsText=". str_replace('s=','',http_build_query($data));
                // ---------- FIRST WAY  ------------
                // $contents = file_get_contents($url);
                // ----------------------------------
                $options = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false
                    ),
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'GET'
                    )
                );
                $context = stream_context_create($options);
                $contents = file_get_contents($url, false, $context);
                // ----------------------------------
                // If $contents is not a boolean FALSE value.
                if($contents !== false){
                    // Save OTP if SMS is sent and return response
                    $response = array(
                        'error' => false,
                        'data' => $RequestUsers->saveSMScode(RequestUsers::STANDARD, str_replace(" ", "", $msisdn), $recepisse_number, $title, $message, $verification_code, 1),
                        'remaining_sec' => 120
                    );
                } else {
                    $response = array('tag' => $instruction, 'success' => 0, 'error' => true,
                        'error_msg' => "Erreur interne",
                        'remaining_sec' => "120");
                }
            } else if (is_array($sms_arr) && sizeof($sms_arr) <= 6) { // Already sent less than 6 OTP before for this recepisse number
                $sms_arr2 = $RequestUsers->getSMS(0, str_replace(" ", "", $msisdn),0,0,0,2);
                if (is_array($sms_arr2)) {
                    $response = array('tag' => "STATUS_API", 'success' => 0, 'error' => true,
                        'error_msg' => "Erreur d'envoi : Ce numéro a déjà été utilisé pour une vérification SMS",
                        'remaining_sec' => "120");
                } else {
                    $last_otp_date = strtotime($sms_arr[0]["creation_date"]);
                    $current_date = time();
                    if (($current_date - $last_otp_date)/60 > sizeof($sms_arr) * 2) { // If OTP already sent before ( 2minutes * number of attempts )
                        // Generate OTP Code and send it via SMS
                        $otp_digits = 6; // Number of verification code digits
                        // Create SMS verification token
                        $otp_code["value"] = str_pad(rand(0, pow(10, $otp_digits)-1), $otp_digits, '0', STR_PAD_LEFT);
                        $otp_code['otp_verification_start_time'] = time();
                        $verification_code = $otp_code["value"];
                        // SMS Sender msisdn
                        $SMS_RECIPIENT_PHONE = "225".str_replace(" ", "", $msisdn);
                        // SMS Title message
                        $title = "Vérification de Numéro de téléphone";
                        // SMS Text message
                        $message = "Le code de vérification de votre numéro de téléphone est : ".$verification_code;
                        // Send SMS Text using MTN API
                        $data = array(
                            's' => $message
                        );
                        $url = "https://smspro.mtn.ci/bms/Soap/Messenger.asmx/HTTP_SendSms?customerID=".$SMS_CUSTOMER_ID."&userName=".$SMS_USERNAME."&userPassword=".$SMS_USER_PASSWORD."&originator=".$SMS_ORIGINATOR."&messageType=ArabicWithLatinNumbers&defDate=&blink=false&flash=false&Private=false&recipientPhone=".$SMS_RECIPIENT_PHONE."&smsText=". str_replace('s=','',http_build_query($data));
                        // ---------- FIRST WAY  ------------
                        // $contents = file_get_contents($url);
                        // ----------------------------------
                        $options = array(
                            "ssl" => array(
                                "verify_peer" => false,
                                "verify_peer_name" => false
                            ),
                            'http' => array(
                                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                'method'  => 'GET'
                            )
                        );
                        $context = stream_context_create($options);
                        $contents = file_get_contents($url, false, $context);
                        // ----------------------------------
                        // If $contents is not a boolean FALSE value.
                        if($contents !== false){
                            // Save OTP if SMS is sent and return response
                            $response = array(
                                'error' => false,
                                'data' => $RequestUsers->saveSMScode(RequestUsers::STANDARD, str_replace(" ", "", $msisdn), $recepisse_number, $title, $message, $verification_code, 1),
                                'remaining_sec' => round( ((sizeof($sms_arr)+1) * 2)  * 60)
                            );
                        } else {
                            $response = array('tag' => $instruction, 'success' => 0, 'error' => true,
                                'error_msg' => "Erreur interne",
                                'remaining_sec' => "120");
                        }
                    } else {
                        // Interval between two OTP sent is not reached
                        $response = array('tag' => "STATUS_API", 'success' => 0, 'error' => true,
                            'error_msg' => "Temps d'intervalle avant l'envoi d'un nouveau code non atteint...",
                            'remaining_sec' => round(( (sizeof($sms_arr) * 2) - (($current_date - $last_otp_date)/60) ) * 60)
                        );
                    }
                }
            } else {
                $response = array('tag' => "STATUS_API", 'success' => 0, 'error' => true,
                    'error_msg' => "Erreur d'envoi : Vous avez atteint votre quota de SMS, contactez le service technique de l'ONECI",
                    'remaining_sec' => "120"
                );
            }
        } else {
            die(header("HTTP/1.1 400 Bad Request"));
        }
        */
    }

    /**
     * (PHP 4, PHP 5, PHP 7)<br/>
     * This function is useful to generate Token<br/><br/>
     * <b>array</b> createToken(<b>int</b> $expireTime)<br/>
     * @param int $expireTime <p>
     * Received token via post. <br/>Use <b>0</b> or <b>negative int</b> to infinite expiry date.
     * </p>
     * @return array Value of result
     */
    function createToken($expireTime) {
        // $token["value"] = sha1(md5("\$@lty".bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM))."\$@lt")); // Mcrypt is deprecated in PHP 7
        $token['value'] = sha1(md5("\$@lty".uniqid(rand(), TRUE)."\$@lt"));
        $token['time'] = $expireTime;
        session()->put('token_time', time());
        return $token;
    }

    /**
     * (PHP 4, PHP 5, PHP 7)<br/>
     * This function checks generated token<br/><br/>
     * <b>bool</b> checkToken(<b>string</b> $token_received, <b>array</b> $token_session)<br/>
     * @param string $token_received <p>
     * Received token via post
     * </p>
     * @param array $token_session <p>
     * Session token variable
     * </p>
     * @return bool Value of result
     */
    function checkToken($token_received, $token_session){
        try {
            $token_age = time() - session()->get('token_time', time());
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return FALSE;
        }
        if ( ($token_received===$token_session["value"]) && $token_session['time']<=0 ) {
            return TRUE;
        } elseif ( ($token_received===$token_session["value"]) && ($token_age<=$token_session['time']) ) {
            return TRUE;
        } elseif ( ($token_received===$token_session["value"]) && ($token_age>$token_session['time']) ) {
            return FALSE;
        } elseif ( ($token_received!==$token_session["value"]) && ($token_age<=$token_session['time']) ) {
            return FALSE;
        } elseif ( ($token_received!==$token_session["value"]) && ($token_age<=$token_session['time']) ) {
            return FALSE;
        }
        return FALSE;
    }

}
