<?php

namespace App\Helpers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
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

}
