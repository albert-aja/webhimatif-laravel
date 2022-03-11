<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Title -->
    <title>
      {{ $title }} | HIMATIF - Universitas Sumatera Utara
    </title>

    <!-- Favicon -->
    <x-favicon/>

    <!-- meta -->
    @include('_layout.user._meta')

    <!-- css -->
    @stack('prepend-style')
    @include('_layout.user._css')
    @stack('addon-style')
  </head>

  <body class="unscrollable">

    <!-- preloader -->
    @include('_layout.user._preloader')

    <!-- header -->
    @include('_layout.user._navbar')

    @if(is_null(Request::segment(1)))
      @include('_layout/user/_hero')
    @else
      @if(strtolower(Request::segment(1)) != 'artikel' && strtolower(Request::segment(2)) != 'preview_article')
        @include('_layout/user/_header')
      @else
        <div class="scroll-progress" id="scroll-progress-bot"></div>
      @endif
    @endif
    
    <!-- content -->
    @yield('content')
    
    <!-- footer -->
    @include('_layout/user/_footer')

    <a href={{ (!is_null(Request::segment(1)) && strtolower(Request::segment(1)) == 'artikel') ? '#news' : '#hero'}} class="back-to-top d-flex align-items-center justify-content-center">
      <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- js script -->
    @stack('prepend-script')
    @include('_layout/user/_js')
    @stack('addon-script')
  </body>
</html>