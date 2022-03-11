<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/Divisi" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1><?= $title; ?></h1>
        <?= $breadcrumb ;?>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4><?= $title; ?></h4>
                    <div class="card-header-action">
                        <a href="/Admin/Progja/view_add_progja?divisi=<?= $divisi['slug']; ?>" class="form-control btn btn-icon icon-left btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambah <?= $title; ?>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableProgja">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Program Kerja</th>
                                <th>Deskripsi</th>
                                <th>Divisi</th>
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