@extends('layouts.master')

@section('title', 'Data Siswa')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Daftar Data Siswa</h4>
                <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-round btn-sm">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive" >
                    <table id="data-siswa" class=" table table-head-bg-black table-hover table-bordered text-center">
                        <thead class="">
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Tahun Ajaran</th>
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
                                    <td>{{ $item->tahun_ajaran }}</td>
                                    <td>
                                        <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-sm btn-primary me-1" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data siswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#data-siswa').DataTable({
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
