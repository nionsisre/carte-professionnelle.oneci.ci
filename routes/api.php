<?php

use App\Http\Controllers\FrontOffice\PreIdentificationController;
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

/*
|--------------------------------------------------------------------------
| Back Office Routes
|--------------------------------------------------------------------------
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
