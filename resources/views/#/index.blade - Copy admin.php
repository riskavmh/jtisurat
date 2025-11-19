<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JTI Surat</title>

  <link href="assets/img/fav2.png" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/dashboard/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="assets/img/admin_logo.png" class="brand-image img-circle elevation-3" style="opacity: .6">
      <span class="brand-text font-weight-light">JTI Surat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex text-center">
        <div class="info">
           <h3 class="d-block text-light border pl-3 pr-3 pt-2 pb-2">SUPER ADMIN</h3>
           <span class="d-block text-white">Jurusan Teknologi Informasi</span>
           <a href="" class="mt-2 mr-1 text-light btn btn-primary"><i class="fa fa-edit" ></i></a>
           <a href="" data-target="#logoutModal" data-toggle="modal" class="mt-2 ml-1 btn btn-danger text-light"><i class="fa fa-sign-out-alt"></i></a>
        </div>
      </div>

      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
           <span class="d-block text-white">xxxx</span>
           <span class="d-block text-white">Admin Prodi : </span>
           <span class="d-block text-white">Telp : 0823-3534-4634</span>
           <a href="" class="mt-2 mr-1 btn btn-secondary text-light">Edit</a>
           <a data-toggle="modal" data-target="#logoutModal" class="mt-2 ml-1 btn btn-danger text-light">Logout</a>
          </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Jenis Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Koordinator</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Dosen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Mahasiswa</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Mahasiswa</p>
            </a>
          </li> -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pengajuan Surat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="p" class="nav-link">
                  <i class="nav-icon far fa-circle text-warning"></i>
                  <p>Diproses<span class="badge badge-warning right">20</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Diterima<span class="badge badge-info right">137</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle text-success"></i>
                  <p>Selesai<span class="badge badge-success right">14</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-circle text-danger"></i>
                  <p>Ditolak<span class="badge badge-danger right">48</span></p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">JTI Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="card col-lg-12 col-md-12">
            <div class="card-header">
              <h3 class="card-title">
                Dashboard
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <div class="row">

                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-warning"><i class="fa fa-envelope text-white"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Surat Baru Masuk</span>
                        <span class="info-box-number">13</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-info"><i class="fa fa-envelope"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Surat Dapat Dicetak</span>
                        <span class="info-box-number">410</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-success"><i class="fa fa-envelope"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Surat Selesai</span>
                        <span class="info-box-number">763</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-danger"><i class="fa fa-envelope"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Surat Ditolak</span>
                        <span class="info-box-number">98</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <span>Copyright &copy; 2025 <strong>JTI Surat</strong> All Rights Reserved</span>
    <div class="float-right d-none d-sm-inline-block">
      Distributed by <a href="https://jti.polije.ac.id/">JTI Polije</a>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets/dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/dashboard/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/dashboard/plugins/moment/moment.min.js"></script>
<script src="assets/dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dashboard/dist/js/adminlte.js"></script>
<script src="assets/dashboard/dist/js/pages/dashboard.js"></script>
</body>
</html>
