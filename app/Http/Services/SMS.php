<?php

namespace App\Http\Services;

use App\Helpers\Utils;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SMS
{
    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * SMS sending using MTN API<br/><br/>
     * <b>void</b> sendSMS(<b>object</b> $msisdn_infos)<br/>
     * @param object $msisdn_infos <p>MSISDN User Infos.</p>
     * @return array Value of result
     */
    public function sendSMS($msisdn, $message, $with_otp = false) {
        if($with_otp) {
            /* OTP SMS rendering */
            $otp_code = str_pad(rand(0, pow(10, 6)-1), 6, '0', STR_PAD_LEFT); // Generate random OTP Code
            $msisdn = str_replace(" ", "", $msisdn); // SMS Sender msisdn
            $message = $message." ".$otp_code; // SMS Text message
        }
        /* SMS sending using MTN API */
        $client = new Client();
        try {
            $response = $client->request('POST', 'https://kernel.oneci.ci/sms-api', [
                'headers' => ['Accept' => 'application/json'],
                'form_params' => [
                    'client' => 'CERTIFICAT_CONFORMITE',
                    'msisdn' => $msisdn,
                    'message' => $message
                ]
            ]);
            // Convertir la chaîne JSON en tableau associatif
            $sms_result = json_decode((new Utils())->removeInvisibleBOMContentsOnJSONString($response->getBody()->getContents()), true);
            if (isset($sms_result['success']) && $sms_result['success'] == 1) {
                return [
                    'has_error' => false,
                    'message' => 'SMS successfully sent !',
                    'data' => $sms_result
                ];
            }
            return [
                'has_error' => true,
                'message' => $sms_result['error_msg'] ?? "Empty response"
            ];
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
