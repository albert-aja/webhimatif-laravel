<a href="#" data-bs-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
    <span class="beep" style="background-color: {{ (!$statusWeb->is_maintenance) ? '#20c997' : '#ffa426' }} "></span>
    <i class="fas fa-globe"></i>
</a>
<div class="dropdown-menu dropdown-list dropdown-menu-end d-none">
    <div class="dropdown-header">Status Website
        <div class="float-right">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="maintenance-btn" {{ (!$statusWeb->is_maintenance) ? 'checked' : '' }} data-status="{{ $statusWeb->is_maintenance }}">
            </div>

            @if(!$statusWeb->is_maintenance)
            <span class="badge badge-success">Online</span>
            @else
            <span class="badge badge-danger">Offline</span>
            @endif

        </div>
    </div>
    <div class="dropdown-list-content dropdown-list-icons">
        @if(!$statusWeb->is_maintenance)
        <a class="dropdown-item">
            <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
            </div>
            <div class="dropdown-item-desc">
                <h6>Active Mode</h6>
                Website sedang aktif dan dapat diakses oleh user!
            </div>
        </a>
        @else
        <a class="dropdown-item">
            <div class="dropdown-item-icon bg-danger text-white">
                <i class="fas fa-times"></i>
            </div>
            <div class="dropdown-item-desc">
                <h6>Maintenance Mode</h6>
                Saat ini user tidak dapat mengakses website karena sedang dalam Maintenance Mode!
            </div>
        </a>
        @endif
    </div>
</div>