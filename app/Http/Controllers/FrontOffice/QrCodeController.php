<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;

class QrCodeController extends Controller {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * QrCode Raw Image Generator from Request Message<br/><br/>
     * <b>void</b> generateQrCode(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return bool Return true after displaying QrCode
     */
    public function generateQrCode(Request $request) {
        $message = $request->get('m');
        $qrresult = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($message)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();
        /* Directly output the QR code */
        header('Content-Type: '.$qrresult->getMimeType());
        echo $qrresult->getString();
        return true;
    }

}
