<?php
  $request = service('request');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Title -->
    <title>
        <?= $title; ?> | Admin Himatif USU
    </title>

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url(); ?>/assets/img/logo/white/white_favicon.ico">
    
    <!-- meta -->
    <?= $this->include('_layout/admin/_meta') ?>

    <!-- css --> 
    <?= $this->include('_layout/admin/_css') ?>
  </head>

  <body>
    <div id="item-preloader">
        <i class="circle-preloader"></i>
    </div>
  <div id="app">
    <div class="main-wrapper">

    <?php if(session()->getFlashdata('pesan')){ ?>
        <div aria-live="polite" aria-atomic="true" class="position-relative toast-alert">
            <div class="toast-container position-absolute top-0 end-0 p-3">
                <div class="toast show fade" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="<?= base_url() ;?>/assets/img/logo/black/black_32.png" class="rounded me-2">
                        <strong class="me-auto">Success!</strong>
                        <small class="text-muted"><?= tgl_indonesia(date('Y-m-d')) ;?></small>
                        <button type="button" class="btn-close" id="close-toast"></button>
                    </div>
                    <div class="toast-body">
                        <?= session()->getFlashdata('pesan') ;?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?> 
    <!-- navbar -->
    <?= $this->include('_layout/admin/_nav') ?>

    <?php  
        if(strtolower($request->uri->getSegment(2)) == 'pengurus'){
            echo $this->include('_layout/admin/_cropper');
        }
    ?>

    <!-- Sidebar -->
    <?= $this->include('_layout/admin/_sidebar') ?>
    
    <!-- Main Content -->
    <div class="main-content">

    <!-- content -->
    <?= $this->renderSection('content') ?>

    </div>
    <!-- modals -->

    <!-- footer -->
    <?= $this->include('_layout/admin/_footer') ?>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    
    <!-- js -->
    <?= $this->include('_layout/admin/_js') ?>
  </body>
</html>