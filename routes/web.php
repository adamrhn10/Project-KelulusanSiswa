<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\NilaiRaporController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\AturanFuzzyController;
use Illuminate\Support\Facades\Route;

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route Siswa (Menggunakan Resource Controller untuk CRUD)
// Ini akan membuat nama rute: siswa.index, siswa.create, siswa.store, siswa.edit, siswa.update, siswa.destroy
Route::resource('siswa', SiswaController::class);

// Route Nilai (Jika juga CRUD, bisa pakai resource juga)
Route::get('/nilai', [NilaiRaporController::class, 'index'])->name('nilai.index'); // Ubah nama rute ke nilai.index
Route::get('/nilai/{id}/edit', [NilaiRaporController::class, 'edit'])->name('nilai.edit'); // Ubah nama rute ke nilai.index
Route::put('/nilai/{id}', [NilaiRaporController::class, 'update'])->name('nilai.update'); // Ubah nama rute ke nilai.index

Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prediksi.index');
Route::post('/prediksi', [PrediksiController::class, 'proses'])->name('prediksi.proses');


// Route Hasil
Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index'); // Ubah nama rute ke hasil.index

// Route Aturan Fuzzy
Route::resource('rules', AturanFuzzyController::class);