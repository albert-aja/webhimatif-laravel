<?php
  $request = service('request');
?>

<!--===============================================================================================-->	
	<script src="<?= base_url() ;?>/assets/vendor/jquery.min.js"></script>
	<script src="<?= base_url() ;?>/assets/vendor/jquery.transit.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url() ;?>/assets/vendor/popper.js"></script>
	<script src="<?= base_url() ;?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<?php 
	if(strtolower($request->uri->getSegment(1)) == 'login'){
        echo '<script src="' .base_url(). '/assets/js/form.js"></script>';
    }
?>