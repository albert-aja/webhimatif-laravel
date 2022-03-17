<div class="card-header">
    <h4>@lang('admin/dashboard.chart.latestNews.title')</h4>
    <div class="card-header-action">
        <a href="{{ route('post-create') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('admin/dashboard.chart.latestNews.tooltipAdd') }}"><i class="fas fa-plus"></i></a>
    </div>
</div>
<div class="card-body">
    <ul class="list-unstyled list-unstyled-border">
        @foreach($latestNews as $news)
        <li class="media {{ (!$loop->last) ? 'border-bottom' : '' }}">
            <img
                class="me-3 rounded-circle"
                src="{{ asset($news['hero_image']) }}"
                alt="{{ $news['title'] }}"
            />
            <div class="media-body">
                <a href="{{ route('post-edit', $news['id']) }}" class="btn btn-warning rounded-circle float-right" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('admin/dashboard.chart.latestNews.tooltipEdit') }}"><i class="fas fa-pen"></i></a>
                <div class="media-title">{{ $news['title'] }}</div>
                <div class="text-medium fw-bold text-muted">@lang('admin/dashboard.chart.latestNews.date') {{ $news['created_at'] }}</div>
                <div class="text-medium text-muted mt-1">
                    {!! $news['article'] !!}
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>