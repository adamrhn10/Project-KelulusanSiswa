@extends('layouts.master')

@section('title', 'Data Sub Kriteria (Domain Fuzzy)')

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Judul Halaman --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Daftar Data Sub Kriteria</h4>
            </div>
        </div>

        @foreach($kriteria as $k)
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-black">
                    <i class="fas fa-cubes"></i> {{ $k->nama_kriteria }} ({{ $k->kode }})
                </h6>
                <a href="#modalTambah{{ $k->id }}" data-bs-toggle="modal" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Tambah Domain
                </a>
            </div>

            {{-- Modal Tambah --}}
            <div class="modal fade" id="modalTambah{{ $k->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Domain Fuzzy</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('subkriteria.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="kriteria_id" value="{{ $k->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Kategori Linguistik</label>
                                    @php
                                        $kategoriOptions = $k->kode === 'OUT'
                                            ? ['Tidak Lulus', 'Dipertimbangkan', 'Lulus']
                                            : ['Rendah', 'Sedang', 'Tinggi'];
                                    @endphp
                                    <select name="kategori" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach($kategoriOptions as $kat)
                                            <option value="{{ $kat }}">{{ $kat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Titik A</label>
                                    <input type="number" step="any" name="titik_a" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Titik B</label>
                                    <input type="number" step="any" name="titik_b" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Titik C</label>
                                    <input type="number" step="any" name="titik_c" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Tabel Data --}}
            <div class="card-body">
                <table class="table table-head-bg-black table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Titik A</th>
                            <th>Titik B</th>
                            <th>Titik C</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subkriteria->where('kriteria_id', $k->id) as $s)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->kategori }}</td>
                            <td>{{ $s->titik_a }}</td>
                            <td>{{ $s->titik_b }}</td>
                            <td>{{ $s->titik_c }}</td>
                            <td>
                                <a href="#modalEdit{{ $s->id }}" class="btn btn-sm btn-warning" data-bs-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('subkriteria.destroy', $s->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="modalEdit{{ $s->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title">Edit Domain Fuzzy</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('subkriteria.update', $s->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <input type="hidden" name="kriteria_id" value="{{ $s->kriteria_id }}">
                                            <div class="mb-3">
                                                <label class="form-label">Kategori Linguistik</label>
                                                @php
                                                    $kategoriOptions = $s->kriteria->kode === 'OUT'
                                                        ? ['Tidak Lulus', 'Dipertimbangkan', 'Lulus']
                                                        : ['Rendah', 'Sedang', 'Tinggi'];
                                                @endphp
                                                <select name="kategori" class="form-select" required>
                                                    @foreach($kategoriOptions as $kat)
                                                        <option value="{{ $kat }}" {{ $s->kategori == $kat ? 'selected' : '' }}>
                                                            {{ $kat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Titik A</label>
                                                <input type="number" step="any" name="titik_a" class="form-control" value="{{ $s->titik_a }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Titik B</label>
                                                <input type="number" step="any" name="titik_b" class="form-control" value="{{ $s->titik_b }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Titik C</label>
                                                <input type="number" step="any" name="titik_c" class="form-control" value="{{ $s->titik_c }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success">Perbarui</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
