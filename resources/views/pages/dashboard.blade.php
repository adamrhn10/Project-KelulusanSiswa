@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h5 class="text-muted">Selamat datang kembali, ! Senang melihat Anda lagi di aplikasi prediksi kelulusan.</h5>
</div>

{{-- Statistik Ringkas --}}
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Siswa</p>
                            <h4 class="card-title">{{ $totalSiswa }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Sudah Diprediksi</p>
                            <h4 class="card-title">{{ $totalPrediksi }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Lulus</p>
                            <h4 class="card-title">{{ $jumlahLulus }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-danger bubble-shadow-small">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Tidak Lulus</p>
                            <h4 class="card-title">{{ $jumlahTidakLulus }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Grafik dan Ringkasan Prediksi dalam 1 baris --}}
<div class="row mt-4">
    {{-- Doughnut Chart --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Distribusi Hasil Kelulusan</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="doughnutChart" style="width: 100%; height: 300px"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Prediksi Terbaru --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Prediksi Terbaru</div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Fuzzy</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prediksiTerbaru as $item)
                        <tr>
                            <td>{{ $item->siswa->nama_siswa }}</td>
                            <td>{{ $item->siswa->jurusan }}</td>
                            <td>{{ $item->nilai_fuzzy }}</td>
                            <td>
                                <span class="badge bg-{{ $item->hasil_prediksi === 'Lulus' ? 'success' : ($item->hasil_prediksi === 'Dipertimbangkan' ? 'warning text-dark' : 'danger') }}">
                                    {{ $item->hasil_prediksi }}
                                </span>
                            </td>
                        </tr>
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
  document.addEventListener("DOMContentLoaded", function () {
    var doughnutChart = document.getElementById("doughnutChart").getContext("2d");

    var myDoughnutChart = new Chart(doughnutChart, {
      type: "doughnut",
      data: {
        datasets: [
          {
            data: [{{ $jumlahLulus }}, {{ $jumlahDipertimbangkan }}, {{ $jumlahTidakLulus }}],
            backgroundColor: ["#28a745", "#ffc107", "#dc3545"],
          },
        ],
        labels: ["Lulus", "Dipertimbangkan", "Tidak Lulus"],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
          },
        },
        layout: {
          padding: {
            left: 20,
            right: 20,
            top: 20,
            bottom: 20,
          },
        },
      },
    });
  });
</script>
@endpush