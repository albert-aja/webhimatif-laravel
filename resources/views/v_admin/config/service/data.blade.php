@extends('_layout.admin._template')

@section('content')

<x-datatable-page :title="$title" :breadcrumb="$breadcrumb" :page="$page" tableID="tableServices" route="">
	<th>@lang('admin/crud.variable.service')</th>
	<th>@lang('admin/crud.variable.link')</th>
</x-datatable-page>

@endsection

@push('addon-script')
<script>
    let service_table = $('#tableServices').DataTable({
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
			{data: 'service', name: 'service'},
			{data: 'link', name: 'link'},
			{
				data: 'action', name: 'action',
				sClass: 'text-center',
				orderable: false, searchable: false,
			},
		]
	});

	function link_btn(){
		if ($(".linkMediaSosial").length > 0) {
            try_link();

            $(".linkMediaSosial").keyup(function () {
                try_link();
            });
		}
	}

    $(document).on("click", "#modal_add", function() {
		$.ajax({
			method: "GET",
			url: '/Admin/Config/Service/create', 
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_service',data);
			link_btn();
		})
	})
	
	$(document).on('submit', '#form_add_service', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Config/Service/store',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.service, '#service', '#service-feedback');
				validation(feedback.link, '#link', '#link-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_add_service').modal('hide');
				Swal.fire({
                        title: '{{ __("admin/swal.success") }}',
                        text: '{{ __("admin/crud.variable.service") }} ' + capitalize(param.service) + ' {{ __("admin/swal.successItem") }}',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer || result.isConfirmed) {
                            location.reload();
                        }
                    })
				reload_table(service_table);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editService", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Config/Service/edit',
			data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_service', data);
			link_btn();
		})
	})
	
	$(document).on('submit', '#form_edit_service', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "PUT",
			url: '/Admin/Config/Service/update',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.service, '#service', '#service-feedback');
				validation(feedback.link, '#link', '#link-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_edit_service').modal('hide');
				Swal.fire({
					title: '{{ __("admin/swal.success") }}',
					text: '{{ __("admin/swal.successEdit", ["page" => $title]) }}',
					icon: 'success',
					timer: 2000,
					timerProgressBar: true,
				})
				reload_table(service_table);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deleteService", function() {
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
					url: '/Admin/Config/Service/destroy',
					method: 'DELETE',
					data: {id},
					error: function() {
						errorSwal()
					},
					success: function(data) {
						Swal.fire({
							title: "{{ __('admin/swal.successDel', $page) }}",
							icon: 'success',
							timer: 2000,
							timerProgressBar: true,
						})
						reload_table(service_table);
					}
				});
			}
		});
	});
</script>
@endpush