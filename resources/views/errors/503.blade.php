<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/remixicon/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('css/maintenance.css') }}">
  <title>@lang('maintenance.pageTitle') | @lang('global.company')</title>
  <x-favicon/>
</head>
<body>
  <div class="mail">
    <img src="{{ asset('img/logo/black/black_512.png') }}" alt="Himatif USU">
    <div class="text">
      <h1>@lang('maintenance.title')</h1>
      <div class="message">
        <p>@lang('maintenance.subtitle')</p>
        <p class="from">@lang('maintenance.from')</p>
      </div>
      <div class="social-links">

        @foreach(App\Models\Social_Media::all() as $social)
          <a href={{ $social['link'] }} class="{{ $social['social'] }} social-media" 
            target="_blank" rel="noopener noreferrer" style="background: {{ $social['color'] }}"
            data-bs-toggle="tooltip" data-bs-placement="top" title={{ ucwords($social['social']) }}>
            <i class={{ $social['icon'] }}></i>
          </a>
        @endforeach

      </div>
    </div>
  </div>
  <script src="{{ asset('vendor/popper.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
</body>