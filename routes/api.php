<?php

use App\Http\Controllers\FrontOffice\PreIdentificationController;
use App\Http\Controllers\OstatPlus\ReportController;
use App\Http\Controllers\OstatPlus\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| Android App Identification Mobile ONECI API Routes
|--------------------------------------------------------------------------
*/
Route::post('/user', [PreIdentificationController::class, 'userAppLogin'])->name('front_office.pre_identification.api.user');
Route::post('/ostatplus/login', [UserController::class, 'userAppLogin'])->name('api.user');
Route::post('/ostatplus/agence-list', [ReportController::class, 'getAgenciesList'])->name('api.agence');
Route::get('/ostatplus/report', [ReportController::class, 'getReport'])->name('api.report');
Route::post('/ostatplus/report', [ReportController::class, 'createReport'])->name('api.report.create');
Route::put('/ostatplus/report', [ReportController::class, 'editReport'])->name('api.report.edit');

/*
|--------------------------------------------------------------------------
| Back Office Routes
|--------------------------------------------------------------------------
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
