@extends('layouts.master')

@section('title', 'Tambah Data Siswa')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Tambah Data Siswa</h4>
                    <a href="{{ route('siswa.index') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="/siswa" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NISN siswa" value="{{ old('nisn') }}" required>
                                @error('nisn')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nama_siswa">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama Lengkap siswa" value="{{ old('nama_siswa') }}" required>
                                @error('nama_siswa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X" {{ old('kelas') == 'X' ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ old('kelas') == 'XI' ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ old('kelas') == 'XII' ? 'selected' : '' }}>XII</option>
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Contoh: 2023/2024" value="{{ old('tahun_ajaran') }}" required>
                                @error('tahun_ajaran')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-action text-end">
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