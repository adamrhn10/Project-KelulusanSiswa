<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials.head')
    <script>
      // Apply the class as early as possible to prevent FOUC (Flash Of Unstyled Content)
      (function() {
        if (localStorage.getItem('sidebar_minimized') === 'true') {
          document.documentElement.classList.add('sidebar_minimize'); // Or document.body.classList.add('sidebar_minimize');
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
              {{-- Judul Halaman (akan diisi dari @yield('title') di child view) --}}
              <h4 class="page-title">@yield('title', 'Page')</h4>
            
              {{-- Bagian Breadcrumbs --}}
              @unless (request()->routeIs('dashboard')) {{-- Breadcrumbs tidak ditampilkan di halaman dashboard --}}
                <ul class="breadcrumbs">
                  <li class="nav-home">
                    <a href="{{ route('dashboard') }}"><i class="icon-home"></i></a> {{-- Link Home ke Dashboard --}}
                  </li>
                  
                  <?php
                    // Ambil objek rute saat ini
                    $currentRoute = request()->route();
                    $currentRouteName = $currentRoute ? $currentRoute->getName() : null; // Pastikan rute ada

                    $moduleData = null;
                    $modules = [
                        'siswa' => ['title' => 'Data Siswa', 'route' => 'siswa.index'],
                        'nilai' => ['title' => 'Data Penilaian', 'route' => 'nilai.index'],
                        'prediksi' => ['title' => 'Data Perhitungan', 'route' => 'prediksi.index'],
                        'hasil' => ['title' => 'Hasil Prediksi', 'route' => 'hasil.index'],
                        // Tambahkan modul lain di sini jika ada (users, profile, settings, etc.)
                        'users' => ['title' => 'Manajemen User', 'route' => 'users.index'],
                        'profile' => ['title' => 'Data Profile', 'route' => 'profile.show'], // Pastikan route profile.show ada dan menerima Auth::id()
                    ];

                    foreach ($modules as $key => $data) {
                        if (\Illuminate\Support\Str::startsWith($currentRouteName, $key)) {
                            $moduleData = $data;
                            break;
                        }
                    }

                    $isModuleIndexPage = ($moduleData && $currentRouteName === $moduleData['route']);
                    $currentTitle = trim(View::yieldContent('title', 'Page')); // Ambil judul yang di-yield
                  ?>

                  @if ($moduleData)
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">
                        @if (!$isModuleIndexPage)
                            {{-- Jika bukan halaman indeks modul, buat link ke indeks modul --}}
                            <a href="{{ route($moduleData['route']) }}">{{ $moduleData['title'] }}</a>
                        @else
                            {{-- Jika ini halaman indeks modul, tampilkan teks saja (tidak perlu link balik ke dirinya sendiri) --}}
                            {{ $moduleData['title'] }}
                        @endif
                    </li>
                  @endif

                  {{-- Item breadcrumb terakhir: Judul halaman saat ini --}}
                  {{-- Tampilkan hanya jika ini bukan halaman indeks modul, dan judul modul berbeda dengan judul halaman saat ini --}}
                  @if (!$isModuleIndexPage && ($moduleData ? $currentTitle !== $moduleData['title'] : true))
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">
                        {{ $currentTitle }} {{-- Ini bukan tautan, hanya teks biasa --}}
                    </li>
                  @endif
                </ul>
              @endunless
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
