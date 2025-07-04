<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Support\Facades\Log;


class SubKriteriaController extends Controller
{
    public function index(Request $request)
    {
        $subkriteria = SubKriteria::with('kriteria')->get();
        $kriteria = Kriteria::all();

        $editId = $request->query('edit');
        $subkriteriaEdit = $editId ? SubKriteria::find($editId) : null;

        return view('pages.subkriteria.index', compact('subkriteria', 'kriteria', 'subkriteriaEdit'));
    }

    public function store(Request $request)
{
    $this->validateForm($request);

    $jumlahKategori = SubKriteria::where('kriteria_id', $request->kriteria_id)->count();

    if ($jumlahKategori >= 3) {
        return redirect()->route('subkriteria.index')
                         ->withErrors(['Subkriteria tidak boleh lebih dari 3 kategori untuk setiap kriteria.']);
    }

    // Cegah kategori yang sama dimasukkan dua kali
    $duplikat = SubKriteria::where('kriteria_id', $request->kriteria_id)
                           ->where('kategori', $request->kategori)
                           ->exists();

    if ($duplikat) {
        return redirect()->route('subkriteria.index')
                         ->withErrors(['Kategori sudah ada untuk kriteria ini.']);
    }

    SubKriteria::create($request->only([
        'kriteria_id', 'kategori', 'titik_a', 'titik_b', 'titik_c'
    ]));

    return redirect()->route('subkriteria.index')
                     ->with('success', 'Domain fuzzy berhasil ditambahkan.');
}


    public function update(Request $request, $id)
    {
        $subkriteria = SubKriteria::findOrFail($id);

        $this->validateForm($request);

        $subkriteria->update($request->only([
            'kriteria_id', 'kategori', 'titik_a', 'titik_b', 'titik_c'
        ]));

        return redirect()->route('subkriteria.index')
                        ->with('success', 'Domain fuzzy berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $subkriteria = SubKriteria::findOrFail($id);

        $subkriteria->delete();

        return redirect()->route('subkriteria.index')
                        ->with('success', 'Domain fuzzy berhasil dihapus.');
    }

    /**
     *  Validasi form input dengan kategori dinamis (input / output)
     */
    private function validateForm(Request $request)
    {
        $kriteria = Kriteria::findOrFail($request->kriteria_id);

        // Tentukan kategori yang diperbolehkan
        $allowedKategori = $kriteria->kode === 'OUT'
            ? ['Tidak Lulus', 'Dipertimbangkan', 'Lulus']
            : ['Rendah', 'Sedang', 'Tinggi'];

        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'kategori'    => 'required|in:' . implode(',', $allowedKategori),
            'titik_a'     => 'required|numeric',
            'titik_b'     => 'required|numeric|gt:titik_a',
            'titik_c'     => 'required|numeric|gt:titik_b',
        ], [
            'kategori.in' => 'Kategori tidak valid untuk kriteria ini.',
            'titik_b.gt'  => 'Titik B harus lebih besar dari Titik A',
            'titik_c.gt'  => 'Titik C harus lebih besar dari Titik B',
        ]);
    }
}
