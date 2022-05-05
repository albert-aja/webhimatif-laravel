@extends('_layout.admin._template')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>{{ $title }}</h4>
            </div>
            <form method="post" id="form_edit_year">
            @method('PUT')
            @csrf
                <input type="hidden" name="id" value="{{ $periode->id }}">
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('admin/crud.variable.year')</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Himatif</span>
                                </div>
                                <input type="text" name="year" id="year" class="form-control datemask" placeholder="@lang('admin/crud.variable.year')" value="{{ substr($periode->year, -9) }}" autofocus>
                                <div class="invalid-feedback" id="year-feedback"></div>
                            </div>
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
        $(document).on('submit', '#form_edit_year', function(e) {
            let data = $(this).serialize();

            $.ajax({
                method: "PUT",
                url: '/Admin/Config/ManagementYear/update',
                data: data,
                beforeSend: function(){
                    show_loader();
                },
            }).done(function(res) {
			    let feedback = jQuery.parseJSON(res);
                hide_loader();

                if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
                    validation(feedback.year, '#year', '#year-feedback');
                } else {
                    Swal.fire({
                        title: '{{ __("admin/swal.success") }}',
                        text: 'Tahun kepengurusan telah diupdate',
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