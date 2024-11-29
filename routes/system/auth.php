<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\system\authController;
use Illuminate\Support\Facades\Auth;

Route::get('/login', [authController::class, 'login'])->name('login');
Route::post('/login', [authController::class, 'loginHandle'])->name('login-submit');
Route::post('logout', function () {
    Auth::logout(); // Thực hiện logout người dùng
    return redirect('system/login'); // Chuyển hướng về trang login
})->name('logout');
