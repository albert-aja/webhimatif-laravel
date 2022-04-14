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
                    <h4>{{ $title }}</h4>
                    <div class="card-header-action">
                        <button type="button" class="form-control btn btn-icon icon-left btn-danger truncateTable" data-tbl="*">
                            <i class="fas fa-bomb"></i> Truncate All
                        </button>
                    </div>
                </div> 
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableTruncate">
                            <thead>
                                <tr class="text-center">
                                    <th>@lang('admin/crud.table.index')</th>
                                    <th>@lang('admin/crud.variable.table')</th>
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
    let dt_table = $('#tableTruncate').DataTable({
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
			{data: 'table', name: 'table'},
			{
				data: 'action', name: 'action',
				sClass: 'text-center',
				orderable: false, searchable: false,
			},
		]
	});

    $(document).on("click", ".detailTable", function() {
		let table = $(this).attr("data-tbl");

		$.ajax({
			method: "GET",
			url: '/Admin/Database/detail',
            data: {table}, 
            beforeSend: function(){
				show_loader();
			},
		}).done(function(data) {
			hide_loader();
			call_modal('#modal_detail_table', data);
		})
	})

	$(document).on('click', '.truncateTable', function(e) {
		let table = $(this).attr("data-tbl");

		$.ajax({
			method: "POST",
			url: '/Admin/Database/truncate',
			data: {table},
            beforeSend: function(){
                show_loader();
            },
		}).done(function(res) {
            hide_loader();

			Swal.fire({
				title: '{{ __("admin/swal.success") }}',
				text: 'Seluruh data pada database telah dihapus',
				icon: 'success',
				timer: 2000,
				timerProgressBar: true,
			});
		})
		e.preventDefault();
	})
</script>

@endpush