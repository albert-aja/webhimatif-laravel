<div class="card-header">
    <h4>Berita Terbaru</h4>
    <div class="card-header-action">
        <a href="./Berita/Write" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
</div>
<div class="card-body">
    <ul class="list-unstyled list-unstyled-border">
        <?php 
        foreach($beritaTerbaru as $bt){ 
            $img_loc = getFolderPath($bt['created_at'], $bt['slug']);
        ?>
        <li class="media border-bottom">
            <img
                class="me-3 rounded-circle"
                src="<?= base_url() ;?>/assets/img/news/<?= $img_loc ;?>/3x_<?= $bt['hero_img'] ;?>"
                alt="<?= $bt['title'] ?>"
            />
            <div class="media-body">
                <a href="./Berita/edit_article?id=<?= $bt['id'] ?>" class="btn btn-warning rounded-circle float-right"><i class="fas fa-pen"></i></a>
                <div class="media-title"><?= $bt['title'] ?></div>
                <div class="text-medium fw-bold text-muted">Tanggal Terbit : <?= indonesia_date($bt['created_at']) ?></div>
                <div class="text-medium text-muted mt-1">
                    <?= substr($bt['article'], 0, 100) . '...' ;?>
                </div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>