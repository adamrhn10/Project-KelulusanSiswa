@extends('layouts.master')

@section('title', 'Hasil Prediksi')

@section('content')
<div class="row">
    <div class="col-md-12">

                @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
                @endif

        <div class="card">
        

             <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Daftar Hasil Prediksi Kelulusan</h4>
                <a href="{{ route('prediksi.pdf') }}" class="btn btn-danger btn-round " target="_blank">
                    <i class="fa fa-file-pdf"></i> Cetak PDF
                </a>
            </div>

            <div class="card-body table-responsive">
                <table id="data-prediksi" class="table table-head-bg-black table-hover table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Tahun Ajaran</th>
                            <th>Nilai Fuzzy</th>
                            <th>Hasil Prediksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hasil as $h)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $h->siswa->nisn ?? '-' }}</td>
                                <td>{{ $h->siswa->nama_siswa ?? '-' }}</td>
                                <td>{{ $h->siswa->kelas ?? '-' }}</td>
                                <td>{{ $h->siswa->jurusan ?? '-' }}</td>
                                <td>{{ $h->siswa->tahun_ajaran ?? '-' }}</td>
                                <td>{{ $h->nilai_fuzzy }}</td>
                                <td>
                                    <span class="badge 
                                        @if($h->hasil_prediksi === 'Lulus') bg-success 
                                        @elseif($h->hasil_prediksi === 'Tidak Lulus') bg-danger 
                                        @else bg-warning text-dark 
                                        @endif">
                                        {{ $h->hasil_prediksi }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada hasil prediksi.</td>
                            </tr>
                        @endforelse
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
        $('#data-prediksi').DataTable({
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
