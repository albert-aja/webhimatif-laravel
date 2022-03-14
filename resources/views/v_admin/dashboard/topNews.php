<div class="card-header">
    <div class="card-icon">
        <i class="fas fa-trophy"></i>
    </div>
    <h4>Top <?= $rankedNews ;?></h4>
    <div class="card-description">Berita dengan pembaca terbanyak</div>
</div>
<div class="card-body topNews-body p-0">
    <div class="tickets-list px-2">
        <?php
            $no = 1; 
            foreach($newsData as $nd){ 
                $img_loc = getFolderPath($nd['created_at'], $nd['slug']);
        ?>
            <a target="_blank" rel="noopener noreferrer" class="ticket-item border-bottom"
                href="<?= base_url() ;?>/Web/Article?judul=<?= $nd['slug'] ;?>">
                <div class="float-left col-2 rankNumber">
                    <div>
                        <h4><?= $no ;?></h4>
                    </div>
                    <div>
                        <span class="newsViewer"><?= $nd['viewed'] ;?><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="content-inner ms-3 col-10">
                    <div class="ticket-title">
                        <h4><?= $nd['title'] ;?></h4>
                    </div>
                    <div class="ticket-info">
                        <div class="bullet"></div>
                        <span class="text-primary"><?= indonesia_date($nd['created_at']) ?></span>
                    </div>
                </div>
            </a>
        <?php
                $no++; 
            } 
        ?>
    </div>
</div>