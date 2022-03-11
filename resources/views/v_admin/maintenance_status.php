<a href="#" data-bs-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
    <span class="beep" style="background-color: <?= ($statusWeb['status'] == 'false') ? '#20c997' : '#ffa426' ;?>"></span>
    <i class="fas fa-globe"></i>
</a>
<div class="dropdown-menu dropdown-list dropdown-menu-end d-none">
    <div class="dropdown-header">Status Website
        <div class="float-right">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="maintenance-btn" <?= ($statusWeb['status'] == 'false') ? 'checked' : '' ?> data-status="<?= $statusWeb['status'] ;?>">
            </div>
            <?php 
                if($statusWeb['status'] == 'false'){
            ?>
            <span class="badge badge-success">Online</span>
            <?php } else if($statusWeb['status'] == 'true') {?>
            <span class="badge badge-danger">Offline</span>
            <?php } ?>
        </div>
    </div>
    <div class="dropdown-list-content dropdown-list-icons">
        <?php 
            if($statusWeb['status'] == 'false'){
        ?>
        <a class="dropdown-item">
            <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
            </div>
            <div class="dropdown-item-desc">
                <h6>Active Mode</h6>
                Website sedang aktif dan dapat diakses oleh user!
            </div>
        </a>
        <?php } else if($statusWeb['status'] == 'true') {?>
        <a class="dropdown-item">
            <div class="dropdown-item-icon bg-danger text-white">
                <i class="fas fa-times"></i>
            </div>
            <div class="dropdown-item-desc">
                <h6>Maintenance Mode</h6>
                Saat ini user tidak dapat mengakses website karena sedang dalam Maintenance Mode!
            </div>
        </a>
        <?php } ?>
    </div>
</div>