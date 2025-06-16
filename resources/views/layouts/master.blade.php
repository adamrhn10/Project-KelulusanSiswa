<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Head Include --}}
    @include('partials.head')

    {{-- Sidebar Minimize Script --}}
    <script>
        (function () {
            if (localStorage.getItem('sidebar_minimized') === 'true') {
                document.documentElement.classList.add('sidebar_minimize');
            }
        })();
    </script>

    {{-- Table Dark Sidebar Styling --}}
    <style>
        .table-dark-sidebar thead {
            background-color: #1B1B3A !important;
            color: #ffffff;
        }

        .table-dark-sidebar tbody tr {
            background-color: #2A2A4A;
            color: #ffffff;
        }

        .table-dark-sidebar tbody tr:nth-child(even) {
            background-color: #33335A;
        }

        .table-dark-sidebar td,
        .table-dark-sidebar th,
        table.dataTable tbody tr {
            border-color: #444;
            background-color: #2A2A4A !important;
        }

        table.dataTable thead th {
            background-color: #1B1B3A !important;
            color: white;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        {{-- Sidebar --}}
        @include('partials.sidebar')

        <div class="main-panel">
            {{-- Navbar --}}
            @include('partials.navbar')

            {{-- Page Content --}}
            <div class="container">
                <div class="page-inner">
                    {{-- Page Header --}}
                    <div class="page-header">
                        <h4 class="page-title">@yield('title', 'Page')</h4>

                        {{-- Breadcrumb (kecuali di dashboard) --}}
                        @unless (request()->routeIs('dashboard'))
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="{{ route('dashboard') }}">
                                        <i class="icon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="icon-arrow-right"></i>
                                </li>

                                @php
                                    $route = request()->route()->getName();
                                    $modules = [
                                        'siswa' => ['title' => 'Data Siswa', 'route' => 'siswa.index'],
                                        'nilai' => ['title' => 'Data Nilai', 'route' => 'nilai.index'],
                                        'hasil' => ['title' => 'Hasil Prediksi', 'route' => 'hasil.index'],
                                    ];
                                    $module = collect($modules)->first(function($_, $key) use ($route) {
                                        return \Illuminate\Support\Str::startsWith($route, $key);
                                    });
                                @endphp

                                @if ($module)
                                    <li class="nav-item">
                                        <a href="{{ route($module['route']) }}">{{ $module['title'] }}</a>
                                    </li>
                                    <li class="separator">
                                        <i class="icon-arrow-right"></i>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    @yield('title', 'Page')
                                </li>
                            </ul>
                        @endunless
                    </div>

                    {{-- Main Content --}}
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            @include('partials.footer')
        </div>
    </div>

    {{-- Scripts --}}
    @include('partials.scripts')
</body>
</html>
