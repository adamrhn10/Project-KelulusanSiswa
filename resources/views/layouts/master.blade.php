<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials.head')
    <script>
      (function() {
        if (localStorage.getItem('sidebar_minimized') === 'true') {
          document.documentElement.classList.add('sidebar_minimize');
        }
      })();
    </script>
  </head>
  <body>
    <div class="wrapper">
      @include('partials.sidebar')

      <div class="main-panel">
        @include('partials.navbar')

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h4 class="page-title">@yield('title', 'Page')</h4>

              {{-- Bagian Breadcrumbs --}}
              @if (!request()->routeIs('dashboard'))
                <ul class="breadcrumbs">
                  <li class="nav-home">
                    <a href="{{ route('dashboard') }}"><i class="icon-home"></i></a>
                  </li>
                  <li class="separator"><i class="icon-arrow-right"></i></li>

                  <?php
                    // Ambil nama rute saat ini
                    $currentRouteName = request()->route()->getName();
                    $moduleTitle = '';
                    $moduleRoute = '';

                    // Logika untuk menentukan judul modul utama berdasarkan nama rute
                    // Anda bisa menambahkan lebih banyak kondisi di sini untuk modul lain
                    if (\Illuminate\Support\Str::startsWith($currentRouteName, 'siswa')) {
                        $moduleTitle = 'Data Siswa';
                        $moduleRoute = 'siswa.index';
                    } elseif (\Illuminate\Support\Str::startsWith($currentRouteName, 'nilai')) {
                        $moduleTitle = 'Data Nilai';
                        $moduleRoute = 'nilai.index';
                    } elseif (\Illuminate\Support\Str::startsWith($currentRouteName, 'hasil')) {
                        $moduleTitle = 'Hasil Prediksi';
                        $moduleRoute = 'hasil.index';
                    }
                  ?>

                  @if ($moduleTitle)
                    {{-- Breadcrumb untuk modul utama (misal: Data Siswa) --}}
                    <li class="nav-item">
                        <a href="{{ route($moduleRoute) }}">{{ $moduleTitle }}</a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                  @endif

                  {{-- Item breadcrumb terakhir: Judul halaman saat ini --}}
                  <li class="nav-item">
                    @yield('title', 'Page')
                  </li>
                </ul>
              @endif
            </div>            
            @yield('content')
          </div>
        </div>

        @include('partials.footer')
      </div>
    </div>

    @include('partials.scripts')
  </body>
</html>
