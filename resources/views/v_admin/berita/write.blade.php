@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/Berita" class="btn btn-icon">
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
                    <h4>Form Input Berita</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <?= csrf_field() ;?>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="title" id="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Judul" value="<?= old('title') ;?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('title') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto Utama<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7" id="img-div">
                                <div id="image-preview" class="image-preview <?= ($validation->hasError('hero_img')) ? 'is-invalid' : '' ;?>">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="hero_img" id="image-upload" class="form-control">
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('hero_img') ;?>
                                </div>
                                <p class="rules">
                                    * Format: .jpg, .jpeg, .png | Max size: 4mb <br>
                                    <a class="rules" target="_blank" rel="noopener noreferrer" href="https://compresspng.com/">Image Compress</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Artikel<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <textarea name="article" id="ckeditor" class="form-control <?= ($validation->hasError('article')) ? 'is-invalid' : '' ;?>">
                                    <?= old('article') ;?>
                                </textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('article') ;?>    
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Divisi<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2 <?= ($validation->hasError('divisi')) ? 'is-invalid' : '' ;?>" 
                                  name="divisi" id="divisi" data-placeholder="Divisi" value="<?= old('divisi') ;?>">
                                    <option value="0" selected disabled> --- Divisi --- </option>
                                    <?php foreach($divisi as $d){ ?>
                                    <option value="<?= $d['id'] ;?>"
                                    <?php 
                                        //cek apakah value tag ada dalam array old tag
                                        if(old('divisi') == $d['id']){
                                            echo 'selected';
                                        }
                                    ?> >

                                    <?= $d['alias'] ;?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('divisi') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Publish</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="publish_date" class="form-control datepicker" value="<?= old('publish_date') ;?>">                              
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/berita/write_article">Terbit</button>
                                <button class="btn btn-warning" formtarget="_blank" rel="noopener noreferrer" formaction="/admin/berita/preview_article">Preview</button>
                                <a class="btn btn-info" href="/admin/Berita">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('addon-script')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        title = document.querySelector('#title').value;
        date = document.querySelector('.datepicker').value;
        
        //CKEditor
            let editor = CKEDITOR.replace('ckeditor', {
            height: 300,
            filebrowserUploadUrl: '".base_url()."/Admin/Berita/uploadArticleImage?judul=' + title + '&date=' + date,
            filebrowserUploadMethod: 'form',
        });

        editor.config.extraPlugins = 'autogrow';
        editor.config.editorplaceholder = 'Ketik artikel disini..';
        editor.config.allowedContent = true;
        editor.config.autoGrow_minHeight = 300;
        editor.config.autoGrow_maxHeight = 800;
    </script>
@endpush