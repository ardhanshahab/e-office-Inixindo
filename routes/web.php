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

Auth::routes(['Register'=> false, 'password.request' => false, 'password.email' =>  false, 'password.reset' =>  false, 'password.update' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'updateData'])->name('user.update');
Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('/user/{id}/password', [App\Http\Controllers\UserController::class, 'editPassword'])->name('user.editPassword');
Route::put('/user/{id}/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.updatePassword');
Route::post('/user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

Route::group(['middleware'=>'Admin'],function(){
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class,'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
});
