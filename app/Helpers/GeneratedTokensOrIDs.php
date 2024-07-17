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
     * This function generates a unique number ID based on the current time.<br/><br/>
     * <b>int</b> generateUniqueNumberID(<b>string</b> $type)<br/>
     * @param string $type <p>
     * The type of unique number ID to generate
     * </p>
     * @return int A unique number ID
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
     * This function creates a unique token<br/><br/>
     * <b>array</b> createToken(<b>int</b> $expireTime)<br/>
     * @param int $expireTime <p>
     * Expiration time of the token in seconds
     * </p>
     * @return array The generated token
     */
    public function createToken($expireTime) {
        $token['value'] = sha1(md5("\$@lty".uniqid(rand(), TRUE)."\$@lt"));
        $token['time'] = $expireTime;
        session()->put('token_time', time());
        return $token;
    }

    /**
     * Check if the received token is valid.
     *
     * @param string $token_received The token received from the client
     * @param array $token_session The token stored in the session
     * @return bool                     Returns TRUE if the token is valid, otherwise FALSE
     *
     * @throws NotFoundExceptionInterface    If the session token_time key does not exist
     * @throws ContainerExceptionInterface     If an error occurs while retrieving the session value
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

}
