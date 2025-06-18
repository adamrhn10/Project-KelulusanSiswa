<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', 'MyApp')</title>
<link rel="icon" href="{{asset('template/assets/img/kaiadmin/favicon.ico')}}" />

<!-- Fonts and Icons -->
<script src="{{asset('template/assets/js/plugin/webfont/webfont.min.js')}}"></script>
<script>
  WebFont.load({
    google: { families: ["Public Sans:300,400,500,600,700"] },
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
    .dataTable thead { /* Mengubah selektor dari #nilai-table menjadi .dataTable */
        background-color: #1a2035 !important; /* Warna dari .table-head-bg-black */
        color: #ffffff !important;           /* Warna teks putih */
    }

    .dataTable thead th { /* Mengubah selektor dari #nilai-table menjadi .dataTable */
        background-color: #1a2035 !important; /* Warna dari .table-head-bg-black */
        color: #ffffff !important;           /* Warna teks putih */
        /* Anda mungkin perlu menyesuaikan padding jika !important ini menyebabkan masalah */
        /* padding: 12px 24px !important; */ 
    }

    .dataTable thead .sorting_asc:after, /* Mengubah selektor dari #nilai-table menjadi .dataTable */
    .dataTable thead .sorting_desc:before { /* Mengubah selektor dari #nilai-table menjadi .dataTable */
        color: #ffffff !important; /* Pastikan ikon sorting juga putih */
    }

    .dashboard-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        cursor: pointer; /* Indicate clickability */
    }

    .dashboard-card:hover {
        transform: translateY(-5px); /* Lift effect */
        box-shadow: 0 10px 20px rgba(0,0,0,0.2); /* Enhanced shadow */
    }

    .card-link-wrapper {
        text-decoration: none; /* Remove underline from the link */
        color: inherit; /* Inherit text color */
        display: block; /* Make the link take up full block space */
        height: 100%; /* Ensure the link wrapper takes full height */
    }

    /* Optional: Icon animation on hover */
    .dashboard-card:hover .icon-big i {
        transform: scale(1.1);
        transition: transform 0.2s ease-in-out;
    }
</style>