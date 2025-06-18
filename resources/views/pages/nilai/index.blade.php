@extends('layouts.master')

@section('title', 'Data Penilaian')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Nilai Rapor Siswa</h4>
    </div>

    <div class="card-body">

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table id="nilai-table" class="table table-hover text-center">
                <thead class="table-head-bg-black">
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Status Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nisn }}</td>
                            <td>{{ $item->nama_siswa }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td>
                                @php
                                    $sudahDiisi = $item->nilaiRapor ? true : false;
                                    $badgeClass = $sudahDiisi ? 'success' : 'danger';
                                    $badgeText = $sudahDiisi ? 'Sudah Diisi' : 'Belum Diisi';
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">{{ $badgeText }}</span>
                            </td>
                            <td>
                                <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> Nilai
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Data siswa tidak tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#nilai-table').DataTable({
            pageLength: 10,
            ordering: true,
            info: true,
            paging: true
        });
    });
</script>
@endpush
