@extends('layouts.master')

@section('title', 'Hasil Prediksi')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Daftar Hasil Prediksi Siswa</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-hasil" class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>NAMA</th>
                                <th>KELAS</th>
                                <th>JURUSAN</th>
                                <th>NILAI FUZZY</th>
                                <th>HASIL PREDIKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hasil as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->jurusan }}</td>
                                        <td>
                                            {{ $item->hasilPrediksi?->nilai_fuzzy ?? 'Nilai tidak ada' }}
                                        </td>
                                        <td>
                                            @if ($item->hasilPrediksi?->hasil_prediksi)
                                                <span class="badge bg-{{ $item->hasilPrediksi->hasil_prediksi === 'Lulus' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($item->hasilPrediksi->hasil_prediksi) }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Belum dihitung</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Tidak ada data.</td>
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
    $(function () {
        $('#data-hasil').DataTable({
            pageLength: 10,
            ordering: true,
            info: false
        });
    });
</script>
@endpush
