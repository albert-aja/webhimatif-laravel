@extends('_layout.admin._template')

@section('content')

<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1><?= $title ;?></h1>
        <?= $breadcrumb ;?>
    </div>
    <h2 class="section-title">Fitur Ganti Password</h2>
    <p class="section-lead">Fitur untuk ganti password admin</p>
    <div class="card">
        <form method="post" autocomplete="off">
            <?= csrf_field() ;?>
            <div class="card-header">
                <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Lama</label>
                    <div class="input-group col-sm-12 col-md-7">
                        <input type="password" name="old_pass" id="old_pass" class="form-control <?= ($validation->hasError('old_pass') || session('msg_t')) ? 'is-invalid' : '' ;?>" 
                        placeholder="Password Lama" value="<?= old('old_pass') ;?>">
                        <button class="btn btn-outline" id="toggleOldPassword"><i class="far fa-eye" id="old-pass-eye"></i></button>
                        <div class="invalid-feedback">
                            <?= $validation->getError('old_pass') ?>
                            <?= session('msg_t') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Baru</label>
                    <div class="input-group col-sm-12 col-md-7">
                        <input type="password" name="new_pass" id="new_pass" class="form-control <?= ($validation->hasError('new_pass')) ? 'is-invalid' : '' ;?>" 
                        placeholder="Password Baru" value="<?= old('new_pass') ;?>">
                        <button class="btn btn-outline" id="togglePassword"><i class="far fa-eye" id="new-pass-eye"></i></button>
                        <div class="invalid-feedback">
                            <?= $validation->getError('new_pass') ;?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password Baru</label>
                    <div class="input-group col-sm-12 col-md-7">
                        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control <?= ($validation->hasError('confirm_pass')) ? 'is-invalid' : '' ;?>" 
                        placeholder="Konfirmasi Password Baru" value="<?= old('confirm_pass') ;?>">
                        <button class="btn btn-outline" id="toggleConfirmPassword"><i class="far fa-eye" id="com-pass-eye"></i></button>
                        <div class="invalid-feedback">
                            <?= $validation->getError('confirm_pass') ;?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col">
                        <button class="btn btn-primary float-end" type="submit" formaction="/admin/feature/insert_new_password">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

  </section>

@endsection

@push('addon-script')
    <script src="{{ asset('js/changepassword.js') }}"></script>
@endpush