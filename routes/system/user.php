<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\system\userController;
use App\Http\Middleware\CheckLogin;


Route::prefix('/user')->group(function () {
    Route::get('/', [userController::class, 'getall'])->name('user-getall')->middleware(CheckLogin::class);
    Route::get('/add', [userController::class, 'create'])->name('user-create')->middleware(CheckLogin::class);
    Route::post('/add', [userController::class, 'createHandle'])->name('user-add')->middleware(CheckLogin::class);
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user-edit')->middleware(CheckLogin::class);
    Route::post('/edit/{id}', [UserController::class, 'editHandle'])->name('user-update')->middleware(CheckLogin::class);
    Route::delete('/delete/{id}', [userController::class, 'deleteHandle'])->name('user-delete')->middleware(CheckLogin::class);
    Route::post('/add-coin/{id}', [UserController::class, 'addCoin'])->name('user-add-coin')->middleware(CheckLogin::class);
});
