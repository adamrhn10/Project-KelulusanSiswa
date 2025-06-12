@extends('layouts.master')

@section('title', 'Data Siswa')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Data Siswa</h4>
                    <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead class="table-primary text-white">
                            <tr class="text-center">
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
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
                                    <td>{{ $item->tahun_ajaran }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-sm btn-primary mr-1" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data siswa.</td>
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
    $(document).ready(function() {
        $('#add-row').DataTable({
            "pageLength": 10,
            "ordering": true, 
            "info": true,      
            "paging": true,   
        });
        
        // Inisialisasi tooltip untuk semua elemen yang memiliki data-toggle="tooltip"
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
@endpush