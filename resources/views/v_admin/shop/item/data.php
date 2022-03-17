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
                        <a href="/Admin/Shop/view_add_item" class="form-control btn btn-icon icon-left btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambah <?= $title; ?>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableItem">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Foto</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th class="btn-col">Aksi</th>
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