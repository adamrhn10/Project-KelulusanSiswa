@extends('layouts.master') {{-- Pastikan ini mengarah ke layout master Anda --}}

@section('title', 'Data Siswa') {{-- Judul halaman --}}

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Edit Data Siswa</h4>
                    <a href="" class="btn btn-primary btn-round ms-auto">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{-- Form untuk mengedit data siswa --}}
                {{-- Perhatikan action dan @method('PUT') --}}
                <form action="" method="POST">
                    @csrf {{-- Token CSRF untuk keamanan Laravel --}}
                    @method('PUT') {{-- Digunakan untuk menandakan ini adalah permintaan UPDATE --}}

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" 
                                    placeholder="Masukkan NISN siswa" 
                                    value="" {{-- Mengisi nilai dari database atau old input --}}
                                    required>
                                @error('nisn')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nama_siswa">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" 
                                    placeholder="Masukkan Nama Lengkap siswa" 
                                    value="" {{-- Mengisi nilai dari database atau old input --}}
                                    required>
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
                                    <option value="X" {{ (old('kelas') == 'X') ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ (old('kelas') == 'XI') ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ (old('kelas') == 'XII') ? 'selected' : '' }}>XII</option>
                                    {{-- Tambahkan pilihan kelas lain jika ada --}}
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" 
                                    placeholder="Contoh: 2023/2024" 
                                    value="" {{-- Mengisi nilai dari database atau old input --}}
                                    required>
                                @error('tahun_ajaran')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-action text-end"> {{-- Tombol di kanan --}}
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