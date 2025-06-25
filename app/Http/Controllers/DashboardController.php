<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\HasilPrediksi;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil prediksi terbaru
        $prediksiTerbaru = HasilPrediksi::with('siswa')
            ->latest('tanggal_prediksi')
            ->take(5)
            ->get();

        // Kirim semua data ke view
        return view('pages.dashboard', [
            'prediksiTerbaru' => $prediksiTerbaru,
            'totalSiswa' => Siswa::count(),
            'totalPrediksi' => HasilPrediksi::count(),
            'jumlahLulus' => HasilPrediksi::where('hasil_prediksi', 'Lulus')->count(),
            'jumlahDipertimbangkan' => HasilPrediksi::where('hasil_prediksi', 'Dipertimbangkan')->count(),
            'jumlahTidakLulus' => HasilPrediksi::where('hasil_prediksi', 'Tidak Lulus')->count(),
        ]);
    }
}
