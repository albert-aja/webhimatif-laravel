<section class="section">
    <div class="section-header">
        @if($route)
		<div class="section-header-back">
            <a href="{{ $route }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        @endif
        <h1>{{ $title }}</h1>
        {!! $breadcrumb !!}
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>@lang('admin/crud.table.header', $page)</h4>
                    <div class="card-header-action">
						<button type="button" class="form-control btn btn-icon icon-left btn-primary" id="modal_add">
							<i class="fas fa-plus"></i> @lang('admin/crud.add', $page)
						</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="{{ $tableID }}">
                            <thead>
                                <tr class="text-center">
                                    <th>@lang('admin/crud.table.index')</th>
                                        {{ $slot }}
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