<?php

namespace App\Helpers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use GuzzleHttp\Exception\GuzzleException;

class QrCode {

    /**
     * Generates a base64-encoded QR code from the given message using the QR Code library.
     *
     * @param string $message The message to encode in the QR code.
     * @param int $size The size of the QR code image. Default value is 300.
     * @param int $margin The margin of the QR code. Default value is 10.
     * @return string The base64-encoded QR code image.
     */
    public function generateQrBase64($message, $size=300, $margin=10) {
        $qrresult = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($message)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size($size)
            ->logoPath(asset('assets/images/logo_qrcode.png'))
            ->logoResizeToWidth(60)
            ->margin($margin)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();
        /*
        ->logoPath(URL::asset('assets/images/logo-o-white.svg'))
        ->labelText('Numéro de validation : '.$identification_resultats->numero_dossier)
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        */
        return $qrresult->getDataUri();
    }

    /**
     * Generates a base64-encoded QR code from the given data using the CEV API.
     *
     * @param array $data The data used to generate the QR code.
     * @return string The base64-encoded QR code image.
     */
    public function generateQrCEVBase64($data) {
        if(config('services.cev.enabled')) {
            if(env('APP_ENV') == 'local') {
                $cev_api_link = env('CEV_API_URL_TEST');
                $cev_api_key = env('CEV_API_KEY_TEST');
                $use_case_id = "FFFF";
                $use_case_version = "42";
            } elseif(env('APP_ENV') == 'production') {
                $cev_api_link = env('CEV_API_URL_PROD');
                $cev_api_key = env('CEV_API_KEY_PROD');
                $use_case_id = "0100";
                $use_case_version = "04";
            }
            $base64_cev_qrcode = "";
            $guzzle_client = new \GuzzleHttp\Client();
            try {
                $token_bearer_response = $guzzle_client->request('POST', $cev_api_link.'/authenticate', [
                    'headers' => ['Content-type' => 'application/json'],
                    'json' => [
                        'key' => $cev_api_key
                    ]
                ]);
                $api_bearer_token = json_decode($token_bearer_response->getBody(), true);
                /* Response check up */
                if (!empty($api_bearer_token['bearerToken'])) {
                    try {
                        $cev_api_response = $guzzle_client->request('POST', $cev_api_link.'/api/bioseal/create/biometric', [
                            'headers' => [
                                'Content-type' => 'application/json',
                                'Authorization' => 'Bearer '.$api_bearer_token['bearerToken']
                            ],
                            'query' => [
                                'use_case_id' => $use_case_id,
                                'use_case_version' => $use_case_version,
                                'format' => 'DataMatrix',
                                'datamatrix_size' => 'SIZE_21',
                                '2d_code_magnification_factor' => 4.54,
                            ],
                            'json' => [
                                'payload' => [
                                    "general_director_name" => $data["directeur_general"],
                                    "last_name" => $data["nom"],
                                    "first_names" => $data["prenom"],
                                    "last_name_2" => $data["nom_decision"],
                                    "first_names_2" => $data["prenom_decision"],
                                    "nni" => (!empty($data["nni"])) ? $data["nni"] : $data["numero_cni"],
                                    "order_number" => $data["numero_decision"],
                                    "court" => $data["lieu_decision"],
                                    "order_date" => date('Y-m-d', strtotime($data["date_decision"])),
                                    "date_of_issue" => date('Y-m-d', strtotime($data["date_certificat"])),
                                    "place_of_issue" => $data["lieu_certificat"]
                                ],
                            ]
                        ]);
                        if ($cev_api_response->getStatusCode() == 200) {
                            // Obtenez le contenu de l'image (PNG)
                            $cev_qrcode = base64_encode($cev_api_response->getBody()->getContents());
                            $base64_cev_qrcode = ('data:image/png;base64,' . $cev_qrcode);
                        }
                    } catch (GuzzleException $guzzle_exception) {
                        return $guzzle_exception->getMessage();
                    }
                }
            } catch (GuzzleException $guzzle_exception) {
                return "";
            }

            return $base64_cev_qrcode;
        }

        return "";
    }

}
