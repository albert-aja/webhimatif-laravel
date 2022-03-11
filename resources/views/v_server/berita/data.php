<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>  

<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <?= $breadcrumb ;?>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Tabel <?= $title; ?></h4>
                    <div class="card-header-action">
                        <a class="form-control btn btn-icon icon-left btn-primary" href="/admin/berita/write">
                            <i class="fas fa-plus"></i>
                            Tambah <?= $title; ?>
                        </a>
                    </div>
                </div> 
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableBlog">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th>Artikel</th>
                                    <th>Hero Image</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Divisi</th>
                                    <th>Viewed</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ;?>