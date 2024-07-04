<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Halaman login
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');

// verifikasi login atau alert 
Route::post('/', [LoginController::class, 'authenticate']);

// Logout user
Route::post('/logout', [LoginController::class, 'logout']);

// Halaman Anggota
Route::resource('/data/anggota', UserController::class)->middleware('auth');

// Edit Anggota
Route::get('/data/anggota/update/{id}', [UserController::class, 'updateanggota'])->middleware('auth');

// Halaman Buku
Route::resource('/data/buku', BukuController::class)->middleware('auth');

// Halaman Peminjaman
Route::resource('/data/peminjaman', PeminjamanController::class)->middleware('auth');

Route::get('/data/peminjaman/baru/{id}', [PeminjamanController::class, 'peminjaman'])->middleware('auth');
