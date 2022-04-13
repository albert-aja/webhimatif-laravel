@extends('_layout.admin._template')

@section('content')

<x-datatable-page :title="$title" :breadcrumb="$breadcrumb" :page="$page" tableID="tableSocials" route="">
    <th>@lang('admin/crud.variable.social_media')</th>
    <th>@lang('admin/crud.variable.link')</th>
    <th>@lang('admin/crud.variable.icon')</th>
    <th>@lang('admin/crud.variable.color')</th>
</x-datatable-page>

@endsection

@push('addon-script')

<script>
    let social_table = $('#tableSocials').DataTable({
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
			{data: 'social', name: 'social'},
			{data: 'link', name: 'link'},
			{
                data: 'icon', name: 'icon',
				sClass: 'text-center',
				orderable: false, searchable: false
            },
			{
                data: 'color', name: 'color',
				sClass: 'd-flex align-items-center justify-content-center',
				orderable: false, searchable: false
            },
			{
				data: 'action', name: 'action',
				sClass: 'text-center',
				orderable: false, searchable: false,
			},
		],
        initComplete: tooltip,
	});

    function colorBucket(color = $('#hex_code').val()){
        $(".input-group-text").css("background", color);
        $(".input-group-text i").css("opacity", 0);
        $("#preview-btn").css("background", color);
        $("#preview-icon").css("color", '#fff');
    }

    function colorChange() {
        $("#hex_code").keyup(function () {
            color = $(this).val();

            if(color.charAt(0) != '#'){
                color = '#' + color;
            }
            colorBucket(color);
        });
    }

	$(document).on("click", "#modal_add", function() {
		$.ajax({
			method: "GET",
			url: '/Admin/Config/SocialMedia/create',
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_add_social', data);
			tooltip();
			preview_social();
            colorChange();
		})
	})

	$(document).on('submit', '#form_add_social', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Config/SocialMedia/store',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.social, '#social_media', '#social_media-feedback');
				validation(feedback.link, '#link', '#link-feedback');
				validation(feedback.icon, '#icon', '#icon-feedback');
				validation(feedback.color, '#hex_code', '#hex_code-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_add_social').modal('hide');
				Swal.fire({
					title: '{{ __("admin/swal.success") }}',
					text:  'Media Sosial ' + capitalize(param.social) + ' {{ __("admin/swal.successItem") }}',
					icon:  'success',
					timer: 2000,
					timerProgressBar: true,
				});
				reload_table(social_table);
			}
		})
		e.preventDefault();
	})

	$(document).on("click", ".editSocial", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Config/SocialMedia/edit',
            data: {id},
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_edit_social', data);
			tooltip();
			preview_social();
			colorBucket();
            colorChange();
		})
	})

	$(document).on('submit', '#form_edit_social', function(e) {
		let data = $(this).serialize();

		$.ajax({
			method: "POST",
			url: '/Admin/Config/SocialMedia/update',
			data: data,
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
			let feedback = jQuery.parseJSON(res);
            hide_loader();
			
			if (feedback.status.toLowerCase() == "{{ __('admin/crud.val_failed') }}") {
				validation(feedback.social, '#social_media', '#social_media-feedback');
				validation(feedback.link, '#link', '#link-feedback');
				validation(feedback.icon, '#icon', '#icon-feedback');
				validation(feedback.color, '#hex_code', '#hex_code-feedback');
			} else {
				param = parse_query_string(data);

				$('#modal_edit_social').modal('hide');
				Swal.fire(
					'{{ __("admin/swal.success") }}',
					'Kontak telah diperbarui',
					'success',
				);
				reload_table(social_table);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deleteSocial", function() {
		let id = $(this).attr("data-id");
		let social = $(this).attr("data-social");

		Swal.fire({
			title: 'Yakin ingin hapus warna produk?',
			html: 'Kontak <strong>' + social + '</strong> akan hilang!',
			showCancelButton: true,
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					url: '/Admin/Config/SocialMedia/destroy',
					method: 'DELETE',
                    data: {id},
					error: function() {
						errorSwal()
					},
					success: function(data) {
						Swal.fire({
							html: 'Kontak <strong>' + social + '</strong> berhasil dihapus!',
							icon: 'success',
						})
						reload_table(social_table);
					}
				});
			}
		});
	});
</script>

@endpush