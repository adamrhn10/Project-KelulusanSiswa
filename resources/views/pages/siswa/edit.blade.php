@extends('layouts.master')

@section('title', 'Edit Data Siswa')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Edit Data Siswa</h4>
                <a href="{{ route('siswa.index') }}" class="btn btn-primary btn-round btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1 --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn"
                                value="{{ old('nisn', $siswa->nisn) }}"
                                placeholder="Masukkan NISN" required>
                            @error('nisn')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
                                placeholder="Masukkan Nama Lengkap" required>
                            @error('nama_siswa')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Baris 2 --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach (['X', 'XI', 'XII'] as $kelas)
                                    <option value="{{ $kelas }}" {{ old('kelas', $siswa->kelas) == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" id="jurusan" name="jurusan" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @php
                                    $jurusanList = ['Multimedia', 'Arsitektur', 'Mesin', 'Pengelasan', 'Listrik'];
                                @endphp
                                @foreach ($jurusanList as $jurusan)
                                    <option value="{{ $jurusan }}" {{ old('jurusan', $siswa->jurusan) == $jurusan ? 'selected' : '' }}>{{ $jurusan }}</option>
                                @endforeach
                            </select>
                            @error('jurusan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                value="{{ old('tahun_ajaran', $siswa->tahun_ajaran) }}"
                                placeholder="Contoh: 2024/2025" required>
                            @error('tahun_ajaran')
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
