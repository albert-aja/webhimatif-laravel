<x-modal modalID="modal_add_contact" modalSize="" :title="__('admin/crud.form.add', $page)">
    <form method="post" id="form_add_contact">
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.social_media')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="text" name="social" class="form-control" placeholder="@lang('admin/crud.variable.social_media')" id="social_media">
                <div class="invalid-feedback" id="social_media-feedback"></div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.link')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <div class="row">
                    <div class="col-9">
                        <input type="text" name="link" class="form-control linkMediaSosial" placeholder="@lang('admin/crud.variable.link')" id="link">
                        <div class="invalid-feedback" id="link-feedback"></div>
                    </div>
                    <div class="col-3">
                        <a href="#" class="btn btn-secondary" id="linkTo" target="_blank" rel="noopener noreferrer" style="pointer-events: none">@lang('admin/crud.btn.try_link')</a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.icon')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <div class="selectgroup selectgroup-pills" id="selecticons">
                    <div>

                        @foreach($icon_arr as $icon)
                        <label class="selectgroup-item">
                            <input type="radio" name="icon" value="{{ $icon['icon'] }}" class="selectgroup-input form-control"/>
                            <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ucwords($icon['name']) }}">
                                <i class="{{ $icon['icon'] }}"></i>
                            </span>
                        </label>
                        @endforeach
                        @foreach($existed as $exist)
                        <label class="selectgroup-item">
                            <input type="radio" class="selectgroup-input existed" disabled />
                            <span class="selectgroup-button selectgroup-button-icon" 
                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ucwords($exist->name) }}">
                                <i class="{{ $exist->icon }}"></i>
                            </span>
                        </label>
                        @endforeach

                    </div>
                    <div id="icon"></div>
                    <div class="invalid-feedback" id="icon-feedback"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.hex')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <div class="input-group colorpickerinput">
                    <input type="text" name="color" class="form-control" placeholder="@lang('admin/crud.variable.hex')" id="hex_code" maxlength="7">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-fill-drip"></i>
                        </div>
                    </div>
                    <div class="invalid-feedback" id="hex_code-feedback"></div>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="mb-2">
                    Preview
                </label>
                <div class="social-links">
                    <a class="social-media" id="preview-btn" target="_blank" rel="noopener noreferrer">
                        <i id="preview-icon" class="ri-question-fill ri-lg"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.add')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>