<x-modal modalID="modal_edit_color" modalSize="" :title="__('admin/crud.form.edit', $page)">
    <form method="post" id="form_edit_color">
    @method('put')
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.color')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="text" name="color" class="form-control" placeholder="@lang('admin/crud.variable.color')" id="color" value="{{ $color->color }}">
                <div class="invalid-feedback" id="color-feedback"></div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.hex')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <div class="input-group colorpickerinput">
                    <input type="text" name="hex_code" class="form-control" placeholder="@lang('admin/crud.variable.hex')" id="hex_code" maxlength="7" value="{{ $color->hex_code }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-fill-drip"></i>
                        </div>
                    </div>
                    <div class="invalid-feedback" id="hex_code-feedback"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.edit')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>