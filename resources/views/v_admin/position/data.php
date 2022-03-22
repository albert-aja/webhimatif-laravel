@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
        <?= $breadcrumb ;?>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Tabel <?= $title; ?></h4>
                    <div class="card-header-action">
                        <a href="/admin/Jabatan/view_add_jabatan" class="form-control btn btn-icon icon-left btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambah <?= $title; ?>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableJabatan">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('addon-script')
<script>
    $(document).on("click", "#modal_add", function() {
		$.ajax({
			method: "GET",
			url: '/Admin/Position/create', 
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_position',data);
		})
	})
	
	$(document).on('submit', '#form_add_position', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Position/store',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.position, '#position', '#position-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_add_position').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Jabatan ' + capitalize(param.position) + ' telah ditambahkan',
					'success',
				);
				$.ajax({
                    method: "GET",
                    url: '/Admin/Position/fetch_new',
                    data: data,
                    success: function(data) {
                        $('.select2').append(data);
                        $('.select2').select2();
                    },
                })
			}
		})
		e.preventDefault();
	})
</script>
@endpush