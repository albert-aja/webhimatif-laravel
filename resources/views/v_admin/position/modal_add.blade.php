<x-modal modalID="modal_add_position" modalSize="" :title="__('admin/crud.form.add', $page)">
    <form id="form_add_position" method="POST">
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.position')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="text" name="position" class="form-control" placeholder="@lang('admin/crud.variable.position')" id="position">
                <div class="invalid-feedback" id="position-feedback"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.add')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>
