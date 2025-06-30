<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AturanFuzzyController;
use App\Http\Controllers\NilaiSiswaController;
use App\Http\Controllers\HasilPrediksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountSettingsController;

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

// Redirect "/" ke dashboard jika sudah login
Route::get('/', function () {
    return redirect()->route('dashboard');
});

//  Authentication Routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); // Consider if registration should be public or admin-only
    Route::post('/register', [AuthController::class, 'register']);
});


// Protected Routes (hanya untuk user login)
Route::middleware(['auth'])->group(function () {

    // General Authenticated Routes (Accessible by Admin & Guru)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);

    // Nilai Siswa Management
    Route::prefix('nilai')->name('nilai.')->group(function () {
        Route::get('/', [NilaiSiswaController::class, 'index'])->name('index');
        Route::get('/{siswa}/input', [NilaiSiswaController::class, 'input'])->name('input');
        Route::post('/{siswa}/input', [NilaiSiswaController::class, 'store'])->name('store');
    });

    // Prediction Results
    Route::get('/hasil-prediksi', [HasilPrediksiController::class, 'index'])->name('prediksi.index');
    Route::get('/hasil-prediksi/pdf', [HasilPrediksiController::class, 'cetakPdf'])->name('prediksi.pdf');


    // Admin-Specific Routes (Requires Admin Role, add 'admin' middleware if you have one)
    Route::group([], function () {

        // User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

        });

        Route::get('/account', [AccountSettingsController::class, 'editAccount'])->name('account.edit');
        Route::put('/account', [AccountSettingsController::class, 'updateAccount'])->name('account.update');

        // Kriteria, SubKriteria, Aturan Fuzzy Management
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
        Route::resource('subkriteria', SubKriteriaController::class);
        Route::resource('aturan', AturanFuzzyController::class);
        Route::post('/aturan/generate-auto', [AturanFuzzyController::class, 'generateAuto'])->name('aturan.generateAuto');
    });


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

