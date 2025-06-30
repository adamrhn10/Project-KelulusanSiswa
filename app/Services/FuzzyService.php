<?php

namespace App\Services;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\NilaiSiswa;
use App\Models\AturanFuzzy;

class FuzzyService
{
    public function prediksi(int $siswa_id): array
    {
        $nilaiSiswa = NilaiSiswa::where('siswa_id', $siswa_id)->get()->keyBy('kriteria_id');
        $kriteria = Kriteria::all();

        // Fuzzifikasi
        $fuzzyInputs = [];
        foreach ($kriteria as $krit) {
            $nilai = $nilaiSiswa[$krit->id]->nilai ?? 0;
            $fuzzyInputs[$krit->id] = $this->fuzzifikasi($krit->id, $nilai);
        }

        //  Inferensi
        $aturan = AturanFuzzy::with('details')->get();
        $outputList = [];

        foreach ($aturan as $rule) {
            $min_μ = 1;

            foreach ($rule->details as $detail) {
                $μ = $fuzzyInputs[$detail->kriteria_id][$detail->kategori] ?? 0;
                $min_μ = min($min_μ, $μ);
            }

            if ($min_μ > 0) {
                $z = $this->getOutputZ($rule->output, 'OUT'); // gunakan kode output dari kriteria
                $outputList[] = [
                    'z' => $z,
                    'μ' => $min_μ
                ];
            }
        }

        // Jika tidak ada aturan yang cocok
        if (empty($outputList)) {
            return [
                'output' => 'Tidak Diketahui',
                'nilai_fuzzy' => 0
            ];
        }

        // Defuzzifikasi: Center of Gravity (CoG)
        $numerator = 0;
        $denominator = 0;
        foreach ($outputList as $out) {
            $numerator += $out['z'] * $out['μ'];
            $denominator += $out['μ'];
        }

        $nilaiFuzzy = $denominator > 0 ? round($numerator / $denominator, 2) : 0;
        $outputText = $this->klasifikasiOutput($nilaiFuzzy, 'OUT');

        return [
            'output' => $outputText,
            'nilai_fuzzy' => $nilaiFuzzy
        ];
    }

    /**
     * Fuzzifikasi: derajat keanggotaan berdasarkan nilai & domain
     */
    private function fuzzifikasi($kriteria_id, $nilai): array
    {
        $subs = SubKriteria::where('kriteria_id', $kriteria_id)->get();
        $result = [];

        foreach ($subs as $s) {
            $a = $s->titik_a;
            $b = $s->titik_b;
            $c = $s->titik_c;

            if ($nilai < $a || $nilai > $c) {
                $μ = 0;
            } elseif ($nilai == $b || $nilai == $c) {
                $μ = 1;
            } elseif ($nilai > $a && $nilai < $b) {
                $μ = ($nilai - $a) / ($b - $a);
            } elseif ($nilai > $b && $nilai < $c) {
                $μ = ($c - $nilai) / ($c - $b);
            } elseif ($nilai == $a) {
                $μ = 0;
            } else {
                $μ = 0;
            }

            $result[$s->kategori] = round($μ, 4);
        }

        return $result;
    }

    /**
     * Representasi crisp dari output fuzzy (dinamis berdasarkan kode kriteria output)
     */
    private function getOutputZ(string $kategori, string $outputKode = 'OUT'): float
    {
        $kriteria = Kriteria::where('kode', $outputKode)->first();
        if (!$kriteria) return 0;

        $sub = SubKriteria::where('kriteria_id', $kriteria->id)
            ->where('kategori', $kategori)
            ->first();

        if (!$sub) return 0;

        return round(($sub->titik_a + $sub->titik_b + $sub->titik_c) / 3, 2);
    }

    /**
     * Klasifikasi nilai defuzzifikasi ke output linguistik (dinamis)
     */
    private function klasifikasiOutput(float $z, string $outputKode = 'OUT'): string
    {
        $kriteria = Kriteria::where('kode', $outputKode)->first();
        if (!$kriteria) return 'Tidak Diketahui';

        $outputs = SubKriteria::where('kriteria_id', $kriteria->id)->get();

        $closestKategori = 'Tidak Diketahui';
        $minDistance = INF;

        foreach ($outputs as $out) {
            $distance = abs($z - $out->titik_b);
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $closestKategori = $out->kategori;
            }
        }

        return $closestKategori;
    }
}
