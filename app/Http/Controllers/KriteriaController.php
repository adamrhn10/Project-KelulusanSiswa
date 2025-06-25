<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('pages.kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('pages.kriteria.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kriteria,kode|max:10',
            'nama_kriteria' => 'required|max:100',
        ]);

        Kriteria::create($request->only(['kode', 'nama_kriteria']));

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('pages.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:kriteria,kode,' . $kriteria->id,
            'nama_kriteria' => 'required|max:100',
        ]);

        $kriteria->update($request->only(['kode', 'nama_kriteria']));

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui!');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus!');
    }
}
