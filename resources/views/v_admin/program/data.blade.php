@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
		<div class="section-header-back">
            <a href="{{ route('division-data') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>{{ $title }}</h1>
        {!! $breadcrumb !!}
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>@lang('admin/crud.table.header', $page)</h4>
                    <div class="card-header-action">
						<button type="button" class="form-control btn btn-icon icon-left btn-primary" id="modal_add">
							<i class="fas fa-plus"></i>
                            @lang('admin/crud.add', $page)
						</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tablePrograms">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('admin/crud.table.index')</th>
                                <th>@lang('admin/crud.variable.program')</th>
                                <th>@lang('admin/crud.variable.description')</th>
                                <th>@lang('admin/crud.table.action')</th>
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

<div id="modal-div"></div>

@endsection

@push('addon-script')
<script>
    let program_table = $('#tablePrograms').DataTable({
		processing: true,
		serverSide: true,
		ordering: true,
		pageLength: 10,
		autoWidth: false,
		responsive: true,
		stateSave: true,
		ajax: {
			url: '{!! url()->current() !!}',
		},
		lengthMenu: [
			[5, 10, 25, 50, 100, -1],
			[5, 10, 25, 50, 100, "All"]
		],
		columns: [
			{
				data: 'DT_RowIndex', name: 'DT_RowIndex',
				sClass: 'text-center',
				orderable: false, searchable: false
			},
			{data: 'program', name: 'program'},
			{data: 'description', name: 'description'},
			{
				data: 'action', name: 'action',
				sClass: 'text-center',
				orderable: false, searchable: false,
			},
		]
	});

	$(document).on("click", "#modal_add", function() {
		$.ajax({
			method: "GET",
			url: '/Admin/Program/{{ $slug }}/create',
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_program', data);
		})
	})

	$(document).on('submit', '#form_add_program', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Program/{{ $slug }}/store',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.program, '#program', '#program-feedback');
				validation(feedback.description, '#description', '#description-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_add_program').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Progja ' + capitalize(param.program) + ' telah ditambahkan',
					'success',
				);
				reload_table(program_table);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editProgram", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Program/{{ $slug }}/edit/',
            data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_program', data);
		})
	})
	
	$(document).on('submit', '#form_edit_program', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Program/{{ $slug }}/update',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.program, '#program', '#program-feedback');
				validation(feedback.description, '#description', '#description-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_edit_program').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Progja telah diperbarui',
					'success',
				);
				reload_table(program_table);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deleteProgram", function() {
		let id = $(this).attr("data-id");
		let program = $(this).attr("data-program");

		Swal.fire({
			title: 'Yakin ingin data pengurus ini?',
			html: 'Progja <strong>' + program + '</strong> akan hilang!',
			showCancelButton: true,
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					url: '/Admin/Program/{{ $slug }}/destroy',
					method: 'DELETE',
                    data: {id},
					error: function() {
						errorSwal()
					},
					success: function(data) {
						Swal.fire({
							html: 'Progja <strong>' + program + '</strong> berhasil dihapus!',
							icon: 'success',
						})
						reload_table(program_table);
					}
				});
			}
		});
	});
</script>
@endpush