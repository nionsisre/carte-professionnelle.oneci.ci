<?php

use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProcessPreIdentificationController;
use App\Http\Controllers\PreIdentificationController;
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
/* --- Pré-identification --- */
Route::get('/menu-pre-identification', [PreIdentificationController::class, 'showMenu'])->name('pre-identification.menu');
Route::get('/formulaire', [PreIdentificationController::class, 'showFormulaire'])->name('pre-identification.formulaire');
Route::get('/consultation', [PreIdentificationController::class, 'showConsultation'])->name('pre-identification.consultation');
//Route::get('/reclamation-paiement', [PreIdentificationController::class, 'showReclamationPaiement'])->name('pre-identification.reclamation_paiement');
/* NNI Verif API Gateway */
Route::get('/'.md5('verifapi'.date('Y-m-d').env('APP_KEY')), [PreIdentificationController::class, 'verifapi'])->name('verifapi.nni');
/* Form Submit Routes URL */
Route::post('/soumettre-formulaire', [PreIdentificationController::class, 'submit'])->name('pre-identification.formulaire.submit');
Route::post('/consulter-statut-pre-identification', [PreIdentificationController::class, 'search'])->name('pre-identification.consultation.submit');
Route::get('/consulter-statut-pre-identification', [PreIdentificationController::class, 'search'])->name('pre-identification.consultation.submit.get');
Route::post('/soumettre-reclamation-paiement', [ReclamationController::class, 'submit'])->name('pre-identification.payment.reclamation.submit');
/* Internal JavaScript Ajax / Axios Scripts Routes */
Route::post('/'.md5('gcpl'.date('m').env('APP_KEY')), [PreIdentificationController::class, 'getCertificatePaymentLink'])->name('pre-identification.payment.get');
Route::post('/'.md5('avipid'.date('m').env('APP_KEY')), [PreIdentificationController::class, 'autoVerifyIfPaymentIsDone'])->name('pre-identification.payment.verify');
Route::get('/'.md5('get-pi'.date('m').env('APP_KEY')), [PreIdentificationController::class, 'search'])->name('pre-identification.payment.done');
/* Front Office URLs on readable QR Code Routes */
Route::get('/get', [PreIdentificationController::class, 'search'])->name('pre-identification.recu.check.url');
Route::get('/check-certificat-pre-identification', [PreIdentificationController::class, 'checkCertificate'])->name('pre-identification.check.url');
/* File Downloads Routes */
Route::get('/telecharger-certificat-pre-identification-pdf', [PreIdentificationController::class, 'downloadCertificateConformitePDF'])->name('pre-identification.download.pdf');
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
        Route::get('/traitement-demandes-certificat-pre-identification', [ProcessPreIdentificationController::class, 'show'])->name('admin.certificat');
        Route::get('/datatables/french', [ProcessPreIdentificationController::class, 'showDatatablesFrench'])->name('datatables.french.json');
        Route::post(sha1('/traitement-demandes-certificat-pre-identification'.date('Ymd').env('APP_KEY')), [ProcessPreIdentificationController::class, 'getClient'])->name('admin.pre-identification.datatable');
        Route::post('/data/customer/{numero_dossier}', [ProcessPreIdentificationController::class, 'getClientByNumeroDossier'])->name('admin.pre-identification.client.get');
        Route::post(sha1('/data/customer/approved'.date('Ymd').env('APP_KEY')).'/{numero_dossier}', [ProcessPreIdentificationController::class, 'approveClientByNumeroDossier'])->name('admin.pre-identification.client.approve');
        Route::post(sha1('/data/customer/denied'.date('Ymd').env('APP_KEY')).'/{numero_dossier}', [ProcessPreIdentificationController::class, 'denyClientByNumeroDossier'])->name('admin.pre-identification.client.deny');
        Route::post(sha1('/data/customer/signed'.date('Ymd').env('APP_KEY')).'/{numero_dossier}', [ProcessPreIdentificationController::class, 'setSignedClientByNumeroDossier'])->name('admin.pre-identification.client.signed');
        Route::post(sha1('/data/customer/withdrawn'.date('Ymd').env('APP_KEY')).'/{numero_dossier}', [ProcessPreIdentificationController::class, 'setWithdrawnClientByNumeroDossier'])->name('admin.pre-identification.client.withdrawn');
    });

});

