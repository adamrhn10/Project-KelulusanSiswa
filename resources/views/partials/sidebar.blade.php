<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{ url('') }}" class="logo text-white text-decoration-none fw-bold fs-5">
          LulusApp
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
          <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
        </div>
        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
      </div>
    </div>
  
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Manajemen Data</h4>
              </li>
              <li class="nav-item {{ request()->is('siswa') ? 'active' : '' }}">
                <a href="{{ route('siswa') }}">
                  <i class="fas fa-user-graduate"></i>
                  <p>Data Siswa</p>
                </a>
              </li>
              <li class="nav-item {{ request()->is('nilai') ? 'active' : '' }}">
                <a href="{{ route('nilai') }}">
                  <i class="fas fa-clipboard-list"></i>
                  <p>Data Nilai Kriteria</p>
                </a>
              </li>
              <li class="nav-item {{ request()->is('hasil') ? 'active' : '' }}">
                <a href="{{ route('hasil') }}">
                  <i class="fas fa-flask"></i>
                  <p>Hasil Prediksi</p>
                </a>
              </li>
          {{-- Tambahkan menu lainnya di sini --}}
        </ul>
      </div>
    </div>
  </div>
  