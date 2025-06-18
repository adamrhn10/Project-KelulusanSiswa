<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\NilaiRapor;
use App\Models\HasilPrediksi;
use App\Models\AturanFuzzy;

class PrediksiController extends Controller
{
    /**
     * Tampilkan halaman prediksi
     */
    public function index()
    {
        $siswa = Siswa::with(['nilaiRapor', 'hasilPrediksi'])->get();
        return view('pages.prediksi.index', compact('siswa'));
    }

    /**
     * Jalankan proses prediksi fuzzy mamdani ke semua siswa
     */
    public function proses()
    {
        $siswaList = Siswa::with('nilaiRapor')->get();

        foreach ($siswaList as $siswa) {
            $nilai = $siswa->nilaiRapor;

            if (!$nilai) continue;

            $rapor = [
                $nilai->rapor1,
                $nilai->rapor2,
                $nilai->rapor3,
                $nilai->rapor4,
                $nilai->rapor5,
            ];

            $nilaiFuzzy = $this->fuzzyMamdani($rapor);

            HasilPrediksi::updateOrCreate(
                ['siswa_id' => $siswa->id],
                [
                    'nilai_fuzzy' => $nilaiFuzzy,
                    'hasil_prediksi' => $nilaiFuzzy >= 80 ? 'Lulus' : 'Tidak Lulus',
                    'tanggal_prediksi' => now(),
                ]
            );
        }

        return redirect()->route('prediksi.index')->with('success', 'Prediksi berhasil dilakukan.');
    }

    /**
     * Proses fuzzy mamdani lengkap (fuzzifikasi, inferensi, defuzzifikasi)
     */
    private function fuzzyMamdani(array $rapor): float
    {
        // Langkah 1: Fuzzifikasi setiap nilai rapor ke μ[Rendah, Sedang, Tinggi]
        $keanggotaan = array_map(fn($x) => $this->fuzzifikasi($x), $rapor);

        // Langkah 2: Ambil semua aturan fuzzy dari database
        $aturanList = AturanFuzzy::all();

        // Langkah 3: Evaluasi inferensi dengan metode MIN
        $output = ['Lulus' => [], 'Tidak Lulus' => []];

        foreach ($aturanList as $rule) {
            $minμ = min(
                $keanggotaan[0][$rule->rapor1],
                $keanggotaan[1][$rule->rapor2],
                $keanggotaan[2][$rule->rapor3],
                $keanggotaan[3][$rule->rapor4],
                $keanggotaan[4][$rule->rapor5],
            );

            $output[$rule->output][] = $minμ;
        }

        // Langkah 4: Gabungkan hasil dengan MAX
        $μLulus = max($output['Lulus'] ?? [0]);
        $μTidakLulus = max($output['Tidak Lulus'] ?? [0]);

        // Langkah 5: Defuzzifikasi (Center of Gravity)
        $domainOutput = [
            60 => $μTidakLulus,
            70 => $μTidakLulus,
            80 => $μLulus,
            90 => $μLulus,
            100 => $μLulus,
        ];

        $numerator = 0;
        $denominator = 0;

        foreach ($domainOutput as $z => $μ) {
            $numerator += $z * $μ;
            $denominator += $μ;
        }

        return $denominator > 0 ? round($numerator / $denominator, 2) : 0.0;
    }

    /**
     * Fuzzifikasi satu nilai rapor → μ Rendah, Sedang, Tinggi
     */
    private function fuzzifikasi(float $x): array
    {
        $rendah = 0;
        $sedang = 0;
        $tinggi = 0;

        // μ Rendah: 0 - 57 - 67
        if ($x <= 57) {
            $rendah = 1;
        } elseif ($x <= 67) {
            $rendah = (67 - $x) / 10;
        }

        // μ Sedang: 62 - 73 - 85
        if ($x >= 62 && $x <= 73) {
            $sedang = ($x - 62) / 11;
        } elseif ($x > 73 && $x <= 85) {
            $sedang = (85 - $x) / 12;
        }

        // μ Tinggi: 75 - 88 - 100
        if ($x >= 75 && $x <= 88) {
            $tinggi = ($x - 75) / 13;
        } elseif ($x > 88) {
            $tinggi = 1;
        }

        return [
            'Rendah' => round($rendah, 4),
            'Sedang' => round($sedang, 4),
            'Tinggi' => round($tinggi, 4),
        ];
    }
}



