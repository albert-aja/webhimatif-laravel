<x-modal modalID="modal" modalSize="modal-lg" :title="__('admin/crud.cropTitle')">
    <div class="img-container">
        <div class="row">
            <div class="col-md-8">
                <img src="" id="sample_image" />
            </div>
            <div class="col-md-4">
                <div class="preview"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="crop" class="btn btn-primary">@lang('admin/crud.btn.crop')</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin/crud.btn.close')</button>
    </div>
</x-modal>