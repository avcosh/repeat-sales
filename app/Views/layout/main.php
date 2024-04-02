<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta http-equiv="Refresh" content="600" />-->
    <title>Дашборд от CRM-Мастерской «TSL» | <?= $title ?? '' ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
	
	<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('plugins/chart.js/Chart.min.js'); ?>"></script>
	
	<script type="text/javascript" src="<?= base_url('js/bootstrap-multiselect.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap-multiselect.min.css') ?>" type="text/css"/>

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style = "z-index: 103 !important;">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <!--<li class="nav-item d-none d-sm-inline-block">
                <a href="<?= route_to('site.index') ?>" class="nav-link">Главная</a>
            </li>-->
		
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->include('layout/incs/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                         <?= $this->renderSection('content') ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        </div>
       
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('js/main.js') ?>"></script>
</body>
</html>
