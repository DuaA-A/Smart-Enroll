<?php
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Non-localized routes (default behavior)
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
Route::get('/', [RegisterController::class, 'show'])->name('register');
Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');
Route::post('/check-whatsapp', [RegisterController::class, 'checkWhatsApp'])->name('check.whatsapp');
Route::get('/welcome/{username}', [RegisterController::class, 'welcome'])->name('welcome');
Route::resource('/users', UserController::class);

// Localized routes (with locale prefix)
Route::middleware('setapplang')->prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function(){
    Route::get('/register', [RegisterController::class, 'show'])->name('localized.register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('localized.register.store');
    Route::get('/', [RegisterController::class, 'show'])->name('localized.register');
    Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('localized.check.username');
    Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('localized.check.email');
    //Route::post('/check-whatsapp', [RegisterController::class, 'checkWhatsApp'])->name('localized.check.whatsapp');
    Route::get('/welcome/{username}', [RegisterController::class, 'welcome'])->name('localized.welcome');
    Route::resource('/users', UserController::class, ['as' => 'localized']);
});
    
// Fallback for root URL
Route::fallback(function () {
    return redirect('/'.config('app.locale', 'en'));
});
