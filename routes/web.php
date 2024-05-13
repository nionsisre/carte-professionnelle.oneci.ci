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
Route::get('/formulaire', [CertificatConformiteController::class, 'showFormulaire'])->name('certificat.index');
Route::get('/consultation', [CertificatConformiteController::class, 'showConsultation'])->name('certificat.consultation');
//Route::get('/reclamation-paiement', [CertificatConformiteController::class, 'showReclamationPaiement'])->name('certificat.reclamation_paiement');
    /* NNI Verif API Gateway */
Route::get('/'.md5('verifapi'.date('Y-m-d').env('APP_KEY')), [CertificatConformiteController::class, 'verifapi'])->name('verifapi.nni');


/* --- Pré-identification --- */
Route::get('/menu-pre-identification', [PreIdentificationController::class, 'showMenuPreIdentification'])->name('front_office.pre_identification.menu');
Route::get('/pre-identification-abonnes-mobile', [PreIdentificationController::class, 'showPreIdentification'])->name('front_office.pre_identification.page');
Route::get('/consultation-pre-identification', [PreIdentificationController::class, 'showConsultation'])->name('front_office.pre_identification.consultation');
/* --- Formulaire Spécial CAN --- */
Route::get('/menu-special-can', [SpecialCANController::class, 'showMenuSpecialCAN'])->name('front_office.special_can.menu');
Route::get('/identification-special-can', [SpecialCANController::class, 'showIdentificationSpecialCAN'])->name('front_office.special_can.consultation');



/* Front Office Form Submit Routes URL */
Route::post('/soumettre-identification', [CertificatConformiteController::class, 'submit'])->name('front_office.form.soumettre_identification');
Route::post('/consulter-statut-identification', [CertificatConformiteController::class, 'search'])->name('front_office.form.consulter_statut_identification');
Route::post('/soumettre-pre-identification', [PreIdentificationController::class, 'submit'])->name('front_office.form.soumettre_pre_identification');
Route::post('/soumettre-reclamation-paiement', [ReclamationController::class, 'submit'])->name('front_office.form.soumettre_reclamation_paiement');
Route::post('/consulter-nni-special-can', [SpecialCANController::class, 'consulterInfoNNI'])->name('front_office.form.consulter_nni_special_can');
Route::post('/'.md5('soumettre-identification-special-can'.date('d')), [SpecialCANController::class, 'submit'])->name('front_office.form.soumettre_identification_special_can');

/* Front Office Internal JavaScript Ajax / Axios Scripts Routes */
Route::post('/'.md5('cimiai'.date('m')), [CertificatConformiteController::class, 'checkIfMsisdnIsAlreadyIdentifed'])->name('front_office.scripts.msisdn.is_already_identified');
Route::post('/'.md5('gcpl'.date('m')), [CertificatConformiteController::class, 'getCertificatePaymentLink'])->name('front_office.scripts.certificat_identification.payment_link.get');
Route::post('/'.md5('avipid'.date('m')), [CertificatConformiteController::class, 'autoVerifyIfPaymentIsDone'])->name('front_office.identification.script.payment.verify');
Route::post('/'.md5('soc'.date('m')), [OTPVerificationController::class, 'sendOTP'])->name('front_office.scripts.otp_code.send');
Route::post('/'.md5('voc'.date('m')), [OTPVerificationController::class, 'verifyOTP'])->name('front_office.scripts.otp_code.verify');
Route::post('/'.md5('gpcpl'.date('m')), [PreIdentificationController::class, 'getCertificatePaymentLink'])->name('front_office.scripts.certificat_pre_identification.payment_link.get');
Route::post('/'.md5('avippid'.date('m')), [PreIdentificationController::class, 'autoVerifyIfPaymentIsDone'])->name('front_office.pre_identification.script.payment.verify');
Route::get('/'.md5('get-pi'.date('m')), [PreIdentificationController::class, 'search'])->name('front_office.pre_identification.script.payment.done');

/* Front Office URLs on readable QR Code Routes */
Route::get('/get', [CertificatConformiteController::class, 'search'])->name('front_office.auth.recu_identification.url');
Route::get('/get-pi', [PreIdentificationController::class, 'search'])->name('front_office.auth.recu_pre_identification.url');
Route::get('/check-certificat-identification', [CertificatConformiteController::class, 'checkCertificate'])->name('front_office.auth.certificat_identification.url');
Route::get('/'.md5('ccpi'), [PreIdentificationController::class, 'checkCertificate'])->name('front_office.auth.certificat_pre_identification.url');

/* Front Office File Downloads Routes */
Route::get('/telecharger-recu-identification-pdf', [CertificatConformiteController::class, 'downloadRecuIdentificationPDF'])->name('front_office.download.recu_identification.pdf');
Route::get('/telecharger-certificat-identification-pdf', [CertificatConformiteController::class, 'downloadCertificateIdentificationPDF'])->name('front_office.download.certificat_identification.pdf');
Route::get('/telecharger-fiche-pre-identification-pdf', [PreIdentificationController::class, 'downloadCertificatePreIdentificationPDF'])->name('front_office.download.certificat_pre_identification.pdf');
Route::get('/qrcode', [QrCodeController::class, 'downloadQrCodeImage'])->name('front_office.download.qrcode_image');
Route::get('/telecharger-qrcode-carte-professionnelle', [QrCartesProfessionnellesController::class, 'downloadQrCodesAsZip'])->name('front_office.download.qrcode.zip');

/* Front Office CinetPAY routes */
Route::post('/cinetpay/notify', [CinetPayAPI::class, 'notify'])->name('front_office.cinetpay.notify');
Route::post('/cinetpay/return', [CinetPayAPI::class, 'return'])->name('front_office.cinetpay.return');
Route::post('/cinetpay/cancel', [CinetPayAPI::class, 'cancel'])->name('front_office.cinetpay.cancel');

/* Front Office CinetPAY routes */
Route::post('/check-status-payment', [NGSerAPI::class, 'notify'])->name('front_office.nsger.notify');
Route::get('/notification-post-payment', [NGSerAPI::class, 'return'])->name('front_office.ngser.return');


/*
|--------------------------------------------------------------------------
| Back Office Routes
|--------------------------------------------------------------------------
*/

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
    Route::post('/oneci-admin/traitement-validation-search', [AdminController::class, 'validationSearch'])->name('abonnees.validation.search');
    Route::put('/oneci-admin/traitement-validation-update', [AdminController::class, 'validationupdate'])->name('abonnees.validation.update');

    Route::get('logout', [LoginController::class,'logout'])->name('logout');
});
