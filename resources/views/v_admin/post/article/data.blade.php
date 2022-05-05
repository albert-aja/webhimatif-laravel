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
                </div> 
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tablePostImages">
                            <thead>
                                <tr class="text-center">
                                    <th>@lang('admin/crud.table.index')</th>
                                    <th>@lang('admin/crud.variable.title')</th>
                                    <th>@lang('admin/crud.variable.photo')</th>
                                    {{-- <th>@lang('admin/crud.table.action')</th> --}}
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
    let images_table = $('#tablePostImages').DataTable({
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
			{data: 'title', name: 'title'},
			{
				data: 'photo', name: 'photo',
				sClass: 'text-center',
				orderable: false, searchable: false,
			},
			// {
			// 	data: 'action', name: 'action',
			// 	sClass: 'text-center',
			// 	orderable: false, searchable: false,	
			// },
		]
	});

	$(document).on("click", ".editDivision", function() {
		let id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: '/Admin/Post/edit',
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
			url: '/Admin/Post/update',
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
				reload_table(images_table);
			}
		})
		e.preventDefault();
	})

    $(document).on("click", ".deletePost", function() {
		let title = $(this).attr("data-title");
		let id = $(this).attr("data-id");

		swal({
			title: 'Yakin ingin menghapus berita berjudul "' +title+ '"?',
			text: 'Berita akan hilang setelah dihapus!',
			icon: 'warning',
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '/Admin/berita/delete_article/'+id,
					type: 'DELETE',
					error: function() {
						swal('Error', 'Terjadi Kesalahan!', 'error');
					},
					success: function(data) {
						swal('Poof! Berita Berhasil Di Hapus!', {
							icon: 'success',
						});
						reload_table(article_table);
					}
				});
			}
		});
	});
</script>
@endpush