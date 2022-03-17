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
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Misi</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea oninput="auto_grow(this)" class="single-textarea <?= ($validation->hasError('misi')) ? 'is-invalid' : '' ;?>" name="misi" autofocus><?= old('misi') ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('misi') ;?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7 float-end">
                            <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/config/add_misi">Add</button>
                            <a class="btn btn-info" href="/admin/config/misi">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection