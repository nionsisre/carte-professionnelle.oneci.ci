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
Route::get('/consultation-statut-identification', [MainController::class, 'consultation'])->name('consultation_statut_identification');
Route::get('/imprimer-recu-identification', [IdentificationController::class, 'print'])->name('imprimer_recu_identification');
Route::get('/qrcode', [IdentificationController::class, 'generateQrCode'])->name('generate_qr_code');

/* Processing Routes */
Route::post('/soumettre-identification', [IdentificationController::class, 'submit'])->name('soumettre_identification');
Route::post('/consulter-statut-identification', [IdentificationController::class, 'search'])->name('consulter_statut_identification');
Route::post('/send-otp-code', [OTPVerificationController::class, 'sendSMS'])->name('envoi_code_otp_par_sms');
