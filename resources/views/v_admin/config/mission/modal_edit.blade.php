<x-modal modalID="modal_edit_mission" modalSize="" :title="__('admin/crud.form.edit', $page)">
    <form id="form_edit_mission" method="POST">
    @method('put')
    @csrf
        <input type="hidden" name="id" value="{{ $mission->id }}">
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.mission')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="text" name="mission" class="form-control" placeholder="@lang('admin/crud.variable.mission')" id="mission" value="{{ $mission->mission }}" autofocus>
                <div class="invalid-feedback" id="mission-feedback"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.edit')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>