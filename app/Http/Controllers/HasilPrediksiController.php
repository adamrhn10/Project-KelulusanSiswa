<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPrediksi;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilPrediksiController extends Controller
{
    public function index()
    {
        $hasil = HasilPrediksi::with('siswa')->latest()->get();
        return view('pages.prediksi.index', compact('hasil'));
    }

    public function cetakPdf()
    {
        $hasilPrediksi = HasilPrediksi::with('siswa')->get();

        return Pdf::loadView('pages.prediksi.cetak', compact('hasilPrediksi'))
          ->stream('hasil-prediksi-kelulusan.pdf');

    }
}
