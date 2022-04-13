<x-modal modalID="modal_add_service" modalSize="" :title="__('admin/crud.form.add', $page)">
    <form id="form_add_service" method="POST">
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.service')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="text" name="service" class="form-control" placeholder="@lang('admin/crud.variable.service')" id="service">
                <div class="invalid-feedback" id="service-feedback"></div>
            </div>
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
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.add')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>
