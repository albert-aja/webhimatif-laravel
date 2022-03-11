<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/shop/kategori" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1><?= $title. ' ' .$kategori['kategori'] ?></h1>
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
                        <input type="hidden" name="old_img" value=<?= $kategori['foto'] ;?>>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="kategori" id="kategori" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Kategori" autofocus 
                                value="<?= (old('kategori')) ?? $kategori['kategori'];?>" >
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kategori') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto<span class="required">*</span></label>
                                <div class="col-sm-2 col-md-2">
                                    <img src="<?= base_url() ;?>/assets/img/web/shop/<?= $kategori['foto'] ;?>" class="img-preview">
                                </div>
                                <div class="col-sm-10 col-md-5">
                                    <input type="file" name="foto" id="foto" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ;?>">
                                    <input type="hidden" name="preview" class="hidden_prev">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto') ;?>
                                    </div>
                                    <p class="rules"> 
                                        * Format: .jpg, .jpeg, .png | Max size: 4mb <br>
                                        Note: Tidak perlu upload gambar lagi apabila tidak ada perubahan. <br>
                                        <a class="rules" target="_blank" href="https://compresspng.com/">Image Compress</a>
                                    </p>
                                </div>
                            </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/shop/edit_category?id=<?= $kategori['id']; ?>">Edit</button>
                                <a class="btn btn-info" href="/Admin/shop/kategori">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ;?>