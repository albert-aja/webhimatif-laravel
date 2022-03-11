<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/Jabatan" class="btn btn-icon">
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
                    <input type="hidden" name="id" value=<?= $jabatan['id'] ;?>>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jabatan<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="jabatan" id="jabatan" placeholder="Jabatan" autofocus 
                                class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ;?>" 
                                value="<?= (old('jabatan') ?? $jabatan['jabatan']) ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jabatan') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/Admin/Jabatan/edit_jabatan">Edit</button>
                                <a class="btn btn-info" href="/Admin/Jabatan">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ;?>