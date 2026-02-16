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
                <a href="{{ route('admin') }}" class="nxl-link">
                    <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                    <span class="nxl-mtext">Dashboard</span></span>
                </a>
            </li>
            @if(in_array('superadmin_jtisurat', Auth::user()->roles))
            <li class="nxl-item nxl-hasmenu nxl-trigger">
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
            @endif
            <li class="nxl-item nxl-hasmenu nxl-trigger">
                <a href="javascript:void(0);" class="nxl-link">
                    <span class="nxl-micon"><i class="feather-book-open"></i></span>
                    <span class="nxl-mtext">Pengajuan Surat</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                </a>
                <ul class="nxl-submenu">
                    @foreach(['pending' => ['Diproses', 'bg-warning'], 'approved' => ['Dicetak', 'bg-teal'], 'done' => ['Selesai', 'bg-success'], 'rejected' => ['Ditolak', 'bg-danger']] as $key => $val)
                    <li class="nxl-item {{ request()->is('admin/'.$key) ? 'active' : '' }}">
                        <a class="nxl-link d-flex align-items-center justify-content-between" href="{{ route('admin.status', ['status' => $key]) }}">
                            <span class="d-flex align-items-center">{{ $val[0] }}</span>
                            <span class="badge {{ $val[1] }}">{{ $letterCounts['dt'.ucfirst($key)] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</div>