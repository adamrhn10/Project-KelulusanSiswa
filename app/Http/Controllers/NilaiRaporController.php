<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\NilaiRapor;

class NilaiRaporController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('nilaiRapor')->get();
        return view('pages.nilai.index', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $nilai = $siswa->nilaiRapor;
        return view('pages.nilai.edit', compact('siswa', 'nilai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rapor1' => 'required|numeric',
            'rapor2' => 'required|numeric',
            'rapor3' => 'required|numeric',
            'rapor4' => 'required|numeric',
            'rapor5' => 'required|numeric',
        ]);

        $nilai = NilaiRapor::updateOrCreate(
            ['siswa_id' => $id],
            $request->only(['rapor1', 'rapor2', 'rapor3', 'rapor4', 'rapor5'])
        );

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan');
    }
}
