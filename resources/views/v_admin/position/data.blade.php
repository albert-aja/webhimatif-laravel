@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
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
                        <table class="table table-striped table-hover" id="tablePosition">
                            <thead>
                                <tr class="text-center">
                                    <th>@lang('admin/crud.table.index')</th>
                                    <th>@lang('admin/crud.variable.position')</th>
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
    let position_table = $('#tablePosition').DataTable({
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
			{data: 'position', name: 'position'},
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
				reload_table(position_table);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editPosition", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Position/edit',
			data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_position', data);
		})
	})
	
	$(document).on('submit', '#form_edit_position', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Position/update',
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

				$('#modal_edit_position').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'{{ __("admin/swal.successEdit", ["page" => $title]) }}',
					'success',
				);
				reload_table(position_table);
			}
		})
		e.preventDefault();
	})

    
    $(document).on("click", ".deletePosition", function() {
		let title = $(this).attr("data-title");
		let id = $(this).attr("data-id");

		Swal.fire({
			title: '{{ __("admin/swal.delWarning.title", $page) }} ' + title + '?',
			text: '{{ __("admin/swal.delWarning.text", ["page" => $title]) }}',
			icon: 'warning',
			showCancelButton: true,
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					url: '/Admin/Position/destroy',
					method: 'DELETE',
					data: {id},
					error: function() {
						errorSwal()
					},
					success: function(data) {
						Swal.fire({
							title: "{{ __('admin/swal.successDel', $page) }}",
							icon: 'success',
						})
						reload_table(position_table);
					}
				});
			}
		});
	});
</script>
@endpush