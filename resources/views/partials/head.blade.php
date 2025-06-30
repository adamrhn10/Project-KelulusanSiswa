<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', 'LulusApp')</title>
<link rel="icon" href="{{asset('template/assets/img/favicon.ico')}}" />

<!-- Fonts and Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="{{asset('template/assets/js/plugin/webfont/webfont.min.js')}}"></script>
<script>
    WebFont.load({
        {{-- Hapus 'google' families untuk Public Sans karena kita menggunakan Poppins via link tag --}}
        custom: {
            families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
            urls: ["{{ asset('template/assets/css/fonts.min.css') }}"],
        },
        active: function () {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- CSS -->
<link rel="stylesheet" href="{{asset('template/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{asset('template/assets/css/plugins.min.css') }}">
<link rel="stylesheet" href="{{asset('template/assets/css/kaiadmin.min.css') }}">

<style>
   body,
    html,
    .alert, .brand, .btn-simple, .h1, .h2, .h3, .h4, .h5, .h6, .navbar, .td-name,  button.close, h1, h2, h3, h4, h5, h6, td {
        font-family: 'Poppins', sans-serif !important;
    }
    body, html {
        font-size: 14px;
    }
    .sidebar .logo .app-name {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 23px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        transition: all 0.3s ease;
    }
    .sidebar .logo .fas.fa-graduation-cap {
        font-size: 30px;
    }

</style>