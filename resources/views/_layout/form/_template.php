<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Title -->
    <title><?= $title; ?>  | HIMATIF - Universitas Sumatera Utara</title>

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url(); ?>/assets/img/favicon/favicon.ico">
    
    <!-- meta -->
    <?= $this->include('_layout/admin/_meta') ?>

    <!-- css --> 
    <?= $this->include('_layout/form/_css') ?>
  </head>

  <body>
    <?= $this->include('_layout/user/_preloader') ?>

    <div class="form-bg">
      <?= $this->renderSection('form') ?>
    </div>

  <script>
  function password_show_hide() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  
  function pass_confirm_show_hide() {
    var x = document.getElementById("pass_confirm");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  </script>
  <?= $this->include('_layout/form/_js') ?>
  </body>
</html>