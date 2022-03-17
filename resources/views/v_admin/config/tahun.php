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
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Periode Kepengurusan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="tahun" id="tahun" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : '' ;?>" 
                            placeholder="Periode Kepengurusan" value="<?= (old('tahun')) ? old('tahun') : $tahun_kepengurusan['tahun'] ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('tahun') ;?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary clicked-button" type="submit" formaction="/admin/config/edit_periode?id=<?= $tahun_kepengurusan['id'] ;?>">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection