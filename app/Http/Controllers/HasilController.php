<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;


class HasilController extends Controller
{
    public function index()
    {
        $hasil = Siswa::with('hasilPrediksi')->get();
        return view('pages.hasil.index', compact('hasil'));
    }
}
