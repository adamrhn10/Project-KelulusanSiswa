{{-- resources/views/pages/nilai-rapor/edit.blade.php --}}
@extends('layouts.master')

@section('title', 'Edit Nilai Rapor')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Nilai Rapor - {{ $siswa->nama_siswa }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('nilai.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                @for ($i = 1; $i <= 5; $i++)
                    @php
                        $field = "rapor{$i}";
                        $value = $nilai ? $nilai->$field : '';
                    @endphp
                    <div class="col-md-6 mb-3">
                        <label for="{{ $field }}" class="form-label">Nilai Rapor Semester {{ $i }}</label>
                        <input type="number" step="0.01" class="form-control" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $value) }}" required>
                    </div>
                @endfor
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
