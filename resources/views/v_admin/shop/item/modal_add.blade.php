<x-modal modalID="modal_add_item" modalSize="modal-lg" :title="__('admin/crud.form.add', $page)">
    <form id="form_add_item" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.item')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <input type="text" name="item" class="form-control" placeholder="@lang('admin/crud.variable.item')" id="item">
                <div class="invalid-feedback" id="item-feedback"></div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.photo')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <div id="photo">
                    <div class="input-images"></div>
                </div>
                <div class="invalid-feedback" id="photo-feedback"></div>
                <p class="rules"> 
                    * @lang('admin/crud.form.format', ['format' => ' .jpg, .jpeg, .png']) | @lang('admin/crud.form.max_size', ['size' => ' 5mb']) | Max uploaded photo : 10<br>
                </p>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.description')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <textarea name="description" id="ckeditor" class="form-control"></textarea>
                <div class="invalid-feedback" id="description-feedback"></div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.category')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <select class="form-control select2" name="product__categories_id" id="category">
                    <option value="" disabled selected>--- @lang('admin/crud.variable.category') ---</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback" id="category-feedback"></div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.color') <small class="text-muted">@lang('admin/crud.form.optional')</small>
                </label>
                <div class="row gutters-xs mb-2">
                @foreach ($colors as $color)
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color[]" type="checkbox" value="{{ $color->id }}" class="colorinput-input"/>
                            <span class="colorinput-color" style="background-color: {{ $color->hex_code }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ucwords($color->color) }}"></span>
                        </label>
                    </div>
                @endforeach
                </div>
                <input type="checkbox" class="mb-2" id="checkAll"/> @lang('admin/crud.form.checkAll')
                <div class="invalid-feedback" id="color-feedback"></div>
            </div>
            <div class="form-group">
                <label class="mb-2">
                    @lang('admin/crud.variable.price')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                </label>
                <div class="row">
                    <div class="col-6">
                        <label class="mb-2">
                            @lang('admin/crud.form.fromPrice')<sup class="text-danger">@lang('admin/crud.form.required')</sup>
                        </label>
                        <input type="text" name="fromPrice" class="form-control" placeholder="@lang('admin/crud.form.fromPrice')" id="fromPrice">
                        <div class="invalid-feedback" id="fromPrice-feedback"></div>
                    </div>
                    <div class="col-6">
                        <label class="mb-2">
                            @lang('admin/crud.form.toPrice') <small class="text-muted">@lang('admin/crud.form.optional')</small>
                        </label>
                        <input type="text" name="toPrice" class="form-control" placeholder="@lang('admin/crud.form.toPrice')" id="toPrice">
                        <div class="invalid-feedback" id="toPrice-feedback"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('admin/crud.btn.add')</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </div>
    </form>
</x-modal>
