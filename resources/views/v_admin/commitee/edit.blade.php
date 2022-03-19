@extends('_layout.admin._template')

@section('content')

@include('v_admin.pengurus.cropper')

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/Admin/divisi/pengurus?divisi=<?= $divisi['slug']; ?>" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Edit Data <?= $pengurus['nama'] ;?></h1>
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
                    <input type="hidden" name="old_img" value=<?= $pengurus['foto'] ;?> >
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pengurus<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="nama" id="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ;?>" 
                                placeholder="Nama Pengurus" autofocus 
                                value="<?= (old('nama')) ?? $pengurus['nama'];?>" >
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto Pengurus<span class="required">*</span></label>
                            <div class="col-sm-2 col-md-2">
                                <img src="<?= base_url() ;?>/assets/img/divisi/<?= $divisi['slug']; ?>/<?= $pengurus['foto'] ;?>/2x_<?= $pengurus['foto'] ;?>" class="img-preview">
                            </div>
                            <div class="col-sm-10 col-md-5">
                                <input type="file" name="foto" id="hero_img" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ;?>">
                                <input type="hidden" name="preview" class="hidden_prev">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto') ;?>
                                </div>
                                <p class="rules"> 
                                    * Format: .jpg, .jpeg, .png | Max size: 5mb <br>
                                    Note: Tidak perlu upload gambar lagi apabila tidak ada perubahan. <br>
                                    <a class="rules" target="_blank" rel="noopener noreferrer" href="https://compresspng.com/">Image Compress</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jabatan<span class="required">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2 <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ;?>" 
                                name="jabatan" id="jabatan" 
                                value="<?= old('jabatan') ;?>">
                                    <option value="" disabled selected>Jabatan</option>
                                    <?php foreach($jabatan as $t){ ?>
                                        <option value="<?= $t['id'] ;?>"
                                            <?php  
                                                if($t['id'] == $pengurus['jabatan']){
                                                    echo 'selected';
                                                }
                                            ?>
                                        >
                                        <?= $t['jabatan'] ;?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jabatan') ;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/pengurus/edit_pengurus?divisi=<?= $divisi['slug']; ?>&id=<?= $pengurus['id']; ?>">Edit</button>
                                <a class="btn btn-info" href="/Admin/divisi/pengurus?divisi=<?= $divisi['slug']; ?>">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection