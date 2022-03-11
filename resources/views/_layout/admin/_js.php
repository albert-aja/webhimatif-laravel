<?php
  $request = service('request');
?>

<!-- Jquery Scripts -->
<script src="<?= base_url(); ?>/assets/vendor/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/jquery.uploadPreview.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/nicescroll/jquery.nicescroll.min.js"></script>

<!-- Bootstrap Components -->
<script src="<?= base_url(); ?>/assets/vendor/popper.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/tooltip.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="<?= base_url(); ?>/assets/vendor/image-uploader-master/dist/image-uploader.min.js"></script>

<!-- Forms components -->
<script src="<?= base_url(); ?>/assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/cropperjs/cropper.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/select2/js/select2.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/bootstrap-daterangepicker/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>

<?php 
  if(strtolower($request->uri->getSegment(2)) == 'berita' || strtolower($request->uri->getSegment(2)) == 'shop'){
?>
  <script src="<?= base_url(); ?>/assets/vendor/ckeditor/ckeditor.js"></script>
<?php
  } 
?>

<!-- DataTables Script -->
<script src="<?= base_url(); ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/datatables/responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/datatables/responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Local JS -->
<script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
<?php 
  if(strtolower($request->uri->getSegment(3)) == 'changepassword') {
    echo '<script src="' . base_url(). '/assets/js/changepassword.js"></script>';
  }
?>

<?php 
  if(strtolower($request->uri->getSegment(2)) == 'dashboard') {
    echo '<script src="' .base_url(). '/assets/js/chart.js"></script>';
    include './assets/js/server_ajax/dashboard_ajax.php'; 
  } else {
    include './assets/js/server_ajax/crud_ajax.php'; 
  }
  include './assets/js/server_ajax/maintenance_ajax.php'; 
?>

<?php 
  if(strtolower($request->uri->getSegment(2)) == 'berita') {
    echo 
    "<script>
      title = document.querySelector('#title').value;
      date = document.querySelector('.datepicker').value;
      
      //CKEditor
        let editor = CKEDITOR.replace('ckeditor', {
        height: 300,
        filebrowserUploadUrl: '".base_url()."/Admin/Berita/uploadArticleImage?judul=' + title + '&date=' + date,
        filebrowserUploadMethod: 'form',
      });

      editor.config.extraPlugins = 'autogrow';
      editor.config.editorplaceholder = 'Ketik artikel disini..';
      editor.config.allowedContent = true;
      editor.config.autoGrow_minHeight = 300;
      editor.config.autoGrow_maxHeight = 800;
    </script>";
  } else if(strtolower($request->uri->getSegment(2)) == 'shop'){
    echo
    "<script>
    let editor = CKEDITOR.replace('ckeditor', {
      height: 300
    });
    </script>";
  }
?>
