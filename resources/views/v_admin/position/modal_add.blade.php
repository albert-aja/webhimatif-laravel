<div class="modal fade" id="modal_add_position">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('admin/crud.form.add', $page)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            </div>
        </div>
    </div>
</div>
