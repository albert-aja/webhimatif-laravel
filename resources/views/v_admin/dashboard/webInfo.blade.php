<a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
    <i class="fas fa-globe"></i>
</a>
<div class="dropdown-menu dropdown-list dropdown-menu-end">
    <div class="dropdown-header">
    @lang('admin/webInfo.title')
    <div class="float-right">
        <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="maintenance-btn" {{ ($statusWeb['is_maintenance']) ? 'checked' : '' }} data-status="{{ strtolower($statusWeb['status']) }}">
        </div>

        @if($statusWeb['status'])
            <span class="badge badge-danger">@lang('admin/webInfo.online')</span>
        @else
            <span class="badge badge-success">@lang('admin/webInfo.offline')</span>
        @endif

        </div>
    </div>
    <div class="dropdown-list-content dropdown-list-icons">

    @if($statusWeb['status'] == 'TRUE')
        <a class="dropdown-item">
            <div class="dropdown-item-icon bg-danger text-white">
                <i class="fas fa-times"></i>
            </div>
            <div class="dropdown-item-desc">
                @lang('admin/webInfo.status_maintenance')
            </div>
        </a>
    @else
        <a class="dropdown-item">
            <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
            </div>
            <div class="dropdown-item-desc">
                @lang('admin/webInfo.status_maintenance')
            </div>
        </a>
    @endif

    </div>
</div>