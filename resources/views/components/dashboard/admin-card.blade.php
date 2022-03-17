<div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
        <div class="card-icon {{ $bg }}">
            <i class="fas {{ $icon }}"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="card-body">
                {{ $info }}
            </div>
            @if ($route)
            <a href="{{ $route }}" class="text-small stretched-link">
                @lang('admin/dashboard.card.info') <i class="fa fa-arrow-circle-right"></i>
            </a>
            @endif
        </div>
    </div>
</div>