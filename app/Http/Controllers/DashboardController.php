<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\NilaiRapor;
use App\Models\HasilPrediksi;
use App\Models\AturanFuzzy;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalPenilaian = NilaiRapor::count();
        $totalHasil = HasilPrediksi::count();
        $totalFuzzy = AturanFuzzy::count();

        return view('pages.dashboard', compact('totalSiswa', 'totalPenilaian', 'totalHasil', 'totalFuzzy'));
    }
}
