<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLoggedOut;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login-form');
Route::post('/login', [AuthController::class, 'loginHandle'])->name('login-submit');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register-form');
Route::post('/register', [AuthController::class, 'registerHandle'])->name('register-submit');
Route::get('/logout', function () {

    $user = Auth::user();

    $user->is_online = false;  // Đánh dấu người dùng là offline
    $user->save();

    Auth::logout();

    session()->invalidate();
    session()->regenerateToken();

    return redirect()->route('client.wellcome');
})->name('logout');
