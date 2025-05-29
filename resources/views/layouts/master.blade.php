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
              <h4 class="page-title">@yield('title', 'Page')</h4>
            
              @if (!request()->routeIs('dashboard'))
                <ul class="breadcrumbs">
                  <li class="nav-home">
                    <a href="{{ url('/dashboard') }}"><i class="icon-home"></i></a>
                  </li>
                  <li class="separator"><i class="icon-arrow-right"></i></li>
                  <li class="nav-item">
                    <a href="#">@yield('title', 'Page')</a>
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