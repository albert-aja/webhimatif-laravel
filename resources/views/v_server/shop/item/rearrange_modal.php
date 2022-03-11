<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reorder Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div id="arrange">
        <?php 
	        $img_loc = base_url(). '/assets/img/shop/' .$item['slug_kategori']. '/' .$item['slug']. '/';
            $foto = explode(',', $item['foto']);
            foreach($foto as $ft){
        ?>
            <div id="<?= $ft ;?>" class = "listitemClass">
                <img src="<?= $img_loc. '/' .$ft. '/2x_' .$ft ?>" alt="">
            </div>
        <?php
            } 
        ?>
        </div>
    </div>
    <div class="modal-footer">
        <form method="post" id="form-updateOrder">
            <?= csrf_field() ;?>
            <input class="d-none" type="text" value="<?= $item['id'] ;?>" name="id"/>
            <input class="d-none" id="outputvalues" type="text" value="" name="foto"/>
            <button type="button" class="btn btn-secondary">Close</button>
            <button type="submit" class="btn btn-primary click-button" id="btn-updateOrder" disabled>Save changes</button>
        </form>
    </div>
</div>