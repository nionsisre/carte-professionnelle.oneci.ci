<?php

use App\Http\Controllers\FrontOffice\CertificatConformiteController;
use App\Http\Controllers\FrontOffice\ReclamationController;
use App\Http\Controllers\FrontOffice\MainController;
use App\Http\Services\CinetPayAPI;
use App\Http\Services\NGSerAPI;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Front Office Routes
|--------------------------------------------------------------------------
*/

/* Front Office Main Pages Routes */
    /* --- Home --- */
Route::get('/', [MainController::class, 'index'])->name('home');
    /* --- Certificat Conformite --- */
Route::get('/menu-certificat', [CertificatConformiteController::class, 'showMenu'])->name('certificat.menu');
Route::get('/formulaire', [CertificatConformiteController::class, 'showFormulaire'])->name('certificat.formulaire');
Route::get('/consultation', [CertificatConformiteController::class, 'showConsultation'])->name('certificat.consultation');
//Route::get('/reclamation-paiement', [CertificatConformiteController::class, 'showReclamationPaiement'])->name('certificat.reclamation_paiement');
    /* NNI Verif API Gateway */
Route::get('/'.md5('verifapi'.date('Y-m-d').env('APP_KEY')), [CertificatConformiteController::class, 'verifapi'])->name('verifapi.nni');

/* Form Submit Routes URL */
Route::post('/soumettre-formulaire', [CertificatConformiteController::class, 'submit'])->name('certificat.formulaire.submit');
Route::post('/consulter-statut-certificat', [CertificatConformiteController::class, 'search'])->name('certificat.consultation.submit');
Route::get('/consulter-statut-certificat', [CertificatConformiteController::class, 'search'])->name('certificat.consultation.submit.get');
Route::post('/soumettre-reclamation-paiement', [ReclamationController::class, 'submit'])->name('certificat.payment.reclamation.submit');

/* Internal JavaScript Ajax / Axios Scripts Routes */
Route::post('/'.md5('gcpl'.date('m').env('APP_KEY')), [CertificatConformiteController::class, 'getCertificatePaymentLink'])->name('certificat.payment.get');
Route::post('/'.md5('avipid'.date('m').env('APP_KEY')), [CertificatConformiteController::class, 'autoVerifyIfPaymentIsDone'])->name('certificat.payment.verify');
Route::get('/'.md5('get-pi'.date('m').env('APP_KEY')), [CertificatConformiteController::class, 'search'])->name('certificat.payment.done');

/* Front Office URLs on readable QR Code Routes */
Route::get('/get', [CertificatConformiteController::class, 'search'])->name('certificat.recu.check.url');
Route::get('/check-certificat-conformite', [CertificatConformiteController::class, 'checkCertificate'])->name('certificat.check.url');

/* File Downloads Routes */
Route::get('/telecharger-certificat-conformite-pdf', [CertificatConformiteController::class, 'downloadCertificateConformitePDF'])->name('certificat.download.pdf');

/* CinetPAY routes */
Route::post('/cinetpay/notify', [CinetPayAPI::class, 'notify'])->name('cinetpay.notify');
Route::post('/cinetpay/return', [CinetPayAPI::class, 'return'])->name('cinetpay.return');
Route::post('/cinetpay/cancel', [CinetPayAPI::class, 'cancel'])->name('cinetpay.cancel');
/* NGSer routes */
Route::post('/check-status-payment', [NGSerAPI::class, 'notify'])->name('ngser.notify');
Route::get('/notification-post-payment', [NGSerAPI::class, 'return'])->name('ngser.return');
