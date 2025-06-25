<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AturanFuzzy;
use App\Models\AturanDetail;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;

class AturanFuzzyController extends Controller
{
     public function index()
    {
        $aturan = AturanFuzzy::with('details.kriteria')->get();
        $kriteria = Kriteria::where('kode', '!=', 'OUT')->get();
        return view('pages.aturan.index', compact('aturan', 'kriteria'));
    }

    public function store(Request $request)
{
    $request->validate([
        'output' => 'nullable|in:Lulus,Pertimbangkan,Tidak Lulus',
        'kategori' => 'required|array',
    ]);

   // Validasi Duplikat Aturan (IF sama, apapun outputnya)
        $aturanList = AturanFuzzy::with('details')->get();

        foreach ($aturanList as $rule) {
            $details = $rule->details;

            // Cek jumlah kriteria cocok
            $matched = 0;
            foreach ($request->kategori as $kriteria_id => $kategori) {
                if ($details->firstWhere('kriteria_id', $kriteria_id)?->kategori === $kategori) {
                    $matched++;
                }
            }

            if ($matched === count($request->kategori)) {
                return back()->with('error', 'Aturan dengan kombinasi tersebut sudah ada.');
            }
        }

    // Lanjut simpan
    DB::beginTransaction();
    try {
        $output = $request->output ?? $this->tentukanOutputOtomatis($request->kategori);
        $aturan = AturanFuzzy::create(['output' => $output]);

        foreach ($request->kategori as $kriteria_id => $kategori) {
            AturanDetail::create([
                'aturan_id' => $aturan->id,
                'kriteria_id' => $kriteria_id,
                'kategori' => $kategori
            ]);
        }

        DB::commit();
        return redirect()->route('aturan.index')->with('success', 'Aturan fuzzy berhasil ditambahkan.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal menambahkan aturan: ' . $e->getMessage());
    }
}

    public function generateAuto()
    {
        $kriteria = Kriteria::where('kode', '!=', 'OUT')->get();
        $kategoriFuzzy = ['Rendah', 'Sedang', 'Tinggi'];

        $combinations = $this->generateAllCombinations(
            $kriteria->pluck('id')->toArray(),
            $kategoriFuzzy
        );

        DB::beginTransaction();
        try {
            foreach ($combinations as $combo) {
                // Cek apakah aturan dengan kombinasi ini sudah ada
                $exists = AturanFuzzy::with('details')->get()->first(function ($rule) use ($combo) {
                    $detailCount = count($rule->details);
                    $matched = 0;

                    foreach ($rule->details as $detail) {
                        if (isset($combo[$detail->kriteria_id]) &&
                            $combo[$detail->kriteria_id] === $detail->kategori) {
                            $matched++;
                        }
                    }

                    return $matched === $detailCount;
                });

                if (!$exists) {
                    $output = $this->tentukanOutputOtomatis($combo);

                    $aturan = AturanFuzzy::create(['output' => $output]);

                    foreach ($combo as $kriteria_id => $kategori) {
                        AturanDetail::create([
                            'aturan_id' => $aturan->id,
                            'kriteria_id' => $kriteria_id,
                            'kategori' => $kategori
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('aturan.index')->with('success', 'Aturan fuzzy berhasil digenerate otomatis.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal generate aturan otomatis: ' . $e->getMessage());
        }
    }

    private function generateAllCombinations(array $kriteriaIds, array $kategoriFuzzy)
    {
        if (empty($kriteriaIds)) return [];

        $result = [[]];

        foreach ($kriteriaIds as $id) {
            $temp = [];

            foreach ($result as $combo) {
                foreach ($kategoriFuzzy as $kategori) {
                    $temp[] = $combo + [$id => $kategori];
                }
            }

            $result = $temp;
        }

        return $result;
    }

    /**
     * Fungsi penentuan output otomatis berdasarkan jumlah kategori "Tinggi" menggunakan metode rasio. : $persentaseTinggi = $jumlahTinggi / jumlah_kriteria;
     */
    private function tentukanOutputOtomatis(array $kategori): string
    {
        $jumlahTinggi = collect($kategori)->filter(fn($val) => $val === 'Tinggi')->count();

        $totalKriteria = count($kategori);
        $persentase = $jumlahTinggi / $totalKriteria;

        if ($persentase >= 0.7) {
                return 'Lulus';
        } elseif ($persentase >= 0.4) {
                return 'Dipertimbangkan';
        } else {
                return 'Tidak Lulus';
        }
    }

    public function edit($id)
    {
        $aturan = AturanFuzzy::with('details')->findOrFail($id);
        $kriteria = Kriteria::all();

        $selectedKategori = [];
        foreach ($aturan->details as $detail) {
            $selectedKategori[$detail->kriteria_id] = $detail->kategori;
        }

        return view('pages.aturan.edit', compact('aturan', 'kriteria', 'selectedKategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'output' => 'required|in:Lulus,Dipertimbangkan,Tidak Lulus',
            'kategori' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $aturan = AturanFuzzy::findOrFail($id);
            $aturan->update(['output' => $request->output]);

            AturanDetail::where('aturan_id', $id)->delete();

            foreach ($request->kategori as $kriteria_id => $kategori) {
                AturanDetail::create([
                    'aturan_id' => $id,
                    'kriteria_id' => $kriteria_id,
                    'kategori' => $kategori
                ]);
            }

            DB::commit();
            return redirect()->route('aturan.index')->with('success', 'Aturan fuzzy berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui aturan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $aturan = AturanFuzzy::findOrFail($id);
        $aturan->details()->delete();
        $aturan->delete();

        return redirect()->route('aturan.index')->with('success', 'Aturan berhasil dihapus.');
    }
}
