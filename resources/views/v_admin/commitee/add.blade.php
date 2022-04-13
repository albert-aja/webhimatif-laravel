@extends('_layout.admin._template')

@section('content')

@include('v_admin.commitee.cropper')

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('commitee-data', $slug) }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>{{ $title }}</h1>
        {!! $breadcrumb !!}
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>@lang('admin/crud.form.add', $page)</h4>
                </div>
                <form method="post" enctype="multipart/form-data" id="form_add_commitee">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('admin/crud.variable.name')<sup class="text-danger">@lang('admin/crud.form.required')</sup></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="name" id="name" class="form-control" 
                                placeholder="@lang('admin/crud.variable.name')" autofocus>
                                <div class="invalid-feedback" id="name-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('admin/crud.variable.photo')<sup class="text-danger">@lang('admin/crud.form.required')</sup></label>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="d-flex align-items-center justify-content-center my-4" id="card">
                                    <div class="card-box">
                                        <div class="container-inner">
                                            <div class="circle"></div>
                                            <img src="{{ asset('img/web/preview.png') }}" class="img-preview" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <input type="file" name="photo" id="hero_img" class="form-control">
                                <input type="hidden" name="cropped" class="crop_img">
                                <div class="invalid-feedback" id="photo-feedback"></div>
                                <p class="rules"> 
                                    * @lang('admin/crud.form.format', ['format' => ' .jpg, .jpeg, .png']) | @lang('admin/crud.form.max_size', ['size' => ' 5mb'])<br>
                                    <a class="rules" target="_blank" rel="noopener noreferrer" href="https://compresspng.com/">Image Compress</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('admin/crud.variable.position')<sup class="text-danger">@lang('admin/crud.form.required')</sup></label>
                            <div class="form-group col-sm-12 col-md-7">
                                <div class="input-group">
                                    <select class="form-control select2" name="position_id" id="position_id">
                                        <option value="" disabled selected>--- @lang('admin/crud.variable.position') ---</option>
                                        @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->position }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" id="modal_add">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="position_id-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary" type="submit" formaction="{{ route('commitee-store', $slug) }}">@lang('admin/crud.btn.add')</button>
                                <a class="btn btn-info" href="{{ route('commitee-data', $slug) }}">@lang('admin/crud.btn.back')</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div id="modal-div"></div>

@endsection

@push('addon-script')
@include('v_admin.commitee._ajax')
<script>
	$(document).on('submit', '#form_add_commitee', function(e) {
		let data = new FormData(this);

		$.ajax({
			method: "POST",
			url: '/Admin/Commitee/{{ $slug }}/store',
			data: data,
            processData: false,
            contentType: false,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.name, '#name', '#name-feedback');
				validation(feedback.photo, '#hero_img', '#photo-feedback');
				validation(feedback.position_id, '#position_id', '#position_id-feedback');
			} else {
				Swal.fire({
					title: '{{ __("admin/swal.success") }}',
					text: 'Data ' + data.get('name') + ' {{ __("admin/swal.successItem") }}',
					icon: 'success',
                    timer: 2000,
                    timerProgressBar: true,
				}).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer || result.isConfirmed) {
                        window.location.href = feedback.redirect;
                    }
                })
			}
		})
		e.preventDefault();
	})
</script>
@endpush