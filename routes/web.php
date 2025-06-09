<?php
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::get('/', [RegisterController::class, 'show'])->name('register');
Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');
//Route::post('/check-whatsapp', [RegisterController::class, 'checkWhatsApp'])->name('check.whatsapp');
Route::get('/welcome/{username}', [RegisterController::class, 'welcome'])->name('welcome');
Route::resource('/users', UserController::class);
