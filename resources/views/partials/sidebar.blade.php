<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
        {{-- Mengarahkan logo ke halaman utama/dashboard --}}
        <a href="{{ url('/') }}" class="logo text-white text-decoration-none fw-bold fs-3"> {{-- Mengubah fs-5 menjadi fs-3 untuk ukuran font lebih besar --}}
            {{-- Konten logo yang diperbarui --}}
            <span class="app-name">LulusApp</span>
            {{-- Ikon ditambahkan di sini --}}
            <i class="fas fa-graduation-cap ms-2"></i> {{-- Menambahkan ikon topi toga --}}
        </a>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
        </div>
        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
    </div>
    {{-- Akhir dari logo-header --}}

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- Dashboard --}}
                <li class="nav-item mb-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}"> {{-- Tambah mb-2 --}}
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Manajemen Data --}}
                <li class="nav-section mb-3"> {{-- Tambah mb-2 untuk section --}}
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Manajemen Data</h4>
                </li>
                {{-- Data Siswa --}}
                <li class="nav-item mb-3 {{ request()->routeIs('siswa.*') ? 'active' : '' }}"> {{-- Tambah mb-2 --}}
                    <a href="{{ route('siswa.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Data Siswa</p>
                    </a>
                </li>
                {{-- Data Kriteria --}}
                <li class="nav-item mb-3 {{ request()->routeIs('kriteria.*') ? 'active' : '' }}"> {{-- Tambah mb-2 --}}
                    <a href="{{ route('kriteria.index') }}">
                        <i class="fas fa-box"></i>
                        <p>Data Kriteria</p>
                    </a>
                </li>
                {{-- Data Sub Kriteria --}}
                <li class="nav-item mb-3 {{ request()->routeIs('subkriteria.*') ? 'active' : '' }}"> {{-- Tambah mb-2 --}}
                    <a href="{{ route('subkriteria.index') }}">
                        <i class="fas fa-boxes"></i>
                        <p>Data Sub Kriteria</p>
                    </a>
                </li>
                {{-- Aturan Fuzzy --}}
                <li class="nav-item mb-3 {{ request()->routeIs('aturan.*') ? 'active' : '' }} "> {{-- Tambah mb-2 --}}
                    <a href="{{ route('aturan.index')}}">
                    <i class="fas fa-sliders-h"></i>
                        <p>Aturan Fuzzy</p>
                    </a>
                </li>
                {{-- Data Penilaian --}}
                <li class="nav-item mb-3 {{request()->routeIs('nilai.*') ? 'active' : ''}} "> {{-- Tambah mb-2 --}}
                    <a href=" {{ route('nilai.index')}}">
                        <i class="fas fa-pencil-alt"></i>
                        <p>Data Penilaian</p>
                    </a>
                </li>

                {{-- Hasil Prediksi --}}
                <li class="nav-item mb-3 {{request()->routeIs('prediksi.*') ? 'active' : ''}}"> {{-- Tambah mb-2 --}}
                    <a href="{{ route('prediksi.index')}}">
                        <i class="fas fa-chart-bar"></i>
                        <p>Hasil Prediksi</p>
                    </a>
                </li>

                {{-- Manajemen User --}}
                <li class="nav-section mb-3"> {{-- Tambah mb-2 untuk section --}}
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Manajemen User</h4>
                </li>
                {{-- Data User --}}
                <li class="nav-item mb-3 "> {{-- Tambah mb-2 --}}
                    <a href="">
                        <i class="fas fa-users"></i>
                        <p>Data User</p>
                    </a>
                </li>
                {{-- Data Profile --}}
                <li class="nav-item mb-3 "> {{-- Tambah mb-2 --}}
                    <a href="">
                        <i class="fas fa-user-circle"></i>
                        <p>Data Profile</p>
                    </a>
                </li>

                {{-- Contoh Logout (jika belum ada di tempat lain) --}}
                <li class="nav-item mb-3"> {{-- Tambah mb-2 --}}
                    <a href="">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form-sidebar" action="">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
