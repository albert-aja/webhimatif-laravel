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
    let category_table = $('#tableCategories').DataTable({
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

	function imagePreview(){
		$.uploadPreview({
			input_field: "#image-upload", // Default: .image-upload
			label_field: "#image-label", // Default: .image-label
			no_label: false, // Default: false
		});
	}

	$(document).on("click", "#modal_add", function() {
		$.ajax({
			method: "GET",
			url: '/Admin/ProductCategory/create',
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_category', data);
            imagePreview();
		})
	})

	$(document).on('submit', '#form_add_category', function(e) {
		let data = new FormData(this);

		$.ajax({
			method: "POST",
			url: '/Admin/ProductCategory/store',
			data: data,
            processData: false,
            contentType: false,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.category, '#category', '#category-feedback');
				validation(feedback.photo, '#photo', '#photo-feedback');
			} else {
				$('#modal_add_category').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Kategori Produk ' + data.get('category') + ' {{ __("admin/swal.successItem") }}',
					'success',
				);
				reload_table(category_table);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editCategory", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/ProductCategory/edit',
            data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_category', data);
            imagePreview();
		})
	})

	$(document).on('submit', '#form_edit_category', function(e) {
		let data = new FormData(this);

		$.ajax({
			method: "POST",
			url: '/Admin/ProductCategory/update',
			data: data,
            processData: false,
            contentType: false,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.category, '#category', '#category-feedback');
				validation(feedback.photo, '#photo', '#photo-feedback');
			} else {
				$('#modal_edit_category').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Kategori Produk telah diperbarui',
					'success',
				);
				reload_table(category_table);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deleteCategory", function() {
		let id = $(this).attr("data-id");
		let category = $(this).attr("data-category");

		Swal.fire({
			title: 'Yakin ingin hapus warna produk?',
			html: 'Kategori <strong>' + category + '</strong> akan hilang!',
			showCancelButton: true,
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					url: '/Admin/ProductCategory/destroy',
					method: 'DELETE',
                    data: {id},
					error: function() {
						errorSwal()
					},
					success: function(data) {
						Swal.fire({
							html: 'Kategori <strong>' + category + '</strong> berhasil dihapus!',
							icon: 'success',
						})
						reload_table(category_table);
					}
				});
			}
		});
	});
</script>

@endpush