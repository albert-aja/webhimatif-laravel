<x-modal modalID="modal_detail_table" modalSize="modal-dialog-scrollable modal-xl" :title="$title">
  <div class="box-body">
    <div class="table-div">
      <table class="table modal_table">
        <thead>
  
          @foreach($field as $f)
            <th class="text-capitalize">{{ str_replace('_', ' ', $f) }}</th>
          @endforeach
        
        </thead>
        <tbody class="align-middle">
        
          @for($i=0;$i<count($data);$i++)
          <tr>
            @foreach($data[$i] as $dt)
              <td>{{ $dt ?? '-' }}</td>
            @endforeach
          </tr>
          @endfor
        
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin/crud.btn.back')</button>
    </div>
  </div>
</x-modal>