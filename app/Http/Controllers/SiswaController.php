<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Rules\YearAcademicFormat;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('pages.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('pages.siswa.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => ['required', 'string', 'min:5', 'max:20', 'unique:siswa'],
            'nama_siswa' => ['required', 'string', 'min:1', 'max:255'],
            'kelas' => ['required', 'string', 'max:10'],
            'jurusan' => ['required'],
            'tahun_ajaran' => ['required', new YearAcademicFormat], // jika digunakan
        ], [
            'required' => 'Inputan :attribute wajib diisi.',
            'min' => 'Inputan :attribute minimal :min karakter.',
            'max' => 'Inputan :attribute maksimal :max karakter.',
            'string' => 'Inputan :attribute harus berupa teks.',
            'nisn.unique' => 'NISN ini sudah terdaftar.',
        ]);

        Siswa::create($request->only(['nisn', 'nama_siswa', 'kelas', 'jurusan', 'tahun_ajaran']));

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit(Siswa $siswa)
    {
        return view('pages.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nisn' => ['required', 'string', 'min:5', 'max:20', 'unique:siswa,nisn,' . $siswa->id],
            'nama_siswa' => ['required', 'string', 'min:1', 'max:255'],
            'kelas' => ['required', 'string', 'max:10'],
            'jurusan' => ['required'],
        ], [
            'required' => 'Inputan :attribute wajib diisi.',
            'min' => 'Inputan :attribute minimal :min karakter.',
            'max' => 'Inputan :attribute maksimal :max karakter.',
            'string' => 'Inputan :attribute harus berupa teks.',
            'nisn.unique' => 'NISN ini sudah terdaftar.',
        ]);

        $siswa->update($request->only(['nisn', 'nama_siswa', 'kelas', 'jurusan', 'tahun_ajaran']));

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
