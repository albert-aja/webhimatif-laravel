<x-dashboard.dashboard-chart :title="__('admin/dashboard.chart.postedNews.title')" canvasID="newsStatChart">
    <div class="card-header-action">
        <span class="badge badge-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">{{ $startMonth. ' - ' .$endMonth }}</span>
    </div>
</x-dashboard.dashboard-chart>