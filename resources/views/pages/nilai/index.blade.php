@extends('layouts.master')

@section('title', 'Data Nilai Siswa')

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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Nilai Siswa</h5>
            </div>

            <div class="card-body table-responsive">
                <table id="data-nilai"  class="table table-head-bg-black table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Tahun ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $index => $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nisn }}</td>
                            <td>{{ $s->nama_siswa }}</td>
                            <td>{{ $s->kelas }}</td>
                            <td>{{ $s->jurusan }}</td>
                            <td>{{ $s->tahun_ajaran }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalInput{{ $s->id }}">
                                    <i class="fas fa-edit"></i> Input Nilai
                                </button>
                            </td>
                        </tr>

                        {{-- Modal Input Nilai --}}
                        <div class="modal fade" id="modalInput{{ $s->id }}" tabindex="-1" aria-labelledby="modalInputLabel{{ $s->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('nilai.store', $s->id) }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-black text-white">
                                            <h5 class="modal-title" id="modalInputLabel{{ $s->id }}">
                                                {{ $s->nisn }} - {{ $s->nama_siswa }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            @foreach($kriteria as $krit)
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $krit->nama_kriteria }} ({{ $krit->kode }})</label>
                                                    <input type="number" step="any"
                                                           class="form-control"
                                                           name="nilai_{{ $krit->id }}"
                                                           value="{{ old('nilaisiswa'.$krit->id, $s->nilaisiswa->firstWhere('kriteria_id', $krit->id)->nilai ?? '') }}"
                                                           required>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i> Simpan
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function () {
        $('#data-nilai').DataTable({
            responsive: true,
            pageLength: 10,
            ordering: true,
            info: false,
            language: {
                search: "Cari:",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                }
            }
        });
    });
</script>
@endpush