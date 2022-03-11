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
                    <h4>Form <?= $title; ?></h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <?= csrf_field() ;?>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Divisi<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="nama" id="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Nama Divisi" value="<?= old('nama') ;?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Alias<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="alias" id="alias" class="form-control <?= ($validation->hasError('alias')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Contoh : BPH, Mulkom, Litbang" value="<?= old('alias') ;?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('alias') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/divisi/add_divisi">Tambah</button>
                                <a class="btn btn-info" href="/admin/divisi">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ;?>