<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/rkmAPI', \App\Http\Controllers\Api\RKMController::class);
// Route::get('rkmAPI', [App\Http\Controllers\UserController::class, 'index']);
Route::get('rkmAPI/{year}/{month}', [App\Http\Controllers\Api\RKMController::class, 'showMonth']);
Route::get('perusahaan', [App\Http\Controllers\Api\PerusahaanController::class, 'getPerusahaan'])->name('getPerusahaan');
Route::get('getRKMRegist', [App\Http\Controllers\Api\RKMController::class, 'getRKMRegist'])->name('getRKMRegist');
Route::get('cek-peserta', [App\Http\Controllers\Api\PesertaController::class, 'cekPeserta'])->name('cekPeserta');
Route::get('getRKMDetail', [App\Http\Controllers\Api\RKMController::class, 'getRKMDetail'])->name('getRKMDetail');
Route::get('registrasi/list/{id_peserta}', [App\Http\Controllers\Api\PesertaController::class, 'listMateri'])->name('listMateri');
// Route::get('/cek-peserta', 'PesertaController@cekPeserta')->name('cekPeserta');
Route::get('getRKMByMonthNow', [App\Http\Controllers\Api\RKMController::class, 'getRKMByMonthNow'])->name('getRKMByMonthNow');
Route::get('getFeedbacks', [App\Http\Controllers\Api\apiController::class, 'getFeedbacks'])->name('getFeedbacks');
Route::get('getMateri', [App\Http\Controllers\Api\apiController::class, 'getMateri'])->name('getMateri');
Route::get('getPerusahaanall', [App\Http\Controllers\Api\apiController::class, 'getPerusahaanall'])->name('getPerusahaanall');
Route::get('getRegistrasiall', [App\Http\Controllers\Api\apiController::class, 'getRegistrasiall'])->name('getRegistrasiall');
Route::get('getPesertaall', [App\Http\Controllers\Api\apiController::class, 'getPesertaall'])->name('getPesertaall');
Route::get('getUserall', [App\Http\Controllers\Api\apiController::class, 'getUserall'])->name('getUserall');
Route::get('getJabatan', [App\Http\Controllers\Api\apiController::class, 'getJabatan'])->name('getJabatan');



