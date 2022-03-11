<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4><?= $title; ?></h4>
            <div class="card-header-action">
                <a href="/admin/config/view_add_misi" class="form-control btn btn-icon icon-left btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah <?= $title; ?>
                </a>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tableMisi">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Misi</th>
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

<?= $this->endSection() ;?>