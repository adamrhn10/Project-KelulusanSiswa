@extends('layouts.master')

@section('title', 'Edit Data Kriteria')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Edit Data Siswa</h4>
                <a href="{{ route('kriteria.index') }}" class="btn btn-primary btn-round btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1 --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                value="{{ old('kode', $kriteria->kode) }}"
                                placeholder="Masukkan Kode" required>
                            @error('kode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria"
                                value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}"
                                placeholder="Masukkan Nama Lengkap" required>
                            @error('nama_kriteria')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Perbarui
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
