

<script src="{{asset('template/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{asset('template/assets/js/core/popper.min.js') }}"></script>
<script src="{{asset('template/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/chart.js/chart.min.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/chart-circle/circles.min.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/jsvectormap/world.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/gmaps/gmaps.js') }}"></script>
<script src="{{asset('template/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{asset('template/assets/js/kaiadmin.min.js') }}"></script>

{{-- Pastikan ini berada di bagian paling bawah file scripts.blade.php --}}
{{-- Semua skrip yang di-push dari child view akan dirender di sini --}}
@stack('scripts')