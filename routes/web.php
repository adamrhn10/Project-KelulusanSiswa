<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\NilaiSiswaController;
use App\Http\Controllers\AturanFuzzyController;
use App\Http\Controllers\HasilPrediksiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Siswa Route
Route::resource('siswa', SiswaController::class);

// Kriteria Route
Route::resource('kriteria', KriteriaController::class)->parameters([
    'kriteria' => 'kriteria'
]);

// SubKriteria Route
Route::resource('subkriteria', SubKriteriaController::class)->parameters(['subkriteria'=> 'subkriteria']);

// Aturan Route
Route::resource('aturan', AturanFuzzyController::class);
Route::post('/aturan/generate-auto', [AturanFuzzyController::class, 'generateAuto'])->name('aturan.generateAuto');

// Nilai Route
Route::get('nilai', [NilaiSiswaController::class, 'index'])->name('nilai.index');
Route::get('nilai/{siswa}/input', [NilaiSiswaController::class, 'input'])->name('nilai.input');
Route::post('nilai/{siswa}/input', [NilaiSiswaController::class, 'store'])->name('nilai.store');

// Hasil Prediksi
Route::get('/hasil-prediksi', [HasilPrediksiController::class, 'index'])->name('prediksi.index');


// Auth
// Register
Route::get('/register', [AuthController::class, 'showregister']);
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showlogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout 
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Profile
Route::get('/profile', [AuthController::class, 'getProfile'])->middleware(('auth'));
Route::post('/profile', [AuthController::class, 'createProfile'])->middleware(('auth'));
Route::put('/profile/{id}', [AuthController::class, 'updateProfile'])->middleware(('auth'));