<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{ url('/dashboard') }}" class="logo text-white text-decoration-none fw-bold fs-5">
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
                <h4 class="text-section">Components</h4>
              </li>
              <li class="nav-item {{ request()->is('analytics') ? 'active' : '' }}">
                <a href="{{ route('analytics') }}">
                  <i class="fas fa-chart-line"></i>
                  <p>Analytics</p>
                </a>
              </li>
              <li class="nav-item {{ request()->is('settings') ? 'active' : '' }}">
                <a href="{{ route('settings') }}">
                  <i class="fas fa-cog"></i>
                  <p>Settings</p>
                </a>
              </li>
          {{-- Tambahkan menu lainnya di sini --}}
        </ul>
      </div>
    </div>
  </div>
  