@extends('_layout.admin._template')

@section('content')

<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1><?= $title ;?></h1>
        <?= $breadcrumb ;?>
    </div>
    <div class="header">
        <h2 class="section-title">Fitur Ganti Kepengurusan</h2>
        <p class="section-lead">Fitur cepat untuk ganti kepengurusan dengan menghapus data-data kepengurusan sebelumnya</p>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="activities">
                <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="mb-2">
                            <span class="text-job">Perubahan pada mode website</span>
                        </div>
                        <span class="badge badge-success">Active Mode</span>
                        &nbsp;
                        <i class="fas fa-arrow-right"></i>
                        &nbsp;
                        <span class="badge badge-danger">Maintenance Mode</span>
                    </div>
                </div>
                <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="mb-2">
                            <span class="text-job">Perubahan pada tahun kepengurusan</span>
                        </div>
                        <span class="badge badge-info">
                            <?= $this->data['periode']->year ?>
                        </span>
                        &nbsp;
                        <i class="fas fa-arrow-right"></i>
                        &nbsp;
                        <span class="badge badge-info">
                            <?= $this->data['tahun_kepengurusan_baru'];?>
                        </span>
                    </div>
                </div>
                <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                        <i class="fas fa-database"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="mb-2">
                            <span class="text-job">Data tabel yang dihapus</span>
                            <span class="bullet"></span>
                            <span class="text-job text-muted">Centang pada data tabel yang ingin dihapus</span>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>
                                            <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Nama Tabel</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <form method="POST" id="tableChecklist" action="<?= base_url('Admin/Feature/Regression') ;?>">
                                        <?= csrf_field() ;?>
                                        <?php foreach($table as $t){ ?>
                                            <tr>
                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input name="table[]" type="checkbox"  value="<?= $t['table'] ;?>" data-checkboxes="mygroup" class="custom-control-input" id="<?= $t['table'] ;?>" <?= ($t['checked']) ? 'checked' : '' ?> >
                                                        <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td><?= $t['table'] ;?></td>
                                                <td>
                                                    <button id="lihatDetailTabel" type="button" class="btn btn-info" data-id="<?= $t['table'] ;?>"><i class="fas fa-info"></i> Detail</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </form>
                                </table>
                            </div>
                            <button class="btn btn-warning btn-icon icon-left float-end mt-4" id="doRegression"><i class="fas fa-sync"></i> Jalankan Fitur</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="modal-div"></div>

@endsection