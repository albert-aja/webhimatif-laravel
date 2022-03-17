@extends('_layout.admin._template')

@section('content')

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
                        <a href="/admin/divisi/view_add_divisi" class="form-control btn btn-icon icon-left btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambah Divisi
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableDivisi">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Alias</th>
                                <th>Program Kerja</th>
                                <th>Pengurus</th>
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

@endsection