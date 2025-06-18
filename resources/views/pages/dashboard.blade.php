@extends('layouts.master')

@section('title','Dashboard')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row g-4">

            <div class="col-sm-6 col-md-4">
                <a href="{{ route('siswa.index') }}" class="card-link-wrapper">
                    <div class="card card-stats card-primary card-round dashboard-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Data Siswa</p>
                                        <h4 class="card-title">{{ $totalSiswa ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-4">
                <a href="{{ route('nilai.index') }}" class="card-link-wrapper">
                    <div class="card card-stats card-info card-round dashboard-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-clipboard-list fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Data Penilaian</p>
                                        <h4 class="card-title">{{ $totalPenilaian ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-4">
                <a href="{{ route('hasil.index') }}" class="card-link-wrapper">
                    <div class="card card-stats card-warning card-round dashboard-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-chart-bar fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Hasil Prediksi</p>
                                        <h4 class="card-title">{{ $totalHasil ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-4">
                <a href="{{ route('prediksi.index') }}" class="card-link-wrapper"> {{-- Assuming '#' for now as no route was provided for this one --}}
                    <div class="card card-stats card-secondary card-round dashboard-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-calculator fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Data Perhitungan</p>
                                        {{-- No count was provided for Data Perhitungan, so it's omitted --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-4">
                <a href="{{ route('rules.index') }}" class="card-link-wrapper">
                    <div class="card card-stats card-success card-round dashboard-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-sliders-h fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Aturan Fuzzy</p>
                                        {{-- No count was provided for Aturan Fuzzy, so it's omitted --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-4">
                <a href="#" class="card-link-wrapper"> {{-- Assuming '#' for now as no route was provided for this one --}}
                    <div class="card card-danger card-stats card-round dashboard-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-language fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Nilai Linguistik</p>
                                        {{-- No count was provided for Nilai Linguistik, so it's omitted --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection