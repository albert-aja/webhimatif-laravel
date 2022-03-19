<div class="modal fade" id="modal_edit_division">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('admin/crud.form.edit', $page)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="form_edit_division" method="POST">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $division->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="mb-2">
                                @lang('admin/crud.variable.division')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <input type="text" name="division" class="form-control" placeholder="@lang('admin/crud.variable.division')" id="division" value="{{ $division->division }}" autofocus>
                            <div class="invalid-feedback" id="division-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-2">
                                @lang('admin/crud.variable.alias')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                            </label>
                            <input type="text" name="alias" class="form-control" placeholder="@lang('admin/crud.variable.alias')" id="alias" value="{{ $division->alias }}">
                            <div class="invalid-feedback" id="alias-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.edit')</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
