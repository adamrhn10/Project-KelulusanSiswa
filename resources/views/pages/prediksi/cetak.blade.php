<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kelulusan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 40px;
            font-size: 12px;
        }

        .header {
            position: relative;
            text-align: center;
            min-height: 90px;
        }

        .header img {
            position: absolute;
            top: 0;
            left: 0;
            width: 80px;
            height: auto;
        }

        .header .title {
            display: inline-block;
        }

        .header .title h2,
        .header .title h4 {
            margin: 0;
        }

        .line-double {
            border-top: 3px double #000;
            margin-top: 4px;
            margin-bottom: 4px;
        }

        .report-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .report-title h3 {
            margin-bottom: 2px;
        }

        .report-title h4 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
            vertical-align: middle;
        }

        .signature {
            margin-top: 50px;
            width: 100%;
            text-align: right;
            page-break-inside: avoid;
        }

        .signature p {
            margin: 2px 0;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <img src="{{ public_path('logo.jpg') }}" alt="Logo Sekolah">
        <div class="title">
            <h4>DINAS PENDIDIKAN KABUPATEN BOGOR</h4>
            <h4>UPTD PENDIDIKAN KECAMATAN CILEUNGSI</h4>
            <h2>SMK MUHAMMADIYAH 1 CILEUNGSI</h2>
            <h4>Jl. Anggrek No.86, Cileungsi, Kab. Bogor, Jawa Barat 16820</h4>
        </div>
    </div>

    <!-- GARIS PEMISAH -->
    <div class="line-double"></div>

    <!-- JUDUL LAPORAN -->
    <div class="report-title">
        <h3>LAPORAN KELULUSAN SISWA KELAS XII</h3>
        <h4>TAHUN PELAJARAN {{ now()->subYear()->format('Y') }}/{{ now()->format('Y') }}</h4>
    </div>

    <!-- TABEL DATA -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Jurusan</th>
                <th>Nilai Fuzzy</th>
                <th>Hasil Prediksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($hasilPrediksi as $h)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $h->siswa->nisn ?? '-' }}</td>
                    <td>{{ $h->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ $h->siswa->jurusan ?? '-' }}</td>
                    <td>{{ number_format($h->nilai_fuzzy, 2) }}</td>
                    <td>{{ $h->hasil_prediksi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada hasil prediksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="signature" style="page-break-inside: avoid;">
        <p>Cileungsi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Kepala Sekolah</p>
        <br><br><br>
        <p><strong>Pamuji Agustiar Ma'sudi,S.T</strong></p>
        <p>NBM: 953.870</p>
    </div>

</body>
</html>
