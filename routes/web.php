<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::redirect('/', '/login');

Auth::routes(['register'=> false, 'password.request' => false, 'password.email' =>  false, 'password.reset' =>  false, 'password.update' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/karyawan/{id}/edit', [App\Http\Controllers\KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/{id}', [App\Http\Controllers\KaryawanController::class, 'updateData'])->name('karyawan.update');
    Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/password', [App\Http\Controllers\UserController::class, 'editPassword'])->name('user.editPassword');
    Route::put('/user/{id}/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.updatePassword');
    Route::post('/user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/gantifoto/{id}', [App\Http\Controllers\KaryawanController::class, 'gantiFoto'])->name('karyawan.gantiFoto');
    Route::put('/gantifoto/{id}', [App\Http\Controllers\KaryawanController::class, 'updateFoto'])->name('karyawan.updateFoto');
    Route::post('/registrasi', [App\Http\Controllers\UserController::class, 'regist'])->name('user.regist');
});
// test
Route::get('/testdata', [App\Http\Controllers\TestController::class, 'index'])->name('testdata');
Route::get('/datas', [App\Http\Controllers\UserController::class, 'datas'])->name('datauser');
Route::get('/datarkm/{tahun}/{bulan}', [App\Http\Controllers\PerusahaanController::class, 'datas'])->name('datarkm');
// Route::post('/change-year', 'HomeController@changeYear')->name('changeYear');
// test

Route::resource('/comment', \App\Http\Controllers\CommentController::class);

Route::resource('/perusahaan', \App\Http\Controllers\PerusahaanController::class);
Route::resource('/materi', \App\Http\Controllers\MateriController::class);
Route::resource('/rkm', \App\Http\Controllers\RKMController::class);
Route::get('/rkmEditInstruktur', [App\Http\Controllers\RKMController::class, 'editInstruktur'])->name('editInstruktur');
Route::put('/rkmUpdateInstruktur', [App\Http\Controllers\RKMController::class, 'updateInstruktur'])->name('updateInstruktur');
Route::get('/rkmEdit', [App\Http\Controllers\RKMController::class, 'editRKM'])->name('rkmEdit');
Route::put('/rkmUpdate', [App\Http\Controllers\RKMController::class, 'updateRKM'])->name('rkmUpdate');

Route::group(['middleware'=>'Admin'],function(){
    Route::get('/user/register', [App\Http\Controllers\UserController::class, 'create'])->name('user.register');
});

