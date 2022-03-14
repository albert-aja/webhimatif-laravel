<div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="fas {{ $icon }}"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="card-body">
                {{ $data }}
            </div>
            <a href="{{ $route }}" class="text-small stretched-link">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>