//         private function fuzzyMamdani(array $rapor): float
//     {
//     // 1. Fuzzifikasi – ubah nilai rapor ke kategori linguistik
//     $kategori = array_map(function ($nilai) {
//         return $this->tentukanLinguistik($nilai);
//     }, $rapor);

//     // 2. Temukan aturan fuzzy yang cocok
//     $rule = AturanFuzzy::where([
//         'rapor1' => $kategori[0],
//         'rapor2' => $kategori[1],
//         'rapor3' => $kategori[2],
//         'rapor4' => $kategori[3],
//         'rapor5' => $kategori[4],
//     ])->first();

//     $outputKategori = $rule?->output ?? 'Tidak Lulus';

//     // 3. Defuzzifikasi (berdasarkan domain output)
//     // Gunakan Center of Gravity seperti pada artikel kamu
//     // Domain: 65–100
//     // Aturan:
//     // - "Lulus" → μ(x) Lurus naik dari 70 ke 100
//     // - "Tidak Lulus" → μ(x) turun dari 65 ke 85

//     if ($outputKategori === 'Lulus') {
//         // Lulus penuh → nilai tinggi (contoh: rata-rata 85–95)
//         return 85 + rand(0, 15); // simulasi defuzzifikasi Lulus
//     } else {
//         // Tidak Lulus → nilai 60–75
//         return 60 + rand(0, 15); // simulasi defuzzifikasi Tidak Lulus
//     }
// }

//     private function tentukanLinguistik(float $x): string
// {
//     $rendah = 0;
//     $sedang = 0;
//     $tinggi = 0;

//     if ($x <= 57) {
//         $rendah = 1;
//     } elseif ($x <= 67) {
//         $rendah = (67 - $x) / 10;
//     }

//     if ($x >= 62 && $x <= 73) {
//         $sedang = ($x - 62) / 11;
//     } elseif ($x > 73 && $x <= 85) {
//         $sedang = (85 - $x) / 12;
//     }

//     if ($x >= 75 && $x <= 88) {
//         $tinggi = ($x - 75) / 13;
//     } elseif ($x > 88) {
//         $tinggi = 1;
//     }

//     if ($rendah >= $sedang && $rendah >= $tinggi) {
//         return 'Rendah';
//     } elseif ($sedang >= $rendah && $sedang >= $tinggi) {
//         return 'Sedang';
//     } else {
//         return 'Tinggi';
//     }
// }



//     public function proses(){
//         $semuaSiswa = Siswa::with('nilaiRapor')->get();

//     foreach ($semuaSiswa as $siswa) {
//         $nilai = $siswa->nilaiRapor;

//         if (!$nilai) {
//             continue; // Lewati siswa yang belum punya nilai
//         }

//         $nilai_fuzzy = $this->fuzzyMamdani([
//             $nilai->rapor1,
//             $nilai->rapor2,
//             $nilai->rapor3,
//             $nilai->rapor4,
//             $nilai->rapor5,
//         ]);

//         HasilPrediksi::updateOrCreate(
//             ['siswa_id' => $siswa->id],
//             [
//                 'nilai_fuzzy' => $nilai_fuzzy,
//                 'hasil_prediksi' => $nilai_fuzzy >= 80 ? 'Lulus' : 'Tidak Lulus',
//                 'tanggal_prediksi' => now(),
//             ]
//         );
//     }

    // return redirect()->route('prediksi.index')->with('success', 'Prediksi massal berhasil dijalankan.');


