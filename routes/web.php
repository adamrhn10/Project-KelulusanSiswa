<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route Siswa CRUD
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
// Create
Route::get('/siswa/create', [SiswaController::class, 'create']);

// Update
Route::get('/siswa/update', [SiswaController::class, 'update']);





Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
Route::get('/hasil', [HasilController::class, 'index'])->name('hasil');
