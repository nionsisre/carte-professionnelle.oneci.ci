<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\OTPVerificationController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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

/* View Routes */
Route::get('/', [MainController::class, 'index'])->name('accueil');
Route::get('/get', [IdentificationController::class, 'search'])->name('obtenir_info_abonne');
Route::get('/consultation-statut-identification', [MainController::class, 'consultation'])->name('consultation_statut_identification');
Route::get('/imprimer-recu-identification', [IdentificationController::class, 'printRecu'])->name('imprimer_recu_identification');
Route::get('/get-certificat-identification', [IdentificationController::class, 'getCertificate'])->name('obtenir_certificat_identification');
Route::get('/imprimer-certificat-identification', [IdentificationController::class, 'printCertificate'])->name('imprimer_certificat_identification');
Route::get('/check-certificat-identification', [IdentificationController::class, 'checkCertificate'])->name('checker_certificat_identification');
Route::get('/qrcode', [IdentificationController::class, 'generateQrCode'])->name('generate_qr_code');

/* Post Processing Only Routes */
Route::post('/soumettre-identification', [IdentificationController::class, 'submit'])->name('soumettre_identification');
Route::post('/consulter-statut-identification', [IdentificationController::class, 'search'])->name('consulter_statut_identification');
Route::post('/sc', [IdentificationController::class, 'statusCheck'])->name('verification_statut_numero_deja_verifie');
Route::post('/send-otp-code', [OTPVerificationController::class, 'sendOTP'])->name('envoi_code_otp_par_sms');
Route::post('/verify-otp-code', [OTPVerificationController::class, 'verifyOTP'])->name('verification_code_otp_soumis');
Route::post('/get-payment-link', [IdentificationController::class, 'getPaymentLink'])->name('obtenir_lien_de_paiement');

/* CinetPAY notify routes */
Route::post('/cinetpay/notify', [IdentificationController::class, 'notifyCinetPayAPI'])->name('lien_cinetpay_paiement_effectue');
Route::post('/cinetpay/return', [IdentificationController::class, 'returnCinetPayAPI'])->name('lien_cinetpay_paiement');
Route::post('/cinetpay/cancel', [IdentificationController::class, 'cancelCinetPayAPI'])->name('lien_cinetpay_paiement_annule');



// Login Routes
Route::get('/oneci-admin', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/oneci-admin-login', [LoginController::class,'login'])->name('authentificaton');
Route::get('/oneci-password-rest', [LoginController::class,'restPassword'])->name('password.rest');
Route::put('/oneci-update-password', [LoginController::class,'updatePassword'])->name('oneci.update.password');

// Security
Route::middleware('connected')->group(function (){
    Route::get('/oneci-admin/home', [AdminController::class, 'index'])->name('admin_home');
    Route::get('/oneci-admin/rapport', [AdminController::class, 'rapport'])->name('rapport');
    Route::get('/oneci-admin/setting', [AdminController::class, 'setting'])->name('setting');
    Route::get('/oneci-admin/setting-user', [AdminController::class, 'adduser'])->name('user');
    Route::post('/oneci-admin/setting-add-user', [AdminController::class, 'postadduser'])->name('add.user');
    Route::put('/oneci-admin/setting-update-user', [AdminController::class, 'updateuser'])->name('update.user');
    Route::post('/oneci-admin/rapport-search', [AdminController::class, 'rapportsearch'])->name('rapport.search');

    Route::post('/oneci-admin/operateur-search-export', [AdminController::class, 'operateur'])->name('operateur.search.export');

    Route::post('/oneci-admin/rapport-export', [AdminController::class, 'export'])->name('rapport.export');
    Route::put('/oneci-admin/rapport-import', [AdminController::class, 'import'])->name('rapport.import');

    Route::get('/oneci-admin/exportation', [AdminController::class, 'exportation'])->name('abonnees.exportation');
    Route::get('/oneci-admin/importation', [AdminController::class, 'importation'])->name('abonnees.importation');

    Route::get('/oneci-admin/traitement', [AdminController::class, 'validation'])->name('abonnes.validation');
    Route::put('/oneci-admin/traitement-validation-update', [AdminController::class, 'validationupdate'])->name('abonnees.validation.update');

    Route::get('logout', [LoginController::class,'logout'])->name('logout');
});
