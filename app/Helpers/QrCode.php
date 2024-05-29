<?php

namespace App\Helpers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class QrCode {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * QrCode Base64 Image Generator from String Message<br/><br/>
     * <b>void</b> generateQrBase64(<b>String</b> $message [, <b>Integer</b> $size, <b>Integer</b> $margin])<br/>
     * @param String $message <p>QR Code message.</p>
     * @param Integer $size <p>QR Code size (optional).</p>
     * @param Integer $margin <p>QR Code margin (optional).</p>
     * @return String Return QrCode Base64 value
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
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * QrCode Base64 Image CEV Generator<br/><br/>
     * <b>void</b> generateQrCEVBase64(<b>array</b> $data)<br/>
     * @param array $data <p>data contained in the QR Code document.</p>
     * @return String Return QrCode Base64 value
     */
    public function generateQrCEVBase64($data) {
        $base64_cev_qrcode = "";
        $guzzle_client = new \GuzzleHttp\Client();
        try {
            $token_bearer_response = $guzzle_client->request('POST', env('CEV_API_URL').'/authenticate', [ // lien test
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'key' => env('CEV_API_KEY') // Clé prod
                ]
            ]);
            $api_bearer_token = json_decode($token_bearer_response->getBody(), true);
            /* Response check up */
            if (!empty($api_bearer_token['bearerToken'])) {
                /* CinetPAY transaction ID Verification */
                try {
                    $cev_api_response = $guzzle_client->request('POST', env('CEV_API_URL').'/api/bioseal/create/biometric', [
                        'headers' => [
                            'Content-type' => 'application/json',
                            'Authorization' => 'Bearer '.$api_bearer_token['bearerToken']
                        ],
                        'query' => [
                            'use_case_id' => 'FFFF',
                            'use_case_version' => '42',
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
                        //$cev_qrcode = base64_encode((string)$cev_api_response->getBody());
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

}
