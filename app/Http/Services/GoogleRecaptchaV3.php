<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GoogleRecaptchaV3 {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Google reCAPTCHA v3 Verification (works in "Staging" and "Production" only, not "Local" environment)<br/><br/>
     * <b>array</b> verifyGoogleRecaptchaV3(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return array Value of result
     */
    public function verify(Request $request) {
        /* Google reCAPTCHA v3 Verification (works in "Staging" and "Production" only, not "Local" environment) */
        if(config('services.recaptcha.enabled')) {
            if (App::environment(['staging', 'production'])) {
                $client = new Client();
                try {
                    $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                        'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
                        'form_params' => [
                            'secret' => config('services.recaptcha.secret'),
                            'response' => $request->input('g-recaptcha-response'),
                            'remoteip' => $request->ip()
                        ]
                    ]);
                    $recaptcha_result = json_decode($response->getBody(), true);
                    if (!$recaptcha_result['success']) {
                        return [
                            'error' => true,
                            'error_message' => 'Le captcha n\'a pas été correctement renseigné ou le délai a expiré. Veuillez actualiser la page et réessayer SVP'
                        ];
                    }
                } catch (GuzzleException $guzzle_exception) {
                    /* Moving here if something is wrong with reCAPTCHA v3 on server side service API */
                    return [
                        'error' => true,
                        'error_message' => 'Une erreur interne est survenue. Veuillez réessayer plus tard. ('
                            . $guzzle_exception->getMessage()
                            . ' -- Code : ' . $guzzle_exception->getCode() . ')'
                    ];
                }
            }
        }
        return [
            'error' => false,
            'error_message' => 'reCAPTCHA sent is ok'
        ];
    }

}
