<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Rules\YearAcademicFormat;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = DB::table('siswa')->get();
        return view('pages.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('pages.siswa.tambah');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nisn' => ['required', 'string', 'min:5', 'max:20', 'unique:siswa'],
                'nama_siswa' => ['required', 'string', 'min:1', 'max:255'],
                'kelas' => ['required', 'string', 'max:10'],
                'jurusan' => ['required'],
            ],
            [
                'required' => 'Inputan :attribute wajib diisi.',
                'min' => 'Inputan :attribute minimal :min karakter.',
                'max' => 'Inputan :attribute maksimal :max karakter.',
                'string' => 'Inputan :attribute harus berupa teks.',
                'nisn.unique' => 'NISN ini sudah terdaftar.',
                // 'nisn.string' => 'NISN harus berupa teks.',
                'nisn.integer' => 'NISN yang Anda masukkan harus berupa angka.',
            ]
        );

        $now = Carbon::now();

        DB::table('siswa')->insert([
            'nisn' => $request->input("nisn"),
            'nama_siswa' => $request->input("nama_siswa"),
            'kelas' => $request->input("kelas"),
            'jurusan' => $request->input("jurusan"),
            'created_at' => $now,
            'updated_at' => $now
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $siswa = DB::table('siswa')->where('id', $id)->first();
        if (!$siswa) {
            abort(404);
        }
        return view('pages.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nisn' => [
                    'required',
                    'string',
                    'min:5',
                    'max:20',
                    'unique:siswa,nisn,' . $id
                ],
                'nama_siswa' => ['required', 'string', 'min:1', 'max:255'],
                'kelas' => ['required', 'string', 'max:10'],
                'jurusan' => ['required'],
            ],
            [
                'required' => 'Inputan :attribute wajib diisi.',
                'min' => 'Inputan :attribute minimal :min karakter.',
                'max' => 'Inputan :attribute maksimal :max karakter.',
                'string' => 'Inputan :attribute harus berupa teks.',
                'nisn.unique' => 'NISN ini sudah terdaftar.',
                // 'nisn.string' => 'NISN harus berupa teks.',
                'nisn.integer' => 'NISN yang Anda masukkan harus berupa angka.',
            ]
        );

        $now = Carbon::now();
        DB::table('siswa')->where('id', $id)->update([
            'nisn' => $request->input("nisn"),
            'nama_siswa' => $request->input("nama_siswa"),
            'kelas' => $request->input("kelas"),
            'jurusan' => $request->input("jurusan"),
            'updated_at' => $now
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siswa = DB::table('siswa')->where('id', $id)->first();

        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Data siswa tidak ditemukan!');
        }

        DB::table('siswa')->where('id', $id)->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
