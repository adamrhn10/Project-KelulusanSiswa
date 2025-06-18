<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AturanFuzzy;

class AturanFuzzySeeder extends Seeder
{
    public function run()
    {
        $linguistik = ['Rendah', 'Sedang', 'Tinggi'];

        foreach ($linguistik as $r1) {
            foreach ($linguistik as $r2) {
                foreach ($linguistik as $r3) {
                    foreach ($linguistik as $r4) {
                        foreach ($linguistik as $r5) {
                            $input = [$r1, $r2, $r3, $r4, $r5];

                            // Aturan dasar: jika >= 3 tinggi → Lulus
                            $jumlahTinggi = collect($input)->filter(fn($x) => $x == 'Tinggi')->count();

                            $hasil = $jumlahTinggi >= 3 ? 'Lulus' : 'Tidak Lulus';

                            AturanFuzzy::create([
                                'rapor1' => $r1,
                                'rapor2' => $r2,
                                'rapor3' => $r3,
                                'rapor4' => $r4,
                                'rapor5' => $r5,
                                'output' => $hasil,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
