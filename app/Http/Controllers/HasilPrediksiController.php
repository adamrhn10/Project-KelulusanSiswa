<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPrediksi;

class HasilPrediksiController extends Controller
{
    public function index()
    {
        $hasil = HasilPrediksi::with('siswa')->latest()->get();
        return view('pages.prediksi.index', compact('hasil'));
    }
}
