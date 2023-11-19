<?php
    include 'header.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
     <h1><?php echo APP_NAME; ?></h1><!--img class="animation__shake" src="<?php echo base_url() ?>public/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60" -->
</div>

<?php
    include 'menu.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
            <?= $this->renderSection('contentarea'); ?>
  </div>
  <!-- /.content-wrapper -->
  
<?php
    include 'footer.php';
?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?php
    include 'scripts.php';
?>

<?= $this->renderSection('pagescripts'); ?>
</body>
</html>
