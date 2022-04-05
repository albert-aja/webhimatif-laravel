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
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.date')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="date" name="publish_date" id="publish_date" class="form-control" value="{{ (old('publish_date')) ?? date('Y-m-d') }}">
                                <div class="invalid-feedback">
                                    {!! $errors->first('publish_date') !!}
                                </div>               
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.title')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                placeholder="@lang('admin/crud.variable.title')" value="{{ old('title') }}" autofocus>
                                <div class="invalid-feedback">
                                    {!! $errors->first('title') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.photo')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7" id="img-div">
                                <div id="image-preview" class="image-preview @error('hero_image') is-invalid @enderror">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="hero_image" id="image-upload" class="form-control">
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('hero_image') }}
                                </div>
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
                                <textarea name="article" id="ckeditor" class="form-control @error('article') is-invalid @enderror">
                                    {{ old('article') }}
                                </textarea>
                                <div class="invalid-feedback">
                                    {!! $errors->first('article') !!}   
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                @lang('admin/crud.variable.division')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2 @error('division') is-invalid @enderror" name="division" id="division"  value="{{ old('division') }}">
                                    <option value="0" selected disabled> --- @lang('admin/crud.variable.division') --- </option>
                                    @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" @if(old('division') == $division->id) selected @endif>
                                        {{ $division->division }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {!! $errors->first('division') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7 float-end">
                                <button class="btn btn-primary clicked-button" type="submit" formaction="{{ route('post-store') }}">@lang('admin/crud.btn.add')</button>
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
        title = document.querySelector('#title').value;
        date = document.querySelector('#publish_date').value;
        
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

    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        no_label: false, // Default: false
    });
</script>
@endpush