@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/KontakUM/kontak" class="btn btn-icon">
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
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Media Sosial<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="social" id="mediaSosial" class="form-control <?= ($validation->hasError('social')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Media Sosial" value="<?= old('social') ;?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('social') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link<span class="required">*</span></label>
                            <div class="col-sm-10 col-md-6">
                                <input type="url" name="link" id="linkMediaSosial" class="form-control <?= ($validation->hasError('link')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Link Media Sosial (https://example.com)" value="<?= old('link') ;?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('link') ;?>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <a href="<?= old('link') ;?>" class="btn btn-secondary" id="linkTo"
                                target="_blank" rel="noopener noreferrer" style="pointer-events: none">Coba Link</a>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Icon<span class="required">*</span></label>
                            <div class="selectgroup selectgroup-pills col-sm-12 col-md-7" id="selecticons">
                                <div class="<?= ($validation->hasError('icon')) ? 'is-invalid' : '' ;?>">
                                <?php 
                                    $icon_arr = icon_array();
                                    $existed_arr = [];
                                    $unsetted = 0;
                                    
                                    for($i=0;$i<count($icon_arr) + $unsetted;$i++){
                                        if(!empty($existed)){
                                            if(in_array($icon_arr[$i]['icon'], $existed)){
                                                $key = array_search($icon_arr[$i]['icon'], $existed);
                                                unset($existed[$key]);
                                                array_push($existed_arr, $icon_arr[$i]);
                                                unset($icon_arr[$i]);
                                                $unsetted++;
                                            }
                                        }
                                    }
                                    
                                    foreach($icon_arr as $ia){
                                ?>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon" value="<?= $ia['icon'] ;?>" class="selectgroup-input
                                    form-control <?= ($validation->hasError('icon')) ? 'is-invalid' : '' ;?>">
                                    <span class="selectgroup-button selectgroup-button-icon" 
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="<?= ucwords($ia['name']) ?>">
                                        <i class="<?= $ia['icon'] ;?>"></i>
                                    </span>
                                </label>
                                <?php 
                                    }
                                    foreach($existed_arr as $ea){
                                ?>
                                <label class="selectgroup-item">
                                    <input type="radio" class="selectgroup-input existed" disabled>
                                    <span class="selectgroup-button selectgroup-button-icon" 
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="<?= ucwords($ea['name']) ?>">
                                        <i class="<?= $ea['icon'] ;?>"></i>
                                    </span>
                                </label>
                                <?php 
                                    }
                                ?>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('icon') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Warna<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group colorpickerinput">
                                    <input type="text" id="hex-input" class="form-control <?= ($validation->hasError('hex')) ? 'is-invalid' : '' ;?>" 
                                    name="hex" placeholder="Hex Code" value="<?= old('hex') ;?>">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-fill-drip"></i>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hex') ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Preview</label>
                            <div class="col-sm-12 col-md-7 social-links">
                                <a class="social-media" id="preview-btn" target="_blank" rel="noopener noreferrer"
                                style="background-color: <?= old('hex') ?> ">
                                    <i id="preview-icon" class="<?= (old('icon')) ?? 'ri-question-fill ri-lg' ;?>"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary" type="submit" formaction="/admin/KontakUM/add_kontakUM">Tambah</button>
                                <a class="btn btn-info" href="/admin/KontakUM/kontak">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection