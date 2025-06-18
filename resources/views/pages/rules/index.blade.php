@extends('layouts.master')

@section('title', 'Aturan Fuzzy')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Daftar Aturan Fuzzy</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-siswa" class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Rapor 1</th>
                                <th>Rapor 2</th>
                                <th>Rapor 3</th>
                                <th>Rapor 4</th>
                                <th>Rapor 5</th>
                                <th>Output</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rules as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->rapor1 }}</td>
                                    <td>{{ $item->rapor2 }}</td>
                                    <td>{{ $item->rapor3 }}</td>
                                    <td>{{ $item->rapor4 }}</td>
                                    <td>{{ $item->rapor5 }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->output === 'Lulus' ? 'success' : 'danger' }}">
                                        {{ ucfirst($item->output) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada data.</td>
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
        $('#data-siswa').DataTable({
            pageLength: 10,
            ordering: true,
            info: false
        });
    });
</script>
@endpush
