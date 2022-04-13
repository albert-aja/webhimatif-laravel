@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('post-data') }}" class="btn btn-icon">
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
                <form method="post" enctype="multipart/form-data" id="form_add_post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.date')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="date" name="created_at" id="publish_date" class="form-control" value="{{ date('Y-m-d') }}">
                                <div class="invalid-feedback" id="created_at-feedback"></div>               
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.title')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="title" id="title" class="form-control" placeholder="@lang('admin/crud.variable.title')" autofocus>
                                <div class="invalid-feedback" id="title-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.photo')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7" id="img-div">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="hero_image" id="image-upload" class="form-control">
                                </div>
                                <div class="invalid-feedback" id="hero_image-feedback"></div>
                                <p class="rules">
                                    * @lang('admin/crud.form.format', ['format' => ' .jpg, .jpeg, .png']) | @lang('admin/crud.form.max_size', ['size' => ' 4mb'])<br>
                                    <a class="rules" target="_blank" rel="noopener noreferrer" href="https://compresspng.com/">Image Compress</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.article')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <textarea name="article" id="ckeditor" class="form-control"></textarea>
                                <div class="invalid-feedback" id="article-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.division')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2" name="division_id" id="division">
                                    <option value="0" selected disabled> --- @lang('admin/crud.variable.division') --- </option>
                                    @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">
                                        {{ $division->division }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="division-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button">@lang('admin/crud.btn.add')</button>
                                <button class="btn btn-warning" formtarget="_blank" rel="noopener noreferrer" formaction="/admin/berita/preview_article">@lang('admin/crud.btn.preview')</button>
                                <a class="btn btn-info" href="{{ route('post-data') }}">@lang('admin/crud.btn.back')</a>
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
    let editor = CKEDITOR.replace('ckeditor', {
        height: 300,
        filebrowserUploadUrl: '/Admin/ArticlePhoto/upload?_token=' + $('meta[name=csrf-token]').attr("content"),
        filebrowserUploadMethod: 'form',
    });

    editor.config.extraPlugins = 'autogrow';
    editor.config.editorplaceholder = 'Ketik artikel disini..';
    editor.config.allowedContent = true;
    editor.config.autoGrow_minHeight = 300;
    editor.config.autoGrow_maxHeight = 800;

    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        no_label: false, // Default: false
    });

	$(document).on('submit', '#form_add_post', function(e) {
		let data = new FormData(this);

		$.ajax({
			method: "POST",
			url: '/Admin/Post/store',
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
				validation(feedback.created_at, '#created_at', '#created_at-feedback');
				validation(feedback.title, '#title', '#title-feedback');
				validation(feedback.hero_image, '#image-preview', '#hero_image-feedback');
				validation(feedback.article, '#ckeditor', '#article-feedback');
				validation(feedback.division, '#division', '#division-feedback');
			} else {
				Swal.fire({
					title: '{{ __("admin/swal.success") }}',
					text: 'Artikel telah ditambahkan',
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