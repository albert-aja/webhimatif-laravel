@extends('_layout.admin._template')

@section('content')

<x-datatable-page :title="$title" :breadcrumb="$breadcrumb" :page="$page" tableID="tableCategories" route="">
    <th>@lang('admin/crud.variable.category')</th>
    <th>@lang('admin/crud.variable.slug')</th>
    <th>@lang('admin/crud.variable.photo')</th>
</x-datatable-page>

@endsection

@push('addon-script')

<script>
    let color_table = $('#tableCategories').DataTable({
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
			{data: 'category', name: 'category'},
			{data: 'slug', name: 'slug'},
			{
                data: 'photo', name: 'photo',
				sClass: 'text-center',
				orderable: false, searchable: false
            },
			{
				data: 'action', name: 'action',
				sClass: 'text-center',
				orderable: false, searchable: false,
			},
		],
	});

	$(document).on("click", "#modal_add", function() {
		$.ajax({
			method: "GET",
			url: '/Admin/Product_Color/create',
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_color', data);
            colorChange();
		})
	})

	$(document).on('submit', '#form_add_color', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Product_Color/store',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.color, '#color', '#color-feedback');
				validation(feedback.hex_code, '#hex_code', '#hex_code-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_add_color').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Warna ' + capitalize(param.color) + ' {{ __("admin/swal.successItem") }}',
					'success',
				);
				reload_table(color_table, tooltip);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editColor", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Product_Color/edit',
            data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_color', data);
            colorBucket();
            colorChange();
		})
	})
	
	$(document).on('submit', '#form_edit_color', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Product_Color/update',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.color, '#color', '#color-feedback');
				validation(feedback.hex_code, '#hex_code', '#hex_code-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_edit_color').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Warna telah diperbarui',
					'success',
				);
				reload_table(color_table, tooltip);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deleteColor", function() {
		let id = $(this).attr("data-id");
		let color = $(this).attr("data-color");

		Swal.fire({
			title: 'Yakin ingin hapus warna produk?',
			html: 'Warna <strong>' + color + '</strong> akan hilang!',
			showCancelButton: true,
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					url: '/Admin/Product_Color/destroy',
					method: 'DELETE',
                    data: {id},
					error: function() {
						errorSwal()
					},
					success: function(data) {
						Swal.fire({
							html: 'Warna <strong>' + color + '</strong> berhasil dihapus!',
							icon: 'success',
						})
						reload_table(color_table, tooltip);
					}
				});
			}
		});
	});
</script>

@endpush