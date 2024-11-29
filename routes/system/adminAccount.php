<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\system\adminAccount;
use App\Http\Middleware\CheckLogin;


// Route::prefix('/adminAccount')->group(function () {
//     Route::get('/', [adminAccount::class, 'getall'])->name('adminAccount-getall')->middleware(CheckLogin::class);
//     Route::get('/add', [adminAccount::class, 'create'])->name('adminAccount-create')->middleware(CheckLogin::class);
//     Route::post('/add', [adminAccount::class, 'createHandle'])->name('adminAccount-add')->middleware(CheckLogin::class);
//     Route::get('/edit/{id}', [adminAccount::class, 'edit'])->name('adminAccount-edit')->middleware(CheckLogin::class);
//     Route::post('/edit/{id}', [adminAccount::class, 'editHandle'])->name('adminAccount-update')->middleware(CheckLogin::class);
//     Route::delete('/delete/{id}', [adminAccount::class, 'deleteHandle'])->name('adminAccount-delete')->middleware(CheckLogin::class);
//     Route::post('/add-coin/{id}', [adminAccount::class, 'addCoin'])->name('adminAccount-add-coin')->middleware(CheckLogin::class);
// });
