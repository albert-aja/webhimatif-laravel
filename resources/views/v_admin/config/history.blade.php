@extends('_layout.admin._template')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>{{ $title; }}</h4>
            </div>
            <form method="post" id="form_edit_history">
            @method('PUT')
            @csrf
                <input type="hidden" name="id" value="{{ $history->id }}">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('admin/crud.variable.history')</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea oninput="auto_grow(this)" class="form-control single-textarea" name="history" id="history" placeholder="@lang('admin/crud.variable.history')" autofocus>{{ $history->history }}</textarea>
                            <div class="invalid-feedback" id="history-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">@lang('admin/crud.btn.edit')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('addon-script')
    <script>
        $(document).on('submit', '#form_edit_history', function(e) {
            let data = $(this).serialize();

            $.ajax({
                method: "PUT",
                url: '/Admin/Config/History/update',
                data: data,
                beforeSend: function(){
                    show_loader();
                },
            }).done(function(res) {
			    let feedback = jQuery.parseJSON(res);
                hide_loader();

                if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
                    validation(feedback.history, '#history', '#history-feedback');
                } else {
                    Swal.fire({
                        title: '{{ __("admin/swal.success") }}',
                        text: 'Sejarah telah diupdate',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer || result.isConfirmed) {
                            location.reload();
                        }
                    })
                }
            })
            e.preventDefault();
        })
    </script>
@endpush