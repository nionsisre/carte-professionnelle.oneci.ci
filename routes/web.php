<?php

use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProcessCertificatConformiteController;
use App\Http\Controllers\CertificatConformiteController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReclamationController;
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
/* NGSer routes */
Route::post('/check-status-payment', [NGSerAPI::class, 'notify'])->name('ngser.notify');
Route::get('/notification-post-payment', [NGSerAPI::class, 'return'])->name('ngser.return');
/* CinetPAY routes */
Route::post('/cinetpay/notify', [CinetPayAPI::class, 'notify'])->name('cinetpay.notify');
Route::post('/cinetpay/return', [CinetPayAPI::class, 'return'])->name('cinetpay.return');
Route::post('/cinetpay/cancel', [CinetPayAPI::class, 'cancel'])->name('cinetpay.cancel');

/*
|--------------------------------------------------------------------------
| Back Office Routes
|--------------------------------------------------------------------------
*/

Route::prefix('oneciwebadmin')->group(function () {

    // ------------------------------------------
    // Authentication Routes via compte Kernel
    // ------------------------------------------
    Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('admin.auth.login');
    Route::post('/sign-in', [AuthenticationController::class, 'submitLogin'])->name('admin.auth.login.submit');
    Route::get('/forgot-password', [AuthenticationController::class, 'showForgotPassword'])->name('admin.auth.password.forgot');
    // -----------------------
    // Authenticated Routes
    // -----------------------
    Route::middleware(['auth:web'])->group(function () {
        // ------------------
        // Admin Routes
        // ------------------
        // Home
        Route::get('/', [HomeController::class, 'show'])->name('admin.home');
        // ------------------
        // Business Logic
        // ------------------
        // Traitement des demandes de certificat de conformité
        Route::get('/traitement-demandes-certificat-conformite', [ProcessCertificatConformiteController::class, 'show'])->name('admin.certificat');
        Route::get('/datatables/french', [ProcessCertificatConformiteController::class, 'showDatatablesFrench'])->name('datatables.french.json');
        Route::post(sha1('/traitement-demandes-certificat-conformite'.date('Ymd').env('APP_KEY')), [ProcessCertificatConformiteController::class, 'getClient'])->name('admin.certificat.datatable');
        Route::post('/data/client/{numero_dossier}', [ProcessCertificatConformiteController::class, 'getClientByNumeroDossier'])->name('admin.certificat.client.get');
        Route::post(sha1('/data/client/approved'.date('Ymd').env('APP_KEY')).'/{numero_dossier}', [ProcessCertificatConformiteController::class, 'approveClientByNumeroDossier'])->name('admin.certificat.client.approve');
        Route::post(sha1('/data/client/denied'.date('Ymd').env('APP_KEY')).'/{numero_dossier}', [ProcessCertificatConformiteController::class, 'denyClientByNumeroDossier'])->name('admin.certificat.client.deny');
        Route::post(sha1('/data/client/signed'.date('Ymd').env('APP_KEY')).'/{numero_dossier}', [ProcessCertificatConformiteController::class, 'setSignedClientByNumeroDossier'])->name('admin.certificat.client.signed');
        Route::post(sha1('/data/client/withdrawn'.date('Ymd').env('APP_KEY')).'/{numero_dossier}', [ProcessCertificatConformiteController::class, 'setWithdrawnClientByNumeroDossier'])->name('admin.certificat.client.withdrawn');
    });

});

