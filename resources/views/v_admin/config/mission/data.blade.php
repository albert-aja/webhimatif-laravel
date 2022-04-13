@extends('_layout.admin._template')

@section('content')

<x-datatable-page :title="$title" :breadcrumb="$breadcrumb" :page="$page" tableID="tableMissions" route="">
	<th>@lang('admin/crud.variable.mission')</th>
</x-datatable-page>

@endsection

@push('addon-script')
<script>
    let mission_table = $('#tableMissions').DataTable({
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
			{data: 'mission', name: 'mission'},
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
			url: '/Admin/Config/Mission/create', 
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_mission',data);
		})
	})
	
	$(document).on('submit', '#form_add_mission', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Config/Mission/store',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.mission, '#mission', '#mission-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_add_mission').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'{{ __("admin/crud.variable.mission") }} ' + capitalize(param.mission) + ' {{ __("admin/swal.successItem") }}',
					'success',
				);
				reload_table(mission_table);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editMission", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Config/Mission/edit',
			data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_mission', data);
		})
	})
	
	$(document).on('submit', '#form_edit_mission', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Config/Mission/update',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.mission, '#mission', '#mission-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_edit_mission').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'{{ __("admin/swal.successEdit", ["page" => $title]) }}',
					'success',
				);
				reload_table(mission_table);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deleteMission", function() {
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
					url: '/Admin/Config/Mission/destroy',
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
						reload_table(mission_table);
					}
				});
			}
		});
	});
</script>
@endpush