@extends('layouts.master')

@section('title', 'Nilai Rapor Siswa')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Daftar Nilai Rapor Siswa</h4>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-dark-sidebar" id="nilai-table">
                <thead>
                    <tr class="text-center">
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
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nisn }}</td>
                            <td>{{ $item->nama_siswa }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td>
                                @if ($item->nilaiRapor)
                                    <span class="badge bg-success">Sudah Diisi</span>
                                @else
                                    <span class="badge bg-danger">Belum Diisi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Isi / Edit Nilai">
                                    <i class="fa fa-edit"></i> Nilai
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data siswa tidak tersedia.</td>
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
    $(document).ready(function() {
        $('#nilai-table').DataTable({
            pageLength: 10,
            ordering: true,
            info: true,
            paging: true,
        });
    });
</script>
@endpush
