<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('layouts.master');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/analytics', function () {
    return view('pages.analytics');
})->name('analytics');

Route::get('/settings', function () {
    return view('pages.settings');
})->name('settings');