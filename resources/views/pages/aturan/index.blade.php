@extends('layouts.master')

@section('title', 'Aturan Fuzzy')

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

        {{-- Form Tambah Aturan Fuzzy --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <strong>Tambah Aturan Fuzzy</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('aturan.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        @foreach($kriteria as $k)
                        <div class="col-md-3">
                            <label class="form-label">{{ $k->nama_kriteria }}</label>
                            <select name="kategori[{{ $k->id }}]" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                @foreach(['Rendah', 'Sedang', 'Tinggi'] as $kat)
                                    <option value="{{ $kat }}">{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                        <div class="col-md-3">
                            <label class="form-label">Output (Opsional)</label>
                            <select name="output" class="form-select">
                                <option value="">-- Otomatis --</option>
                                <option value="Lulus">Lulus</option>
                                <option value="Dipertimbangkan">Dipertimbangkan</option>
                                <option value="Tidak Lulus">Tidak Lulus</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan Aturan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Daftar Aturan --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Daftar Aturan Fuzzy</h4>
                <form action="{{ route('aturan.generateAuto') }}" method="POST" onsubmit="return confirm('Generate semua kombinasi aturan fuzzy?')">
                    @csrf
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-magic"></i> Generate Otomatis
                    </button>
                </form>
            </div>
            <div class="card-body table-responsive">
                <form id="filter-form" class="row g-2 mb-3">
                    @foreach($kriteria as $k)
                        <div class="col-md-3">
                            <label class="form-label">{{ $k->nama_kriteria }}</label>
                            <select class="form-select filter-kolom" data-kriteria="{{ $loop->index }}">
                                <option value="">-- Semua --</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                            </select>
                        </div>
                    @endforeach
                </form>
                <table id="data-aturan" class="table table-head-bg-black table-hover table-bordered text-center align-middle ">
                    <thead>
                        <tr>
                            <th>No</th>
                            @foreach($kriteria as $k)
                                <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                            <th>Output</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aturan as $rule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @foreach($kriteria as $k)
                                    <td>
                                        {{ $rule->details->firstWhere('kriteria_id', $k->id)?->kategori ?? '-' }}
                                    </td>
                                @endforeach
                                <td><span class="badge bg-{{ $rule->output === 'Lulus' ? 'success' : ($rule->output === 'Dipertimbangkan' ? 'warning text-dark' : 'danger') }}">
                                    {{ $rule->output }}
                                </span></td>
                                <td>
                                {{-- Tombol Edit --}}
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $rule->id }}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="modalEdit{{ $rule->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('aturan.update', $rule->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Edit Aturan Fuzzy</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body row g-3">
                                                    @foreach($kriteria as $k)
                                                    <div class="col-md-3">
                                                        <label class="form-label">{{ $k->nama_kriteria }}</label>
                                                        <select name="kategori[{{ $k->id }}]" class="form-select" required>
                                                            <option value="">-- Pilih --</option>
                                                            @foreach(['Rendah', 'Sedang', 'Tinggi'] as $kat)
                                                                <option value="{{ $kat }}" {{ $rule->details->firstWhere('kriteria_id', $k->id)?->kategori === $kat ? 'selected' : '' }}>
                                                                    {{ $kat }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endforeach
                                                    <div class="col-md-3">
                                                        <label class="form-label">Output</label>
                                                        <select name="output" class="form-select" required>
                                                            <option value="">-- Pilih --</option>
                                                            @foreach(['Lulus', 'Pertimbangkan', 'Tidak Lulus'] as $out)
                                                                <option value="{{ $out }}" {{ $rule->output === $out ? 'selected' : '' }}>
                                                                    {{ $out }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary"><i class="fa fa-save"></i> Perbarui</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('aturan.destroy', $rule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus aturan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $kriteria->count() + 2 }}">Belum ada aturan yang ditambahkan.</td>
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
        const table = $('#data-aturan').DataTable({
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

        // Tangani filter per kriteria
        $('.filter-kolom').on('change', function () {
            $('.filter-kolom').each(function (index) {
                const val = $(this).val();
                table.column(index + 1).search(val); // +1 karena kolom ke-0 adalah No
            });
            table.draw();
        });
    });
</script>
@endpush
