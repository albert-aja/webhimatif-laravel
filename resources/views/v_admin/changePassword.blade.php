<x-modal modalID="modal_change_password" modalSize="" :title="$title">
    <form id="form_change_password" method="POST">
    @csrf
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.new_pw')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="password" name="password" class="form-control" placeholder="@lang('admin/crud.variable.new_pw')" id="new">
                <div class="invalid-feedback" id="new-feedback"></div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.confirm_new_pw')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('admin/crud.variable.confirm_new_pw')" id="confirm">
                <div class="invalid-feedback" id="confirm-feedback"></div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" id="show_password">
                    <label class="custom-control-label">@lang('auth.login.showPassword')</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.edit')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>