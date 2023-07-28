<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class QrCartesProfessionnellesController extends Controller {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Genere automatiquement des Codes QR pour les Cartes Professionnelles et les rend téléchargeable au format ZIP<br/><br/>
     * <b>void</b> downloadQrCodesAsZip(<b>Request</b> $request)<br/>
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadQrCodesAsZip() {

        $employes = DB::table('employes')
            ->select('*')
            /*->where('creation_date', 'LIKE', '2023-05-15 22%')*/
            ->where('creation_date', 'LIKE', date('Y-m-d').' %')
            ->get();

        if($employes->count()) {
            $file = new Filesystem();
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { /* If Current server OS is windows */
                /* Delete all existing files in a directory */
                $file->cleanDirectory(storage_path('app\\public\\qrcp'));
            } else { /* If Current server OS is not windows */
                /* Delete all existing files in a directory */
                $file->cleanDirectory(storage_path('app/public/qrcp'));
            }
            foreach($employes as $employe) {
                $message = 'https://www.oneci.ci/check-carte-professionnelle?m=' .$employe->matricule. '&t=' .sha1(md5($employe->matricule.'cp'));
                $qrresult = Builder::create()
                    ->writer(new PngWriter())
                    ->writerOptions([])
                    ->data($message)
                    ->encoding(new Encoding('UTF-8'))
                    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                    ->size(300)
                    ->logoPath(asset('assets/images/logo_qrcode.png'))
                    ->logoResizeToWidth(60)
                    ->margin(10)
                    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->build();
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { /* If Current server OS is windows */
                    /* Save qrcode to a png file */
                    $qrresult->saveToFile(storage_path('app\\public\\qrcp').'\\'.trim($employe->matricule.'_'.$employe->nom).'.png');
                } else { /* If Current server OS is not windows */
                    /* Save qrcode to a png file */
                    $qrresult->saveToFile(storage_path('app/public/qrcp').'/'.trim($employe->matricule.'_'.$employe->nom).'.png');
                }
            }

            /* Zip all files */
            $zip = new ZipArchive();
            $zip_file_name = 'qrcodes_cartes_professionnelles_'.date('Y-m-d').'.zip';
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { /* If Current server OS is windows */
                //$zip_file_path = public_path('storage\\qrcp').'\\'.$zip_file_name;
                $zip_file_path = storage_path('app\\public\\qrcp\\'.$zip_file_name);
            } else { /* If Current server OS is not windows */
                //$zip_file_path = public_path('storage/qrcp').'/'.$zip_file_name;
                $zip_file_path = storage_path('app/public/qrcp/'.$zip_file_name);
            }
            if ($zip->open($zip_file_path, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
                /* Folder files to zip and download */
                $files = Storage::files('public/qrcp');
                /* Loop the files result */
                foreach ($files as $file) {
                    $relative_name_in_zip_file = basename($file);
                    if($relative_name_in_zip_file !== '.gitignore') {
                        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { /* If Current server OS is windows */
                            //$zip->addFile(public_path('storage\\qrcp\\'.$relative_name_in_zip_file), $relative_name_in_zip_file);
                            $zip->addFile(storage_path('app\\public\\qrcp\\'.$relative_name_in_zip_file), $relative_name_in_zip_file);
                        } else { /* If Current server OS is not windows */
                            //$zip->addFile(public_path('storage/qrcp/'.$relative_name_in_zip_file), $relative_name_in_zip_file);
                            $zip->addFile(storage_path('app/public/qrcp/'.$relative_name_in_zip_file), $relative_name_in_zip_file);
                        }
                    }
                }
                $zip->close();
            }

            /* Download the generated zip */
            return response()->download($zip_file_path, $zip_file_name)->deleteFileAfterSend(false);

        }

        return "Aucune donnée chargée aujourd'hui !";

    }

}
