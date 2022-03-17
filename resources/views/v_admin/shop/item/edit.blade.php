@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/Shop" class="btn btn-icon">
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
                        <input type="hidden" name="id" value="<?= $item['id'] ;?>">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Produk<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="item" id="item" class="form-control <?= ($validation->hasError('item')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Nama Produk" value="<?= old('item') ?? $item['item'] ;?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('item') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto Produk<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <div class="<?= ($validation->hasError('foto')) ? 'is-invalid' : '' ;?>">
                                    <div class="input-images" data-folder="<?= base_url(). '/assets/img/shop/' .$folder ;?>"
                                    data-images="<?= $item['foto'] ;?>"></div>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto') ;?>
                                    <?= session('msg') ?>
                                </div>
                                <p class="rules"> 
                                    * Format: .jpg, .jpeg, .png | Max size: 5mb | Max uploaded photo : 10<br>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <textarea name="deskripsi" id="ckeditor" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ;?>">
                                    <?= old('deskripsi') ?? $item['deskripsi'] ;?>
                                </textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('deskripsi') ;?>    
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2 <?= ($validation->hasError('kategori')) ? 'is-invalid' : '' ;?>" 
                                name="kategori" id="kategori" value="<?= old('kategori') ?>">
                                    <option value="" disabled selected>Kategori</option>
                                    <?php foreach($kategori as $k){ ?>
                                        <option value="<?= $k['id'] ;?>"
                                        <?php  
                                            if($k['id'] == $item['kategori']){
                                                echo 'selected';
                                            }
                                        ?>
                                        ><?= $k['kategori'] ;?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kategori') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Warna Item</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="row gutters-xs">
                                    <?php  
                                        foreach($warna as $w){
                                    ?>
                                        <div class="col-auto">
                                            <label class="colorinput">
                                                <input name="color[]" type="checkbox" 
                                                value="<?= $w['id'] ;?>" class="colorinput-input" 
                                                <?php 
                                                    if(old('color') && in_array($w['id'], old('color'))){
                                                        echo 'selected';
                                                    } else {
                                                        $warna = explode(',', $item['warna']);
                                                        if(in_array($w['id'], $warna)){
                                                            echo 'checked';
                                                        } 
                                                    }
                                                ?>/>
                                                <span class="colorinput-color" style="background-color: <?= $w['hex'] ?>"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="<?= ucwords($w['warna']) ;?>"></span>
                                            </label>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <input type="checkbox" value="<?= $w['id'] ;?>" id="checkAll"/> Check All
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Item<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="harga" id="harga" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Harga (contoh: 10000)" value="<?= old('harga') ?? $item['harga'];?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('harga') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/shop/update_item">Edit Produk</button>
                                <a class="btn btn-info" href="/admin/shop">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('addon-script')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        let editor = CKEDITOR.replace('ckeditor', {
            height: 300
        });
    </script>
@endpush