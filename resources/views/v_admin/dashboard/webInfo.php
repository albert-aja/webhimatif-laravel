<a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="fas fa-globe"></i></a>
<div class="dropdown-menu dropdown-list dropdown-menu-end">
    <div class="dropdown-header">
    Status Website
    <div class="float-right">
        <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="maintenance-btn" <?= ($statusWeb['status'] == 'FALSE') ? 'checked' : '' ?> data-status="<?= strtolower($statusWeb['status']) ;?>">
        </div>
        <?php 
        if($statusWeb['status'] == 'TRUE') {
        ?>
        <span class="badge badge-danger">Offline</span>
        <?php 
        } else if($statusWeb['status'] == 'FALSE') {
        ?>
        <span class="badge badge-success">Online</span>
        <?php } ?>
    </div>
    </div>
    <div class="dropdown-list-content dropdown-list-icons">
    <?php 
        if($statusWeb['status'] == 'TRUE') {
        ?>
        <a class="dropdown-item">
        <div class="dropdown-item-icon bg-danger text-white">
            <i class="fas fa-times"></i>
        </div>
        <div class="dropdown-item-desc">
            Saat ini website tidak dapat diakses oleh user karena sedang maintenance
        </div>
        </a>
        <?php 
        } else if($statusWeb['status'] == 'FALSE') {
        ?>
        <a class="dropdown-item">
        <div class="dropdown-item-icon bg-success text-white">
            <i class="fas fa-check"></i>
        </div>
        <div class="dropdown-item-desc">
            Website sedang aktif dan dapat diakses oleh user
        </div>
        </a>
        <?php } ?>
    </div>
</div>