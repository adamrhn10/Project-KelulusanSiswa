@extends('layouts.master')

@section('title', 'Data Perhitungan ')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Prediksi Kelulusan Siswa SMK</h4>
        <form action="{{ route('prediksi.proses') }}" method="POST" onsubmit="return confirm('Lakukan prediksi untuk semua siswa?')">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="fas fa-calculator"></i> Prediksi
            </button>
        </form>
    </div>

    <div class="card-body">
        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover text-center" id="prediksi-table">
                <thead class="table-head-bg-black">
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Rapor 1</th>
                        <th>Rapor 2</th>
                        <th>Rapor 3</th>
                        <th>Rapor 4</th>
                        <th>Rapor 5</th>
                        <th>Nilai Fuzzy</th>
                        <th>Hasil Prediksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nisn }}</td>
                            @for ($i = 1; $i <= 5; $i++)
                                <td>{{ $item->nilaiRapor?->{'rapor'.$i} ?? '-' }}</td>
                            @endfor
                            <td>{{ $item->hasilPrediksi->nilai_fuzzy ?? '-' }}</td>
                            <td>
                                @if ($item->hasilPrediksi)
                                    <span class="badge bg-{{ $item->hasilPrediksi->hasil_prediksi === 'Lulus' ? 'success' : 'danger' }}">
                                        {{ $item->hasilPrediksi->hasil_prediksi }}
                                    </span>
                                @else
                                    <span class="text-muted">Belum Diprediksi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada data siswa.</td>
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
        $('#prediksi-table').DataTable({
            pageLength: 10,
            ordering: true,
            info: true,
            paging: true
        });
    });
</script>
@endpush
