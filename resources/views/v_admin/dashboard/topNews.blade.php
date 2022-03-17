<div class="card-header">
    <div class="card-icon">
        <i class="fas fa-trophy"></i>
    </div>
    <h4 class="fs-2">@lang('admin/dashboard.chart.topNews.title', ['rank' => $rankedNews])</h4>
    <div class="card-description">@lang('admin/dashboard.chart.topNews.subtitle')</div>
</div>
<div class="card-body topNews-body p-0">
    <div class="tickets-list px-2">
        @foreach($newsData as $nd)
        <a target="_blank" rel="noopener noreferrer" class="ticket-item {{ (!$loop->last) ? 'border-bottom' : '' }}"
            href="{{ route('web-article', $nd['slug']) }}">
            <div class="float-left col-2 rankNumber">
                <div>
                    <h4>{{ $loop->iteration }}</h4>
                </div>
                <div>
                    <span class="newsViewer">{{ $nd['viewed'] }}<i class="fas fa-eye"></i></span>
                </div>
            </div>
            <div class="content-inner ms-3 col-10">
                <div class="ticket-title">
                    <h4>{{ $nd['title'] }}</h4>
                </div>
                <div class="ticket-info">
                    <div class="bullet"></div>
                    <span class="text-primary">{{ App\Helpers\General::indonesia_date($nd['created_at']) }} </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>