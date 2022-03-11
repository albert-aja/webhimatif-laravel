<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Divisi</h4>
            </div>
            <div class="card-body">
              <?= $jumlahDivisi ;?>
            </div>
            <a href="<?= base_url('Admin/Divisi') ?>" class="text-small stretched-link">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pengurus</h4>
            </div>
            <div class="card-body">
              <?= $jumlahPengurus ;?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-file-alt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Berita</h4>
            </div>
            <div class="card-body">
              <?= $jumlahBerita ;?>
            </div>
            <a href="<?= base_url('Admin/Berita') ?>" class="text-small stretched-link">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Produk</h4>
            </div>
            <div class="card-body">
              <?= $jumlahProduk ;?>
            </div>
            <a href="<?= base_url('Admin/Shop/Item') ?>" class="text-small stretched-link">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="data-berita">
      <div class="section-header dt-toggle">
          <a data-bs-toggle="collapse" data-bs-target="#dataBerita">
            <h1>Berita</h1>
            <i class="fas fa-chevron-down icon-show"></i>
            <i class="fas fa-times icon-close"></i>
          </a>
      </div>
      <div class="section-body show" id="dataBerita">
        <div class="row">
          <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card news-chart">
              
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card card-hero top-news">
              
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card latest-news">
              
            </div>
          </div>
          <div class="col-md-6">
            
          </div>
        </div>
      </div>
    </div>

    <div class="data-pengurus">
      <div class="section-header dt-toggle">
          <a data-bs-toggle="collapse" data-bs-target="#dataPengurus">
            <h1>Pengurus Divisi</h1>
            <i class="fas fa-chevron-down icon-show"></i>
            <i class="fas fa-times icon-close"></i>
          </a>
      </div>
      <div class="section-body show" id="dataPengurus">
        <div class="row">
          <div class="col">
            <div class="card anggota-himatif">

            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

@endsection