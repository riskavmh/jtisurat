<div class="navbar-wrapper">
    <div class="m-header">
        <a href="index.html" class="b-brand">
            <!-- <img src="{{ asset('assets/img/admin_logo.png') }}" alt="" class="logo logo-lg"> -->
            <!-- <img src="{{ asset('assets/img/admin_logo.png') }}" alt="" class="logo logo-sm"> -->
            <img src="{{ asset('assets/img/admin_logo.png') }}" alt="" class="logo logo-sm">
        </a>
    </div>
    <div class="navbar-content">
        <ul class="nxl-navbar">
            <li class="nxl-item nxl-caption">
                <label>Menu</label>
            </li>
            <li class="nxl-item nxl-hasmenu">
                <a href="{{ route('/') }}" class="nxl-link">
                    <span class="nxl-micon"><i class="feather-airplay"></i></span>
                    <span class="nxl-mtext">Landing Page</span></span>
                </a>
            </li>
            <li class="nxl-item nxl-hasmenu {{ request()->routeIs('admin') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="nxl-link">
                    <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                    <span class="nxl-mtext">Dashboard</span></span>
                </a>
            </li>
            <li class="nxl-item nxl-hasmenu">
                <a href="javascript:void(0);" class="nxl-link">
                    <span class="nxl-micon"><i class="feather-server"></i></span>
                    <span class="nxl-mtext">Data Master</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                </a>
                <ul class="nxl-submenu">
                    <li class="nxl-item {{ request()->routeIs('type.*') ? 'active' : '' }}"><a class="nxl-link" href="{{ route('type.index') }}">Jenis Surat</a></li>
                    <li class="nxl-item"><a class="nxl-link" href="">Koordinator</a></li>
                    <li class="nxl-item"><a class="nxl-link" href="">Program Studi</a></li>
                </ul>
            </li>
            <li class="nxl-item nxl-hasmenu nxl-trigger">
                <a href="javascript:void(0);" class="nxl-link">
                    <span class="nxl-micon"><i class="feather-book-open"></i></span>
                    <span class="nxl-mtext">Pengajuan Surat</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                </a>
                <ul class="nxl-submenu">
                    <!-- <li class="nxl-item"><a class="nxl-link" href="">Semua Surat</a></li> -->
                    <li class="nxl-item {{ request()->routeIs('pending') ? 'active' : '' }}">
                      <a class="nxl-link" href="{{ route('pending') }}">Diproses<span class="badge badge-warning right">{{ $letterCounts['dtSrtDiproses'] }}</span></a>
                    </li>
                    <li class="nxl-item {{ request()->routeIs('approved') ? 'active' : '' }}">
                      <a class="nxl-link" href="{{ route('approved') }}">Selesai<span class="badge badge-success right">{{ $letterCounts['dtSrtSelesai'] }}</span></a>
                    </li>
                    <li class="nxl-item {{ request()->routeIs('rejected') ? 'active' : '' }}">
                      <a class="nxl-link" href="{{ route('rejected') }}">Ditolak<span class="badge badge-danger right">{{ $letterCounts['dtSrtDitolak'] }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>