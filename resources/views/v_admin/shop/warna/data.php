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
                    <h4><?= $title; ?></h4>
                    <div class="card-header-action">
                        <a href="/Admin/Shop/view_add_warna" class="form-control btn btn-icon icon-left btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambah <?= $title; ?>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableWarna">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Warna</th>
                                    <th>Hex</th>
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