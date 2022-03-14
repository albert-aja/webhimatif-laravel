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
                <h4><?= $title; ?></h4>
                <div class="card-header-action">
                  <button type="button" class="form-control btn btn-icon icon-left btn-danger" id="hapusTable" data-table="*">
                    <i class="fas fa-bomb"></i>
                    Truncate All
                  </button>
                </div>
            </div> 
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableTruncate">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama Tabel</th>
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

<div id="modal-div"></div>

<?= $this->endSection() ;?>