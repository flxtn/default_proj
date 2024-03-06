<?php

use App\Http\Controllers\AuthController;
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


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/two-factor-qr/{id}', [AuthController::class, 'EnableTwoFa'])->name('two-factor-qr');
Route::post('/two-factor-login/{id}', [AuthController::class, 'TwoFactorLogin'])->name('two-factor-login');