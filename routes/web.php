<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses');
Route::get('login/keluar', [LoginController::class, 'keluar'])->name('login.keluar');


//Route::middleware(['auth', IsAdmin::class])->group(function () {   

    Route::get('users', function () {
        return view('users.index');
    })->name('users')->middleware('auth');

    Route::get('iphone', function () {
        return view('iphone.index');
    })->name('iphone')->middleware('auth');

    Route::get('transaksi', function () {
        return view('transaksi.index');
    })->name('transaksi')->middleware('auth');

    Route::get('laporan', function () {
        return view('laporan.index');
    })->name('laporan')->middleware('auth');
//});

Route::middleware(['auth',IsUser::class])->group(function(){
    
});