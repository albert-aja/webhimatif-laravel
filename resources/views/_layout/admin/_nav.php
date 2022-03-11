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
        <div class="d-sm-none d-lg-inline-block me-1">Hi, <?= user()->username ;?> </div>
        <img alt="image" src="<?= base_url() ;?>/assets/img/web/avatar.png" class="rounded-circle mr-1"></a>
        <div class="dropdown-menu dropdown-menu-end" id="dropdown-toggle">
          <a href="<?= base_url('/Admin/Feature/change_password') ?>" class="dropdown-item has-icon">
            <i class="fas fa-lock"></i> Ganti Password
          </a>
          <a href="<?= base_url('/Admin/Feature/fresh_start') ;?>" class="dropdown-item has-icon">
            <i class="fas fa-sync"></i> Ganti Kepengurusan
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('/logout') ;?>" class="dropdown-item text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>