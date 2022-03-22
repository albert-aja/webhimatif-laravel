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
                        <a class="form-control btn btn-icon icon-left btn-primary" href="{{ route('post-create') }}">
                            <i class="fas fa-plus"></i>
                            @lang('admin/crud.add', $page)
                        </a>
                    </div>
                </div> 
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tablePosts">
                            <thead>
                                <tr class="text-center">
                                    <th>@lang('admin/crud.table.index')</th>
                                    <th>@lang('admin/crud.variable.title')</th>
                                    <th>@lang('admin/crud.variable.article')</th>
                                    <th>@lang('admin/crud.variable.photo')</th>
                                    <th>@lang('admin/crud.variable.date')</th>
                                    <th>@lang('admin/crud.variable.division')</th>
                                    <th>@lang('admin/crud.variable.view')</th>
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

@endsection

@push('addon-script')
<script>
    let dataTable = $('#tablePosts').DataTable({
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
			{data: 'title', name: 'title'},
			{data: 'article', name: 'article'},
			{
				data: 'hero_image', name: 'hero_image', 
				orderable: false, searchable: false,
			},
			{data: 'created_at', name: 'created_at'},
			{
				data: 'division_id', name: 'division_id',
				sClass: 'text-center',
			},
			{
				data: 'viewed', name: 'viewed',
				sClass: 'text-center'
			},
			{
				data: 'action', name: 'action',
				sClass: 'text-center',
				orderable: false, searchable: false,	
			},
		]
	});

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