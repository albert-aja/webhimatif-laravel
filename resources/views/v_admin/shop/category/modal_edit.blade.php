<x-modal modalID="modal_edit_category" modalSize="" :title="__('admin/crud.form.edit', $page)">
    <form method="post" id="form_edit_category" enctype="multipart/form-data">
    @method('put')
    @csrf
        <input type="hidden" name="id" value="{{ $category->id }}">
        <input type="hidden" name="old_img" value="{{ $category->photo }}">
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.category')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="text" name="category" class="form-control" placeholder="@lang('admin/crud.variable.category')" id="category" value="{{ $category->category }}">
                <div class="invalid-feedback" id="category-feedback"></div>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2">
                    @lang('admin/crud.variable.photo')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <div id="img-div">
                    <div id="photo" class="image-preview" style="background-image: url('{{ asset("img/web/shop/" .$category->photo) }}'); background-size: cover; background-position: center center;">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="photo" id="image-upload" class="form-control">
                    </div>
                    <div class="invalid-feedback" id="photo-feedback"></div>
                    <p class="rules">
                        * @lang('admin/crud.form.format', ['format' => ' .jpg, .jpeg, .png']) | @lang('admin/crud.form.max_size', ['size' => ' 4mb'])<br>
                        <a class="rules" target="_blank" rel="noopener noreferrer" href="https://compresspng.com/">Image Compress</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.edit')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>