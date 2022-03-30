<x-modal modalID="modal_add_program" modalSize="" :title="__('admin/crud.form.add', $page)">
    <form id="form_add_program" method="POST">
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.program')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="text" name="program" class="form-control" placeholder="@lang('admin/crud.variable.program')" id="program">
                <div class="invalid-feedback" id="program-feedback"></div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.description')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <textarea class="form-control single-textarea" id="description" name="description" placeholder="@lang('admin/crud.variable.description')"></textarea>
                <div class="invalid-feedback" id="description-feedback"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.add')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>