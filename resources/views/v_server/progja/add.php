<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/admin/divisi/progja?divisi=<?= $divisi['slug']; ?>" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1><?= $title; ?>  <?= $divisi['alias']; ?></h1>
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
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Program Kerja<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="progja" id="progja" class="form-control <?= ($validation->hasError('progja')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Progja" value="<?= old('progja') ;?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('progja') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <textarea oninput="auto_grow(this)" class="form-control single-textarea <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ;?>" name="deskripsi" placeholder="Deskripsi"><?= old('deskripsi') ;?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('deskripsi') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/progja/add_progja?divisi=<?= $divisi['slug']; ?>">Tambah</button>
                                <a class="btn btn-info" href="/admin/divisi/progja?divisi=<?= $divisi['slug']; ?>">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ;?>