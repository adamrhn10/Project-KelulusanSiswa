<div class="main-header">
    <div class="main-header-logo">
      <div class="logo-header" data-background-color="dark">
        <a href="{{ url('/dashboard') }}" class="logo text-white text-decoration-none fw-bold fs-5">
          MyApp
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
          <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
        </div>
        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
      </div>
    </div>
  
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
      <div class="container-fluid">
        <ul class="navbar-nav ms-auto align-items-center">
          {{-- Tambahkan tombol atau item lain di sini jika perlu --}}
          <li class="nav-item">
            <span class="text-muted small">Welcome to MyApp</span>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  