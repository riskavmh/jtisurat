<a href="{{ route('/') }}" class="brand-link">
  <img src="{{ asset('assets/img/admin_logo.png') }}" class="brand-image img-circle elevation-3" style="opacity: .6">
  <span class="brand-text">JTI Surat</span>
</a>

<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex text-center">
    <div class="info">
        <h3 class="d-block text-light border pl-3 pr-3 pt-2 pb-2">SUPER ADMIN</h3>
        <span class="d-block text-white">Jurusan Teknologi Informasi</span>
        <!-- <a href="" class="mt-2 mr-1 text-light btn btn-primary"><i class="fa fa-edit" ></i></a> -->
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

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ route('admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-columns"></i>
          <p>
            Data Master
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('jenis.index') }}" class="nav-link {{ request()->routeIs('jenis.*') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle"></i>
              <p>Jenis Surat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('koordinator') }}" class="nav-link {{ request()->routeIs('koordinator') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle"></i>
              <p>Koordinator</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dosen') }}" class="nav-link {{ request()->routeIs('dosen') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle"></i>
              <p>Dosen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('adminps') }}" class="nav-link {{ request()->routeIs('adminps') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle"></i>
              <p>Admin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('mahasiswa') }}" class="nav-link {{ request()->routeIs('mahasiswa') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle"></i>
              <p>Mahasiswa</p>
            </a>
          </li>
        </ul>
      </li>
      <!-- <li class="nav-item">
        <a href="{{ route('mahasiswa') }}" class="nav-link {{ request()->routeIs('mahasiswa') ? 'active' : '' }}">
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
            <a href="{{ route('srtproses') }}" class="nav-link {{ request()->routeIs('srtproses') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Diproses<span class="badge badge-warning right">{{ $suratCounts['dtSrtDiproses'] }}</span></p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('srtselesai') }}" class="nav-link {{ request()->routeIs('srtselesai') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle text-success"></i>
              <p>Selesai<span class="badge badge-success right">{{ $suratCounts['dtSrtSelesai'] }}</span></p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('srttolak') }}" class="nav-link {{ request()->routeIs('srttolak') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p>Ditolak<span class="badge badge-danger right">{{ $suratCounts['dtSrtDitolak'] }}</span></p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>