<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\NilaiSiswa;
use App\Models\HasilPrediksi;
use App\Services\FuzzyService;

class NilaiSiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('kelas', 'XII')->with('nilaisiswa')->get();

        //  Hanya ambil kriteria input (bukan output)
        $kriteria = Kriteria::where('kode', '!=', 'OUT')->get();

        return view('pages.nilai.index', compact('siswa', 'kriteria'));
    }

    public function input($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        //  Hanya ambil kriteria input
        $kriteria = Kriteria::where('kode', '!=', 'OUT')->get();
        $nilai = NilaiSiswa::where('siswa_id', $siswa_id)->get()->keyBy('kriteria_id');

        return view('pages.nilai.input', compact('siswa', 'kriteria', 'nilai'));
    }

    public function store(Request $request, $siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        // Hanya ambil kriteria input
        $kriteriaList = Kriteria::where('kode', '!=', 'OUT')->get();

        if ($siswa->kelas !== 'XII') {
            return redirect()->back()->with('error', 'Hanya siswa kelas XII yang dapat diproses.');
        }

        foreach ($kriteriaList as $kriteria) {
            $nilaiInput = $request->input("nilai_{$kriteria->id}");

            if ($nilaiInput !== null) {
                NilaiSiswa::updateOrCreate(
                    [
                        'siswa_id' => $siswa_id,
                        'kriteria_id' => $kriteria->id
                    ],
                    [
                        'nilai' => $nilaiInput
                    ]
                );
            }
        }

        // Validasi domain fuzzy tersedia
        $incomplete = false;
        foreach ($kriteriaList as $kriteria) {
            if ($kriteria->subKriteria()->count() < 1) {
                $incomplete = true;
                break;
            }
        }

        if ($incomplete) {
            return redirect()->route('nilai.index')->with('error', 'Gagal memproses prediksi. Domain fuzzy belum lengkap untuk semua kriteria.');
        }

        //  Jalankan fuzzy inference
        $hasil = app(FuzzyService::class)->prediksi($siswa_id);

        HasilPrediksi::updateOrCreate([
            'siswa_id' => $siswa_id
        ], [
            'nilai_fuzzy' => $hasil['nilai_fuzzy'],
            'hasil_prediksi' => $hasil['output'],
            'tanggal_prediksi' => now()->toDateString()
        ]);

        return redirect()->route('nilai.index')->with('success', 'Nilai & prediksi berhasil disimpan.');
    }
}
