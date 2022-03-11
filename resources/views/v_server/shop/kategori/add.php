<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/shop/kategori" class="btn btn-icon">
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
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="kategori" id="kategori" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Kategori" value="<?= old('kategori') ;?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kategori') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto<span class="required">*</span></label>
                            <div class="col-sm-2 col-md-2">
                                <img src="<?= base_url() ;?>/assets/img/web/preview.png" class="img-preview">
                            </div>
                            <div class="col-sm-10 col-md-5">
                                <input type="file" name="foto" id="hero_img" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ;?>">
                                <input type="hidden" name="preview" class="hidden_prev">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto') ;?>
                                </div>
                                <p class="rules"> 
                                    * Format: .jpg, .jpeg, .png | Max size: 5mb <br>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/shop/add_category">Tambah</button>
                                <a class="btn btn-info" href="/admin/shop/kategori">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ;?>