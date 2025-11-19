<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JTI Surat - @yield('title')</title>
  @include('admin.layouts.css')
  @yield('css')
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
    @include('admin.layouts.sidebar')
    </aside>

    <div class="content-wrapper">
      @yield('content')
    </div>

    <footer class="main-footer">
      <span>Copyright &copy; 2025 <strong>JTI Surat</strong> All Rights Reserved</span>
      <div class="float-right d-none d-sm-inline-block">
        Distributed by <a href="https://jti.polije.ac.id/">JTI Polije</a>
      </div>
    </footer>

  </div>

@include('admin.layouts.script')
@yield('script')
</body>
</html>
