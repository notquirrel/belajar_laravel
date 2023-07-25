<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

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
        Route::get("/logout",  "logout");
    });
    Route::controller(BukuController::class)->group(function () {
        Route::get('admin/buku', 'index');
        Route::post('admin/create-buku', 'store');
        Route::post('admin/edit-buku', 'update');
        Route::get('admin/delete-buku/{id}', 'delete');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->middleware('guest');
    Route::post('postLogin', "postLogin")->middleware('throttle:login');
});
