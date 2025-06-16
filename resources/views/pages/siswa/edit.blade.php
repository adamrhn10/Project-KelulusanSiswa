@extends('layouts.master')

@section('title', 'Edit Data Siswa')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Edit Data Siswa</h4>
                    <a href="{{ route('siswa.index') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn"
                                    placeholder="Masukkan NISN siswa"
                                    value="{{ old('nisn', $siswa->nisn) }}"
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
                                    value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
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
                                    <option value="X" {{ (old('kelas', $siswa->kelas) == 'X') ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ (old('kelas', $siswa->kelas) == 'XI') ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ (old('kelas', $siswa->kelas) == 'XII') ? 'selected' : '' }}>XII</option>
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                             <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="Multimedia" {{ old('jurusan') == 'Multimedia' ? 'selected' : '' }}>Multimedia</option>
                                    <option value="Arsitektur" {{ old('jurusan') == 'Arsitektur' ? 'selected' : '' }}>Arsitektur</option>
                                    <option value="Mesin" {{ old('jurusan') == 'Mesin' ? 'selected' : '' }}>Mesin</option>
                                    <option value="Pengelasan" {{ old('jurusan') == 'Mesin' ? 'selected' : '' }}>Pengelasan</option>
                                    <option value="Listrik" {{ old('jurusan') == 'Mesin' ? 'selected' : '' }}>Listrik</option>
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-action text-end">
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