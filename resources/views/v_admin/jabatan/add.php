@extends('_layout.admin._template')

@section('content')

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
                <form method="post">
                    <?= csrf_field() ;?>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jabatan<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="jabatan" id="jabatan" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Jabatan" value="<?= old('jabatan') ;?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jabatan') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/Admin/Jabatan/add_jabatan">Add</button>
                                <a class="btn btn-info" href="/Admin/jabatan">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ;?>