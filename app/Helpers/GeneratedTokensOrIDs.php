<?php

namespace App\Helpers;

use App\Models\Abonne;
use App\Models\AbonnesNumero;
use App\Models\AbonnesPreIdentifie;
use App\Models\Client;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GeneratedTokensOrIDs {

    /**
     * (PHP 4, PHP 5, PHP 7, PHP 8+)<br/>
     * This function is useful to generate unique number ID<br/><br/>
     * <b>array</b> generateUniqueNumberID()<br/>
     * </p>
     * @return numeric Unique Number ID
     */
    public function generateUniqueNumberID($type) {
        $unique_number_id = time();
        switch ($type) {
            case 'numero_dossier':
                return (Client::where('numero_dossier', $unique_number_id)->exists()) ? $this->generateUniqueNumberID($type) : $unique_number_id;
            default:
                return $unique_number_id;
        }
    }

    /**
     * (PHP 4, PHP 5, PHP 7, PHP 8+)<br/>
     * This function is useful to generate Token<br/><br/>
     * <b>array</b> createToken(<b>int</b> $expireTime)<br/>
     * @param int $expireTime <p>
     * Received token via post. <br/>Use <b>0</b> or <b>negative int</b> to infinite expiry date.
     * </p>
     * @return array Value of result
     */
    public function createToken($expireTime) {
        $token['value'] = sha1(md5("\$@lty".uniqid(rand(), TRUE)."\$@lt"));
        $token['time'] = $expireTime;
        session()->put('token_time', time());
        return $token;
    }

    /**
     * (PHP 4, PHP 5, PHP 7, PHP 8+)<br/>
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
    public function checkToken($token_received, $token_session){
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

    /**
     * @param \Illuminate\Support\Collection $abonne_numeros
     * @return \Illuminate\Http\RedirectResponse
     */
    public function applyCertificatedTokenToEachMSISDNs(\Illuminate\Support\Collection $abonne_numeros) {
        for ($i = 0; $i < sizeof($abonne_numeros); $i++) $certificate_msisdn_tokens[$i] = (new GeneratedTokensOrIDs)->createToken(0);
        session()->put('certificate_msisdn_tokens', $certificate_msisdn_tokens);
        /* Si le service d'envoi de SMS est actif */
        if (config('services.sms.enabled')) {
            /* Génération d'un token OTP pour chaque numéro de téléphone en session */
            for ($i = 0; $i < sizeof($abonne_numeros); $i++) {
                $otp_msisdn_tokens[$i] = (new GeneratedTokensOrIDs)->createToken(0);
            }
            session()->put('otp_msisdn_tokens', $otp_msisdn_tokens);
        }
        return redirect()->route('certificat.consultation')->with('abonne_numeros', $abonne_numeros);
    }

}
