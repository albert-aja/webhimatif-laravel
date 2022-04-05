@extends('_layout.admin._template')

@section('content')

<x-datatable-page :title="$title" :breadcrumb="$breadcrumb" :page="$page" tableID="tableItems" route="">
	<th>@lang('admin/crud.variable.item')</th>
	<th>@lang('admin/crud.variable.photo')</th>
	<th>@lang('admin/crud.variable.description')</th>
	<th>@lang('admin/crud.variable.category')</th>
	<th>@lang('admin/crud.variable.color')</th>
	<th>@lang('admin/crud.variable.price')</th>
</x-datatable-page>

@endsection

@push('addon-script')

<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    let item_table = $('#tableItems').DataTable({
		processing: true,
		serverSide: true,
		ordering: true,
		pageLength: 5,
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
			{data: 'item', name: 'item'},
			{
                data: 'photo', name: 'photo',
				sClass: 'text-center',
				orderable: false, searchable: false
            },
			{data: 'description', name: 'description'},
			{
                data: 'category', name: 'category',
				sClass: 'text-center',
            },
			{
                data: 'color', name: 'color',
				sClass: 'text-center',
            },
			{
                data: 'price', name: 'price',
				sClass: 'text-center',
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
			url: '/Admin/Shop/create',
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_item', data);
			imagezone();
			build_ckeditor();
            select2();
            tooltip();
			checkall();
			$(".colorinput-input").change(function(){
				tickCheckAll();
			})
		})
	})

	$(document).on('submit', '#form_add_item', function(e) {
		let data = new FormData(this);

		$.ajax({
			method: "POST",
			url: '/Admin/Shop/store',
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
				validation(feedback.item, '#item', '#item-feedback');
				validation(feedback.photo, '#photo', '#photo-feedback');
				validation(feedback.description, '#ckeditor', '#description-feedback');
				validation(feedback.product__categories_id, '#category', '#category-feedback');
				validation(feedback.fromPrice, '#fromPrice', '#fromPrice-feedback');
				validation(feedback.toPrice, '#toPrice', '#toPrice-feedback');
			} else {
				$('#modal_add_item').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'{{ __("admin/crud.variable.item") }} ' + data.get('item') + ' {{ __("admin/swal.successItem") }}',
					'success',
				);
				reload_table(item_table);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editItem", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Shop/edit',
			data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_item', data);
			imagezone();
			build_ckeditor();
            select2();
            tooltip();
			checkall();
			tickCheckAll();
			$(".colorinput-input").change(function(){
				tickCheckAll();
			})
		})
	})
	
	$(document).on('submit', '#form_edit_item', function(e) {
		let data = new FormData(this);

		$.ajax({
			method: "POST",
			url: '/Admin/Shop/update',
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
				validation(feedback.item, '#item', '#item-feedback');
				validation(feedback.photo, '#photo', '#photo-feedback');
				validation(feedback.description, '#ckeditor', '#description-feedback');
				validation(feedback.product__categories_id, '#category', '#category-feedback');
				validation(feedback.fromPrice, '#fromPrice', '#fromPrice-feedback');
				validation(feedback.toPrice, '#toPrice', '#toPrice-feedback');
			} else {
				$('#modal_edit_item').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'{{ __("admin/swal.successEdit", ["page" => $title]) }}',
					'success',
				);
				reload_table(item_table);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deleteItem", function() {
		let id = $(this).attr("data-id");
		let name = $(this).attr("data-item");

		Swal.fire({
			title: 'Yakin ingin data pengurus ini?',
			html: 'Data <strong>' + name + '</strong> akan hilang!',
			showCancelButton: true,
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					url: '/Admin/Shop/destroy',
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
						reload_table(item_table);
					}
				});
			}
		});
	});

	$(document).on("click", "#rearrangeItem", function() {
        let id = $(this).attr("data-id");

        $.ajax({
            url: "/Admin/ProductGallery",
            type: "GET",
			data: {id},
            beforeSend: function(){
				show_loader();
            },
        }).done(function (data) {
			hide_loader();
			call_modal('#modal_rearrange_photo', data);
			$(function () {
				$("#arrange").sortable({
					filter: ".number",
					update: function (event, ui) {
						var values = [];
						$(".listitemClass").each(function (index) {
							values.push($(this).attr("id"));
						});
						$("#outputvalues").val(values);
						$('#btn-updateOrder').prop("disabled", false);
					}, 
				});
			});
        })
    })

	$(document).on('submit','#form_update_order',function(e){
		let data = $(this).serialize();

		$.ajax({
            url: "/Admin/ProductGallery/update",
            method: "PUT",
            data: data,
			error: function() {
				errorSwal()
			},
			success: function(data) {
				$('#modal_rearrange_photo').modal('hide');
				Swal.fire({
					title: "{{ __('admin/crud.orderUpdated') }}",
					icon: 'success',
				})
				reload_table(item_table);
			}
        })
		e.preventDefault();
    });

    function checkall(){
        $("#checkAll").click(function () {
            $("input.colorinput-input:checkbox").not(this).prop("checked", this.checked);
        });
    }

	function tickCheckAll(){
		if($('.colorinput-input:checked').length == $('.colorinput-input').length){
			$('#checkAll').prop("checked", true);
		} else {
			$('#checkAll').prop("checked", false);
		}
	}

    function imagezone() {
		let params = {
			label: "Drag & Drop files here or click to browse",
			imagesInputName: "photo",
			extensions: [".jpg", ".jpeg", ".png"],
			mimes: ["image/jpeg", "image/png"],
			maxSize: 5242880,
			maxFiles: 10,
		};

        if ($(".input-images").attr("data-folder")) {
            let img_arr = $(".input-images").attr("data-images").split(",");
            let old_img = [];

            img_arr.forEach(function (item, index) {
                old_img.push({
                    id: item,
                    src: $(".input-images").attr("data-folder") + '/' + item + "/3x_" + item,
                });
            });

            params.preloaded = old_img;
            $(".input-images").imageUploader(params);
        } else {
            $(".input-images").imageUploader(params);
        }
    };
</script>

@endpush