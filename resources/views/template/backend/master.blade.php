<!doctype html>
<html lang="en">
  <!--begin::Head--><head>
  @include('template.backend.css')
  @livewireStyles
</head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed {{ request()->routeIs('dashboard') ? '' : 'sidebar-expand-lg' }} bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      @unless (request()->routeIs('dashboard'))
        @include('template.backend.sidebar')
      @endunless
      <!--begin::App Main-->
      @yield('content')
      <!--end::App Main-->
      <!--begin::Footer-->
      @include('template.backend.footer')
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    @include('template.backend.js')
    @livewireScripts
    <!--end::Script-->
  </body>

</html>
