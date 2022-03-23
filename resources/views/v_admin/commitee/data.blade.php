@extends('_layout.admin._template')

@section('content')

<section class="section">
    <div class="section-header">
		<div class="section-header-back">
            <a href="{{ route('division-data') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>{{ $title }}</h1>
        {!! $breadcrumb !!}
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>@lang('admin/crud.table.header', $page)</h4>
                    <div class="card-header-action">
                        <a class="form-control btn btn-icon icon-left btn-primary" href="{{ route('commitee-create', $slug) }}">
                            <i class="fas fa-plus"></i>
                            @lang('admin/crud.add', $page)
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableCommitees">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('admin/crud.table.index')</th>
                                <th>@lang('admin/crud.variable.name')</th>
                                <th>@lang('admin/crud.variable.photo')</th>
                                <th>@lang('admin/crud.variable.division')</th>
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

@endsection

@push('addon-script')
<script>
    let commitee_table = $('#tableCommitees').DataTable({
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
			{data: 'name', name: 'name'},
			{
                data: 'photo', name: 'photo',
				sClass: 'text-center',
				orderable: false, searchable: false
            },
			{data: 'division.alias', name: 'division.alias'},
			{data: 'position.position', name: 'position.position'},
			{
				data: 'action', name: 'action',
				sClass: 'text-center',
				orderable: false, searchable: false,
			},
		]
	});

    $(document).on("click", ".deleteCommitee", function() {
		let url = $(this).attr("data-url");
		let id = $(this).attr("data-id");
		let name = $(this).attr("data-name");
        let slug = "{{ $slug }}";

		Swal.fire({
			title: 'Yakin ingin data pengurus ini?',
			html: 'Data <strong>' + name + '</strong> akan hilang!',
            imageUrl: url,
			showCancelButton: true,
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					url: '/Admin/Commitee/{{ $slug }}/destroy',
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
						reload_table(commitee_table);
					}
				});
			}
		});
	});
</script>
@endpush