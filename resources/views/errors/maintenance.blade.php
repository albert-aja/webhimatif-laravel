<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ;?>/assets/vendor/remixicon/remixicon.css">
  <link rel="stylesheet" href="<?= base_url() ;?>/assets/css/maintenance.css">
  <title>{{ $title }} | HIMATIF - Universitas Sumatera Utara</title>
  <x-favicon/>
</head>
<body>
  <div class="mail">
    <img src="<?= base_url() ;?>/assets/img/logo/black/black_512.png" alt="Himatif USU">
    <div class="text">
      <h1>Kami akan segera kembali!</h1>
      <div class="message">
          <p>Maaf atas ketidaknyamanan ini, saat ini kami sedang melakukan beberapa pemeliharaan pada website. Jika perlu, Anda dapat menghubungi kami melalui akun media sosial kami!</p>
          <p class="from">&mdash; Himatif USU</p>
      </div>
      <div class="social-links">

        <?php foreach($social as $s) { ?>
          <a href="<?= $s['link'] ;?>" class="<?= $s['social'] ;?> social-media" 
            target="_blank" rel="noopener noreferrer" style="background: <?= $s['color'] ?>"
            data-bs-toggle="tooltip" data-bs-placement="top" title="<?= ucwords($s['social']) ;?>">
            <i class="<?= $s['icon'] ;?>"></i>
          </a>
        <?php } ?>

      </div>
    </div>
  </div>
  <script src="<?= base_url() ?>/assets/vendor/popper.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
</body>