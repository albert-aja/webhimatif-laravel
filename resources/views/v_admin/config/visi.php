@extends('_layout.admin._template')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4><?= $title; ?></h4>
            </div>
            <form method="post">
                <?= csrf_field() ;?>
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Visi</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea oninput="auto_grow(this)" class="form-control single-textarea <?= ($validation->hasError('visi')) ? 'is-invalid' : '' ;?>" name="visi" autofocus><?= (old('visi')) ? old('visi') : ($visi['isi'] ?? '') ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('visi') ;?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/config/edit_visi?id=<?= ($visi['id'] ?? '') ?>">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ;?>