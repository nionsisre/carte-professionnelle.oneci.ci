<?php

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

/* Routes Vues */
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('accueil');
Route::get('/consultation-statut-identification', [App\Http\Controllers\MainController::class, 'consultation'])->name('consultation_statut_identification');

/* Routes Traitements */
Route::post('/soumettre-identification', [App\Http\Controllers\IdentificationController::class, 'submit'])->name('soumettre_identification');
Route::post('/consulter-statut-identification', [App\Http\Controllers\IdentificationController::class, 'search'])->name('consulter_statut_identification');;

