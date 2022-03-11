<div class="modal fade" id="modal_detail_tabel">
  <div class="modal-dialog   modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= $title ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="table-div">
            <table class="table modal_table">
              <thead>
                <?php foreach($field as $f) { ?>
                  <th class="text-capitalize"><?= $f ;?></th>
                <?php } ?>
              </thead>
              <tbody class="align-middle">
                <?php for($i=0;$i<count($data);$i++) { ?>
                <tr>
                  <?php foreach($data[$i] as $dt) { ?>
                    <td><?= $dt ;?></td>
                  <?php } ?>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
