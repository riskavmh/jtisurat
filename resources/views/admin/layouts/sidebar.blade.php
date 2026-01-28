<a href="{{ route('/') }}" class="brand-link">
  <img src="{{ asset('assets/img/admin_logo.png') }}" class="brand-image img-circle elevation-3" style="opacity: .6">
  <span class="brand-text">JTI Surat</span>
</a>

<div class="sidebar">
  <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex text-center">
    <div class="info">
        <h3 class="d-block text-light border pl-3 pr-3 pt-2 pb-2">SUPER ADMIN</h3>
        <span class="d-block text-white">Jurusan Teknologi Informasi</span>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-2 btn btn-danger text-light"><i class="fa fa-sign-out-alt"></i></a>
    </div>
  </div> -->

  <div class="user-panel mt-3 pb-3 mb-3 d-flex text-center">
    <div class="info">
      <span class="d-block text-white border pl-2 pr-2 pt-1 pb-1 mb-2">{{ implode(Auth::user()->roles) }}</span>
        <span class="d-block text-white text-wrap text-sm">{{ Auth::user()->name }}</span>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-2 btn btn-danger text-light text-sm pl-2 pr-2 pt-1 pb-1">Logout &nbsp;<i class="fa fa-sign-out-alt"></i></a>
      </div>
  </div>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ route('/') }}" class="nav-link">
          <i class="nav-icon fas fa-layer-group"></i>
          <p>Landing Page</p>
        </a>
      </li>
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
            <a href="{{ route('type.index') }}" class="nav-link {{ request()->routeIs('type.*') ? 'active' : '' }}">
              <i class="nav-icon far fa-circle"></i>
              <p>Jenis Surat</p>
            </a>
          </li>
        </ul>
      </li>
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