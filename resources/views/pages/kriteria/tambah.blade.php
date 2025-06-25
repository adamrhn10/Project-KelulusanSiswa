@extends('layouts.master')

@section('title', 'Tambah Data Kriteria')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Tambah Data Kriteria</h4>
                <a href="{{ route('kriteria.index') }}" class="btn btn-primary btn-round btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('kriteria.store') }}" method="POST" autocomplete="off">
                    @csrf


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                value="{{ old('kode') }}" placeholder="Masukkan Kode" required>
                            @error('kode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria"
                                value="{{ old('nama_kriteria') }}" placeholder="Masukkan Nama Kriteria" required>
                            @error('nama_kriteria')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    {{-- Tombol --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan
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
