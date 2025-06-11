<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('pages.siswa.index');
    }

    public function create()
    {
        return view('pages.siswa.tambah');
    }

    public function update()
    {
        return view('pages.siswa.edit');
    }
}
