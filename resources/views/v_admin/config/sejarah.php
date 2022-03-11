<?= $this->extend('_layout/admin/_template') ?>

<?= $this->section('content') ?>

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
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sejarah</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea oninput="auto_grow(this)" class="form-control single-textarea <?= ($validation->hasError('sejarah')) ? 'is-invalid' : '' ;?>" name="sejarah" autofocus><?= (old('sejarah')) ? old('sejarah') : $sejarah['isi'] ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('sejarah') ;?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/config/edit_sejarah?id=<?= $sejarah['id'] ;?>">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ;?>