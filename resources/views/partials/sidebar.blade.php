<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
        <a href="{{ url('/') }}" class="logo text-white text-decoration-none flex items-center">
            <i class="fas fa-graduation-cap me-2"></i> 
            <span class="app-name">LulusApp</span>
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
                <li class="nav-item mb-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Manajemen Data --}}
                <li class="nav-section mb-3">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Manajemen Data</h4>
                </li>
                {{-- Data Siswa --}}
                <li class="nav-item mb-3 {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                    <a href="{{ route('siswa.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Data Siswa</p>
                    </a>
                </li>
                {{-- Data Kriteria --}}
                @if (Auth::user()->role === 'admin')
                <li class="nav-item mb-3 {{ request()->routeIs('kriteria.*') ? 'active' : '' }}">
                    <a href="{{ route('kriteria.index') }}">
                        <i class="fas fa-box"></i>
                        <p>Data Kriteria</p>
                    </a>
                </li>
                {{-- Data Sub Kriteria --}}
                <li class="nav-item mb-3 {{ request()->routeIs('subkriteria.*') ? 'active' : '' }}">
                    <a href="{{ route('subkriteria.index') }}">
                        <i class="fas fa-boxes"></i>
                        <p>Data Sub Kriteria</p>
                    </a>
                </li>
                {{-- Aturan Fuzzy --}}
                <li class="nav-item mb-3 {{ request()->routeIs('aturan.*') ? 'active' : '' }} ">
                    <a href="{{ route('aturan.index')}}">
                    <i class="fas fa-sliders-h"></i>
                        <p>Aturan Fuzzy</p>
                    </a>
                </li>
                @endif
                {{-- Data Penilaian --}}
                <li class="nav-item mb-3 {{request()->routeIs('nilai.*') ? 'active' : ''}} ">
                    <a href=" {{ route('nilai.index')}}">
                        <i class="fas fa-pencil-alt"></i>
                        <p>Data Penilaian</p>
                    </a>
                </li>
                {{-- Hasil Prediksi --}}
                <li class="nav-item mb-3 {{request()->routeIs('prediksi.*') ? 'active' : ''}}">
                    <a href="{{ route('prediksi.index')}}">
                        <i class="fas fa-chart-bar"></i>
                        <p>Hasil Prediksi</p>
                    </a>
                </li>

                {{-- Manajemen User --}}
                <li class="nav-section mb-3">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Manajemen User</h4>
                </li>
                {{-- Data User --}}
                @if (Auth::user()->role === 'admin')
                <li class="nav-item mb-3 {{ request()->routeIs('users.*') ? 'active' : '' }} ">
                    <a href="{{ route('users.index')}}"> {{-- Perbaiki href --}}
                        <i class="fas fa-users"></i>
                        <p>Data User</p>
                    </a>
                </li>
                @endif
                {{-- Account Settings --}}
                <li class="nav-item mb-3 {{ request()->routeIs('account.*') ? 'active' : '' }}">
                    <a href="{{ route('account.edit') }}">
                        <i class="fas fa-user-cog"></i>
                        <p>Pengaturan Akun</p>
                    </a>
                </li>

                {{-- Logout  --}}
                <li class="nav-item mb-3">
                    <a href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>