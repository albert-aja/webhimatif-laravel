<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Title -->
    <title>{{ $title }} | HIMATIF - Universitas Sumatera Utara</title>

    <!-- Favicon -->
    <x-favicon/>

    <!-- meta -->
    @include('_layout.admin._meta')

    <!-- css -->
    @stack('prepend-style')
    @include('_layout.form._css')
    @stack('addon-style')
  </head>

  <body>
    <!-- preloader -->
    @include('_layout.user._preloader')

    <div class="form-bg">
      @yield('form')
    </div>

    <!-- js script -->
    @stack('prepend-script')
    @include('_layout.form._js')
    @stack('addon-script')
  </body>
</html>