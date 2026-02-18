<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>JTI Surat</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/fav2.png" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/landing/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/landing/vendor/aos/aos.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/landing/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo2.png" alt="Logo JTI Surat" style="height:25px;width:25px;">&nbsp;&nbsp;
        <h1 class="sitename">JTI Surat</h1>
      </a>

      @auth
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><div style="height: 55px"></div></li>
          <li class="dropdown"><a href="#"><span>{{ Auth::user()->name }}</span>&nbsp;<i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout <i class="bi bi-box-arrow-right"></i></a></li>
            </ul>
          </li>
        </ul>
      </nav>
      @else
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><div style="height: 55px"></div></li>
        </ul>
      </nav>
      <a class="btn-getstarted" href="{{ route('auth.login') }}">Login</a>
      @endauth
    </div>
  </header>

  <main class="main">
    <section id="track" class="track features section light-background">
      <div class="container section-title" data-aos="fade-up" data-aos-delay="100">
       <h1 class="mb-2">
        <br>
        <span class="accent-text"></span>
      </h1>
      </div>

      <div class="section-title mb-0" data-aos="fade-up">
        <h2>Surat Saya</h2>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="d-flex justify-content-center">
          <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#semua">
                <h4>Semua</h4>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#diproses">
                <h4>Diproses</h4>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#dicetak">
                <h4>Dicetak</h4>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#selesai">
                <h4>Selesai</h4>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ditolak">
                <h4>Ditolak</h4>
              </a>
            </li>

          </ul>

        </div>

        <div class="row mb-1">
          @php use Illuminate\Support\Carbon; @endphp
          <div class="col-lg-12 mt-5" data-aos="fade-up" data-aos-delay="100">

            <!-- SEMUA -->
            <div class="tab-content">
              <div class="tab-pane fade active show" id="semua">
              @forelse ($data['letters'] as $l)
                <div class="track-card mb-5">
                  <div class="popular-badge">
                    {{ ($l->status == 'diproses') ? 'Surat sedang ditinjau' : (($l->status == 'dicetak') ? 'Surat dicetak' : (($l->status == 'selesai') ? 'Surat selesai' : 'Surat ditolak')) }}
                  </div>
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <div class="row price">
                        <div class="col-6 currency">
                          <em>{{ collect($data['type'])->firstWhere('id', $l->type_id)->expan ?? null }}</em>
                        </div>
                        <div class="col-6 period" style="text-align: right">Dibuat : {{ $l->created_at->format('Y-m-d, H:i') }} WIB</div>
                      </div>
                      <table class="table table-bordered" style="text-align: left">
                        @if(!is_null($l->research_title))
                        <tr>
                          <td width="250">Judul Penelitian</td>
                          <td>{{ $l->research_title }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>{{ ($l->type_id == '72abf5ba-a1a3-4ba6-8a37-c0c89f6e5527') ? 'Dosen' : 'Koordinator' }}</td>
                          <td>{{ $l->lecturer_name }}</td>
                        </tr>
                        @if(!is_null($l->to))
                        <tr>
                          <td>Kepada</td>
                          <td>{{ $l->to }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td width="250">Nama Mitra</td>
                          <td>{{ $l->company }}</td>
                        </tr>
                        <tr>
                          <td>Alamat Mitra</td>
                          <td>{{ $l->address }}</td>
                        </tr>
                        <tr>
                          <td>{{ (!is_null($l->end_date)) ? 'Tanggal Mulai' : 'Tanggal Pelaksanaan' }}</td>
                          <td>{{ Carbon::parse($l->start_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @if(!is_null($l->end_date))
                        <tr>
                          <td>Tanggal Selesai</td>
                          <td>{{ Carbon::parse($l->end_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>Kebutuhan</td>
                          <td>{{ $l->necessity }}</td>
                        </tr>
                        @if(!is_null($l->excuses))
                        <tr>
                          <td style="color:red;">Alasan Ditolak</td>
                          <td style="color:red;">{{ $l->excuses }}</td>
                        </tr>
                        @endif
                      </table>
                      <div class="row d-flex align-items-center me-auto me-xl-0 mt-2">
                        <div class="col-lg-8"></div>
                        <div class="col-lg-2">@if($l->status == '2')<a href="{{ route('print',$l->id) }}" class="btn btn-primary"><i class="bi bi-printer"></i> Cetak Surat</a>@endif</div>
                        <div class="col-lg-2"><a href="#">Lihat Detail...</a></div>
                      </div>
                    </div>
                  </div>
                </div>

                @empty
                <div class="track-card">
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <p><em><em>Tidak ada data surat yang ditemukan.</em></em></p>
                    </div>
                  </div>
                </div>
                @endforelse
              </div>


              <!-- DIPROSES -->
              <div class="tab-pane fade" id="diproses">
                @forelse ($srtDiproses as $l)
                <div class="track-card mb-5">
                  <div class="popular-badge">Surat sedang ditinjau</div>
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <div class="row price">
                        <div class="col-6 currency">
                          <em>{{ collect($data['type'])->firstWhere('id', $l->type_id)->expan ?? null }}</em>
                        </div>
                        <div class="col-6 period" style="text-align: right">Dibuat : {{ $l->created_at->format('Y-m-d H:i') }}</div>
                      </div>
                      <table class="table table-bordered" style="text-align: left">
                        @if(!is_null($l->research_title))
                        <tr>
                          <td width="250">Judul Penelitian</td>
                          <td>{{ $l->research_title }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>{{ ($l->type_id == '72abf5ba-a1a3-4ba6-8a37-c0c89f6e5527') ? 'Dosen' : 'Koordinator' }}</td>
                          <td>{{ $l->lecturer_name }}</td>
                        </tr>
                        @if(!is_null($l->to))
                        <tr>
                          <td>Kepada</td>
                          <td>{{ $l->to }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td width="250">Nama Mitra</td>
                          <td>{{ $l->company }}</td>
                        </tr>
                        <tr>
                          <td>Alamat Mitra</td>
                          <td>{{ $l->address }}</td>
                        </tr>
                        <tr>
                          <td>{{ (!is_null($l->end_date)) ? 'Tanggal Mulai' : 'Tanggal Pelaksanaan' }}</td>
                          <td>{{ Carbon::parse($l->start_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @if(!is_null($l->end_date))
                        <tr>
                          <td>Tanggal Selesai</td>
                          <td>{{ Carbon::parse($l->end_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>Kebutuhan</td>
                          <td>{{ $l->necessity }}</td>
                        </tr>
                      </table>
                      <div class="row d-flex align-items-center me-auto me-xl-0 mt-2">
                        <div class="col-lg-8"></div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2"><a href="#">Lihat Detail...</a></div>
                      </div>
                    </div>
                  </div>
                </div>

                @empty
                <div class="track-card">
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <p><em>Tidak ada data surat yang ditemukan.</em></p>
                    </div>
                  </div>
                </div>
                @endforelse
              </div>


              <!-- DICETAK -->
              <div class="tab-pane fade" id="dicetak">
                @forelse ($srtDicetak as $l)
                <div class="track-card mb-5">
                  <div class="popular-badge">Surat dicetak</div>
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <div class="row price">
                        <div class="col-6 currency">
                          <em>{{ collect($data['type'])->firstWhere('id', $l->type_id)->expan ?? null }}</em>
                        </div>
                        <div class="col-6 period" style="text-align: right">Dibuat : {{ $l->created_at->format('Y-m-d H:i') }}</div>
                      </div>
                      <table class="table table-bordered" style="text-align: left">
                        @if(!is_null($l->research_title))
                        <tr>
                          <td width="250">Judul Penelitian</td>
                          <td>{{ $l->research_title }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>{{ ($l->type_id == '72abf5ba-a1a3-4ba6-8a37-c0c89f6e5527') ? 'Dosen' : 'Koordinator' }}</td>
                          <td>{{ $l->lecturer_name }}</td>
                        </tr>
                        @if(!is_null($l->to))
                        <tr>
                          <td>Kepada</td>
                          <td>{{ $l->to }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td width="250">Nama Mitra</td>
                          <td>{{ $l->company }}</td>
                        </tr>
                        <tr>
                          <td>Alamat Mitra</td>
                          <td>{{ $l->address }}</td>
                        </tr>
                        <tr>
                          <td>{{ (!is_null($l->end_date)) ? 'Tanggal Mulai' : 'Tanggal Pelaksanaan' }}</td>
                          <td>{{ Carbon::parse($l->start_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @if(!is_null($l->end_date))
                        <tr>
                          <td>Tanggal Selesai</td>
                          <td>{{ Carbon::parse($l->end_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>Kebutuhan</td>
                          <td>{{ $l->necessity }}</td>
                        </tr>
                      </table>
                      <div class="row d-flex align-items-center me-auto me-xl-0 mt-2">
                        <div class="col-lg-8"></div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2"><a href="#">Lihat Detail...</a></div>
                      </div>
                    </div>
                  </div>
                </div>

                @empty
                <div class="track-card">
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <p><em>Tidak ada data surat yang ditemukan.</em></p>
                    </div>
                  </div>
                </div>
                @endforelse
              </div>


              <!-- SELESAI -->
              <div class="tab-pane fade" id="selesai">
                @forelse ($srtSelesai as $l)
                <div class="track-card mb-5">
                  <div class="popular-badge">Surat selesai</div>
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <div class="row price">
                        <div class="col-6 currency">
                          <em>{{ collect($data['type'])->firstWhere('id', $l->type_id)->expan ?? null }}</em>
                        </div>
                        <div class="col-6 period" style="text-align: right">Dibuat : {{ $l->created_at->format('Y-m-d H:i') }}</div>
                      </div>
                      <table class="table table-bordered" style="text-align: left">
                        @if(!is_null($l->research_title))
                        <tr>
                          <td width="250">Judul Penelitian</td>
                          <td>{{ $l->research_title }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>{{ ($l->type_id == '72abf5ba-a1a3-4ba6-8a37-c0c89f6e5527') ? 'Dosen' : 'Koordinator' }}</td>
                          <td>{{ $l->lecturer_name }}</td>
                        </tr>
                        @if(!is_null($l->to))
                        <tr>
                          <td>Kepada</td>
                          <td>{{ $l->to }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td width="250">Nama Mitra</td>
                          <td>{{ $l->company }}</td>
                        </tr>
                        <tr>
                          <td>Alamat Mitra</td>
                          <td>{{ $l->address }}</td>
                        </tr>
                        <tr>
                          <td>{{ (!is_null($l->end_date)) ? 'Tanggal Mulai' : 'Tanggal Pelaksanaan' }}</td>
                          <td>{{ Carbon::parse($l->start_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @if(!is_null($l->end_date))
                        <tr>
                          <td>Tanggal Selesai</td>
                          <td>{{ Carbon::parse($l->end_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>Kebutuhan</td>
                          <td>{{ $l->necessity }}</td>
                        </tr>
                      </table>
                      <div class="row d-flex align-items-center me-auto me-xl-0 mt-2">
                        <div class="col-lg-8"></div>
                        <div class="col-lg-2"><a href="{{ route('print',$l->id) }}" class="btn btn-primary"><i class="bi bi-printer"></i> Cetak Surat</a></div>
                        <div class="col-lg-2"><a href="#">Lihat Detail...</a></div>
                      </div>
                    </div>
                  </div>
                </div>

                @empty
                <div class="track-card">
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <p><em>Tidak ada data surat yang ditemukan.</em></p>
                    </div>
                  </div>
                </div>
                @endforelse
              </div>


              <!-- DITOLAK -->
              <div class="tab-pane fade" id="ditolak">
                @forelse ($srtDitolak as $l)
                <div class="track-card mb-5">
                  <div class="popular-badge">Surat ditolak</div>
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <div class="row price">
                        <div class="col-6 currency">
                          <em>{{ collect($data['type'])->firstWhere('id', $l->type_id)->expan ?? null }}</em>
                        </div>
                        <div class="col-6 period" style="text-align: right">Dibuat : {{ $l->created_at->format('Y-m-d H:i') }}</div>
                      </div>
                      <table class="table table-bordered" style="text-align: left">
                        @if(!is_null($l->research_title))
                        <tr>
                          <td width="250">Judul Penelitian</td>
                          <td>{{ $l->research_title }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>{{ ($l->type_id == '72abf5ba-a1a3-4ba6-8a37-c0c89f6e5527') ? 'Dosen' : 'Koordinator' }}</td>
                          <td>{{ $l->lecturer_name }}</td>
                        </tr>
                        @if(!is_null($l->to))
                        <tr>
                          <td>Kepada</td>
                          <td>{{ $l->to }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td width="250">Nama Mitra</td>
                          <td>{{ $l->company }}</td>
                        </tr>
                        <tr>
                          <td>Alamat Mitra</td>
                          <td>{{ $l->address }}</td>
                        </tr>
                        <tr>
                          <td>{{ (!is_null($l->end_date)) ? 'Tanggal Mulai' : 'Tanggal Pelaksanaan' }}</td>
                          <td>{{ Carbon::parse($l->start_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @if(!is_null($l->end_date))
                        <tr>
                          <td>Tanggal Selesai</td>
                          <td>{{ Carbon::parse($l->end_date)->locale('id')->translatedFormat('d F Y') }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>Kebutuhan</td>
                          <td>{{ $l->necessity }}</td>
                        </tr>
                        <tr>
                          <td style="color:red;">Alasan Ditolak</td>
                          <td style="color:red;">{{ $l->excuses }}</td>
                        </tr>
                      </table>
                      <div class="row d-flex align-items-center me-auto me-xl-0 mt-2">
                        <div class="col-lg-8"></div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2"><a href="#">Lihat Detail...</a></div>
                      </div>
                    </div>
                  </div>
                </div>

                @empty
                <div class="track-card">
                  <div class="row">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                      <p><em>Tidak ada data surat yang ditemukan.</em></p>
                    </div>
                  </div>
                </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer id="footer" class="footer">
    <div class="container copyright text-center">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">JTI Surat</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Distributed by <a href="https://jti.polije.ac.id/">JTI Polije</a>
      </div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/landing/vendor/aos/aos.js"></script>
  <script src="assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/landing/js/main.js"></script>

</body>

</html>