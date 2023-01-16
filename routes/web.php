<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\OTPVerificationController;

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
Route::post('/send-otp-code', [OTPVerificationController::class, 'sendOTP'])->name('envoi_code_otp_par_sms');
Route::post('/verify-otp-code', [OTPVerificationController::class, 'verifyOTP'])->name('verification_code_otp_soumis');
Route::post('/get-payment-link', [IdentificationController::class, 'getPaymentLink'])->name('obtenir_lien_de_paiement');

/* CinetPAY notify routes */
Route::post('/cinetpay/notify', [IdentificationController::class, 'notifyCinetPayAPI'])->name('lien_cinetpay_paiement_effectue');
Route::post('/cinetpay/return', [IdentificationController::class, 'returnCinetPayAPI'])->name('lien_cinetpay_paiement');
Route::post('/cinetpay/cancel', [IdentificationController::class, 'cancelCinetPayAPI'])->name('lien_cinetpay_paiement_annule');
