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
							<i class="fas fa-plus"></i> @lang('admin/crud.add', $page)
						</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableDivision">
							<thead>
								<tr class="text-center">
									<th>@lang('admin/crud.table.index')</th>
									<th>@lang('admin/crud.variable.division')</th>
									<th>@lang('admin/crud.variable.alias')</th>
									<th>@lang('admin/crud.variable.program')</th>
									<th>@lang('admin/crud.variable.commitee')</th>
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
    let division_table = $('#tableDivision').DataTable({
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
			{data: 'division', name: 'division'},
			{data: 'alias', name: 'alias'},
			{
                data: 'program', name: 'program',
                sClass: 'text-center',
				orderable: false, searchable: false,
            },
			{
                data: 'commitee', name: 'commitee', 
                sClass: 'text-center',
				orderable: false, searchable: false,
            },
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
			url: '/Admin/Division/create', 
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_division',data);
		})
	})

	$(document).on('submit', '#form_add_division', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Division/store',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.division, '#division', '#division-feedback');
				validation(feedback.alias, '#alias', '#alias-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_add_division').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'{{ __("admin/crud.variable.division") }} ' + capitalize(param.division) + ' {{ __("admin/swal.successItem") }}',
					'success',
				);
				reload_table(division_table);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editDivision", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Division/edit',
			data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_division', data);
		})
	})
	
	$(document).on('submit', '#form_edit_division', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Division/update',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.division, '#division', '#division-feedback');
				validation(feedback.alias, '#alias', '#alias-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_edit_division').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'{{ __("admin/swal.successEdit", ["page" => $title]) }}',
					'success',
				);
				reload_table(division_table);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deleteDivision", function() {
		let title = $(this).attr("data-title");
		let id = $(this).attr("data-id");

		Swal.fire({
			title: '{{ __("admin/swal.delWarning.title", $page) }} ' + title + '?',
			html: 'Data <strong>program kerja</strong> dan <strong>pengurus</strong> divisi akan hilang!',
			icon: 'warning',
			showCancelButton: true,
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					url: '/Admin/Division/destroy',
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
						reload_table(division_table);
					}
				});
			}
		});
	});
</script>

@endpush