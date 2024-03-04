<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TwoFAController;
use Illuminate\Support\Facades\Route;

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






Route::middleware("guest")->group(function(){
    Route::get('/login', [AuthController::class, 'LoginPage'])->name('loginPage');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'RegisterPage'])->name('registerPage');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/two-factor-qr/{id}', [AuthController::class, 'EnableTwoFa'])->name('two-factor-qr');
    Route::post('/two-factor-login/{id}', [AuthController::class, 'TwoFactorLogin'])->name('two-factor-login');
});

Route::middleware("auth")->group(function(){
    Route::get('/', [IndexController::class, 'index'])->name('homePage');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


