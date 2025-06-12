<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route Siswa (Menggunakan Resource Controller untuk CRUD)
// Ini akan membuat nama rute: siswa.index, siswa.create, siswa.store, siswa.edit, siswa.update, siswa.destroy
Route::resource('siswa', SiswaController::class);

// Route Nilai (Jika juga CRUD, bisa pakai resource juga)
Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index'); // Ubah nama rute ke nilai.index

// Route Hasil
Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index'); // Ubah nama rute ke hasil.index

// Tambahan: Untuk route update yang di SiswaController Anda ada update($id)
// Pastikan metode update di controller SiswaController menerima $id
// Jika Anda pakai Route::resource, maka rute ini sudah otomatis terbuat:
// GET /siswa/{siswa}/edit -> siswa.edit
// PUT/PATCH /siswa/{siswa} -> siswa.update
// Jadi Anda tidak perlu lagi Route::get('/siswa/update', [SiswaController::class, 'update']);