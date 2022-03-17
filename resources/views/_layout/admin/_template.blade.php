<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Title -->
    <title>
      {{ $title }} | Admin Himatif USU
    </title>

    <!-- Favicon -->
    <x-favicon/>
    
<!-- meta -->
    @include('_layout.admin._meta')

    <!-- css -->
    @stack('prepend-style')
    @include('_layout.admin._css')
    @stack('addon-style')
  </head>

  <body>
    <!-- preloader -->
    @include('_layout.admin._preloader')
    
    <div id="app">
      <div class="main-wrapper">

        @includeWhen(session()->has('message'), '_layout.toast')

        <!-- navbar -->
        @include('_layout.admin._nav')

        <!-- Sidebar -->
        @include('_layout.admin._sidebar')
        
        <!-- Main Content -->
        <div class="main-content">

          <!-- content -->
          @yield('content')

        </div>

        <!-- footer -->
        @include('_layout.admin._footer')

      </div>
    </div>

    <!-- js script -->
    @stack('prepend-script')
    @include('_layout.admin._js')
    @stack('addon-script')
  </body>
</html>