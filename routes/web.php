<?php

use App\Http\Controllers\BackOffice\AdminController;
use App\Http\Controllers\BackOffice\LoginController;
use App\Http\Controllers\FrontOffice\CertificatConformiteController;
use App\Http\Controllers\FrontOffice\ReclamationController;
use App\Http\Controllers\FrontOffice\MainController;
use App\Http\Controllers\FrontOffice\OTPVerificationController;
use App\Http\Controllers\FrontOffice\PreIdentificationController;
use App\Http\Controllers\FrontOffice\QrCartesProfessionnellesController;
use App\Http\Controllers\FrontOffice\QrCodeController;
use App\Http\Controllers\FrontOffice\SpecialCANController;
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

/* Front Office Form Submit Routes URL */
Route::post('/soumettre-formulaire', [CertificatConformiteController::class, 'submit'])->name('certificat.formulaire.submit');
Route::post('/consulter-statut-identification', [CertificatConformiteController::class, 'search'])->name('certificat.consultation.submit');
Route::post('/soumettre-reclamation-paiement', [ReclamationController::class, 'submit'])->name('front_office.form.soumettre_reclamation_paiement');

/* Front Office Internal JavaScript Ajax / Axios Scripts Routes */
Route::post('/'.md5('cimiai'.date('m')), [CertificatConformiteController::class, 'checkIfMsisdnIsAlreadyIdentifed'])->name('front_office.scripts.msisdn.is_already_identified');
Route::post('/'.md5('gcpl'.date('m')), [CertificatConformiteController::class, 'getCertificatePaymentLink'])->name('front_office.scripts.certificat_identification.payment_link.get');
Route::post('/'.md5('avipid'.date('m')), [CertificatConformiteController::class, 'autoVerifyIfPaymentIsDone'])->name('front_office.identification.script.payment.verify');

/* Front Office URLs on readable QR Code Routes */
Route::get('/get', [CertificatConformiteController::class, 'search'])->name('front_office.auth.recu_identification.url');
Route::get('/check-certificat-identification', [CertificatConformiteController::class, 'checkCertificate'])->name('front_office.auth.certificat_identification.url');

/* Front Office File Downloads Routes */
Route::get('/telecharger-recu-identification-pdf', [CertificatConformiteController::class, 'downloadRecuIdentificationPDF'])->name('front_office.download.recu_identification.pdf');
Route::get('/telecharger-certificat-identification-pdf', [CertificatConformiteController::class, 'downloadCertificateIdentificationPDF'])->name('front_office.download.certificat_identification.pdf');

/* Front Office CinetPAY routes */
Route::post('/cinetpay/notify', [CinetPayAPI::class, 'notify'])->name('front_office.cinetpay.notify');
Route::post('/cinetpay/return', [CinetPayAPI::class, 'return'])->name('front_office.cinetpay.return');
Route::post('/cinetpay/cancel', [CinetPayAPI::class, 'cancel'])->name('front_office.cinetpay.cancel');

/* Front Office CinetPAY routes */
Route::post('/check-status-payment', [NGSerAPI::class, 'notify'])->name('front_office.nsger.notify');
Route::get('/notification-post-payment', [NGSerAPI::class, 'return'])->name('front_office.ngser.return');
