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
                    <h4>Form Edit Berita</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <?= csrf_field() ;?>
                    <input type="hidden" name="id" value=<?= $post['id'] ;?>>
                    <input type="hidden" name="old_img" value=<?= $post['hero_img'] ;?>>
                    <input type="hidden" name="old_loc" value=<?= $folder ;?>>
                    <input type="hidden" class="datepicker" value=<?= $post['created_at'] ;?>>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="title" id="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : '' ;?>" placeholder="Title" autofocus
                                value="<?= (old('title')) ?? $post['title'] ?>" placeholder="Judul">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('title') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto Utama<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7" id="img-div">
                                <div id="image-preview" class="image-preview <?= ($validation->hasError('hero_img')) ? 'is-invalid' : '' ;?>"
                                style="background-image: url('<?= base_url() ;?>/assets/img/news/<?= $folder ;?>/2x_<?= $post['hero_img'] ;?>');
                                        background-size: cover; background-position: center center;">
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
                                <?= (old('article')) ?? $post['article'] ?>
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
                                        } elseif ($post['divisi'] == $d['id']) {
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
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/berita/update_article">Edit</button>
                                <button class="btn btn-warning" formtarget="_blank" formaction="/admin/berita/preview_article">Preview</button>
                                <a class="btn btn-info" href="/admin/Berita">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ;?>