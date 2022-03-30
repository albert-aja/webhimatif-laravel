<x-modal modalID="modal_rearrange_photo" modalSize="modal-lg" :title="__('admin/crud.form.reorder')">
    <div id="arrange" class="border border-1 rounded border-secondary p-3">
        @foreach($item->product_gallery as $photo)
            <div id="{{ $photo->id }}" class="listitemClass">
                <img src="{{ asset($img_path. '/' .$photo->photo. '/2x_' .$photo->photo) }}" alt="Item Image">
            </div>
        @endforeach
    </div>
    <div class="modal-footer mt-3">
        <form method="post" id="form_update_order">
        @csrf
            <input type="hidden" value="{{ $item->id }}" name="id"/>
            <input type="hidden" id="outputvalues" name="photo"/>
            <button type="submit" class="btn btn-primary click-button" id="btn-updateOrder" disabled>Save changes</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.close')</button>
        </form>
    </div>
</x-modal>