<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
    Route::controller(PeminjamanController::class)->group(function () {
        Route::get('admin/home', 'home');
        Route::get('admin/peminjaman', 'index');
        Route::post('admin/create-peminjaman', 'store');
        Route::post('admin/edit-peminjaman', 'update');
        Route::get('admin/delete-peminjaman/{id}', 'delete');
        Route::get('admin/export-peminjaman', 'export');
        Route::post('admin/import-peminjaman', 'import');
        Route::get("/logout",  "logout");
    });
    Route::controller(BukuController::class)->group(function () {
        Route::get('admin/buku', 'index');
        Route::post('admin/create-buku', 'store');
        Route::post('admin/edit-buku', 'update');
        Route::get('admin/delete-buku/{id}', 'delete');
    });
    Route::controller(LogController::class)->group(function () {
        Route::get('admin/log', 'index');
        Route::get('admin/delete-log/{id}', 'delete');
    });
});

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('postLogin', "postLogin")->middleware('throttle:login');
        Route::get('/register', 'register');
        Route::post('postRegister', 'postRegister');
        Route::get('/forgot', 'forgot')->name('password.request');
        Route::post('postForgot', 'postForgot')->name('password.email');
        Route::get('/reset/{token}', 'reset')->name('password.reset');
        Route::post('postReset', 'postReset')->name('password.update');
    });
});
