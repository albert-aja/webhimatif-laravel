@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/Shop/Warna" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1><?= $title. " '" .$warna['warna']. "'" ?></h1>
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
                        <input type="hidden" name="id" value="<?= $warna['id'] ?>">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Warna<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="warna" id="warna" class="form-control <?= ($validation->hasError('warna')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Warna" value="<?= old('warna') ?? $warna['warna'] ;?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('warna') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hex<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group colorpickerinput">
                                    <input type="text" class="form-control <?= ($validation->hasError('hex')) ? 'is-invalid' : '' ;?>" name="hex" placeholder="Hex Code (#fff, #303030)" 
                                    id="hex-input" value="<?= old('hex') ?? $warna['hex'] ;?>" maxlength="7" pattern="^#(?:[0-9a-fA-F]{3}){1,2}$">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-fill-drip"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('hex') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary" type="submit" formaction="/admin/shop/edit_warna">Tambah</button>
                                <a class="btn btn-info" href="/admin/shop/warna">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ;?>