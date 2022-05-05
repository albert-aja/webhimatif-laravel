<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <ul class="navbar-nav me-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
  </ul>
  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="dropdown" id="web-status">
      
    </li>
    <li class="dropdown">
      <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" id="dropdown-toggle">
      <div class="d-sm-none d-lg-inline-block me-1">Hi, {{ Auth::user()->username }} </div>
      <img alt="image" src="{{ asset('img/web/avatar.png') }}" class="rounded-circle mr-1"></a>
      <div class="dropdown-menu dropdown-menu-end" id="dropdown-toggle">
        {{-- <a type="button" class="dropdown-item has-icon" id="changePassword">
          <i class="fas fa-lock"></i> @lang('admin/global.change.pw')
        </a> --}}
        <a href="{{ route('admin-freshstart') }}" class="dropdown-item has-icon">
          <i class="fas fa-sync"></i> @lang('admin/global.change.year')
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('auth-logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item text-danger">
          @csrf
          <i class="fas fa-sign-out-alt"></i> Logout
          <form action="{{ route('auth-logout') }}" id="logout-form" method="POST" class="d-none">@csrf</form>
        </a>
      </div>
    </li>
  </ul>
</nav>