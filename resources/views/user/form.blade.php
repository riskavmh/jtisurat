<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>JTI Surat</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/fav2.png') }}" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/landing/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/landing/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- <link href="{{ asset('assets/landing/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('assets/landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/landing/css/main.css') }}" rel="stylesheet">
  <style>
    .text-placeholder{
    color: color-mix(in srgb, black, transparent 70%) !important;
    }
    .btn-anggota{
      font-size: 10pt;
      background-color: color-mix(in srgb, gray, var(--default-color) 70%);;
      color: var(--contrast-color);
      padding: 0.3rem 0.8rem;
      border-radius: 0.5rem;
      border: 0;
      display: inline-flex;
      align-items: center;
      transition: 0.3s;
    }
    .btn-anggota:hover {
      background-color: color-mix(in srgb, gray, var(--contrast-color) 10%);
    }
    .btn-del-anggota{
      font-size: 10pt;
      background-color: gray;
      color: var(--contrast-color);
      padding: 0.3rem 0.5rem;
      border-radius: 0.5rem;
      border: 0;
      display: inline-flex;
      align-items: center;
      transition: 0.3s;
    }
    .btn-del-anggota:hover {
      background-color: color-mix(in srgb, gray, var(--contrast-color) 10%);
    }
    .d-none {
      display: none;
    }
  </style>
</head>


<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo JTI Surat" style="height:25px;width:25px;">&nbsp;&nbsp;
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
      <a class="btn-getstart_dateed" href="{{ route('auth.login') }}">Login</a>
      @endauth
      

    </div>
  </header>

  <main class="main">
    <section id="contact" class="contact section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h1 class="mb-3">
            <br>
            <span class="accent-text"></span>
        </h1>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
          <div class="col-lg-12">
            <div class="contact-form" data-aos="fade-up">
              <p><em>Masukkan data dengan sesuai dan benar!</em></p>


              <form action="{{ route('form.store') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                @csrf
                <div class="row gy-4 mb-3 d-flex align-items-center">
                  <label class="col-2 col-form-label">Jenis Surat</label>
                  <div class="col-10">
                    <select class="form-select select2bs4" id="type" name="type" onchange="showInput()" required>
                      <option value="">-</option>
                      @foreach ($jenis as $j)
                      <option value="{{ $j->nama }}">{{ $j->ket }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                
                <div class="row gy-4 mb-3 align-items-center">
                  <label id="lecturer" class="col-2 col-form-label">Koordinator</label>
                  <div class="col-10">
                  <select class="form-select select2bs4" name="lecturer" required>
                    <option value="">-</option>
                    @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer['value'] }}">{{ $lecturer['label'] }}</option>
                    @endforeach
                  </select>
                  </div>
                </div>

                <div id="course" class="row gy-4 mb-3 align-items-center">
                  <label class="col-2 col-form-label">Mata Kuliah</label>
                  <div class="col-10">
                    <input type="text" name="course" class="form-control" placeholder="cth: Workshop Pengembangan Aplikasi">
                  </div>
                </div>

                <div id="research_title" class="row gy-4 mb-3 align-items-center">
                  <label class="col-2 col-form-label">Judul Penelitian</label>
                  <div class="col-10">
                    <input type="text" name="research_title" class="form-control" placeholder="Judul Penelitian">
                  </div>
                </div>

                <div class="row gy-4 mb-3 align-items-center">
                  <label for="to" class="col-2 col-form-label">Kepada</label>
                  <div class="col-10">
                    <input type="text" name="to" class="form-control" placeholder="Cth: Bpk. Mohammad Hatta (kosongi jika tidak perlu)" maxlength="50" title="Maksimal 50 karakter">
                  </div>
                </div>

                <div class="row gy-4 mb-3 align-items-center">
                  <label class="col-2 col-form-label">Nama Mitra</label>
                  <div class="col-10">
                    <input type="text" name="company" class="form-control" placeholder="Cth: Pimpinan PT Hasanah Raya Cipta (sesuaikan dengan jabatan mitra yang dituju)" maxlength="100" title="Maksimal 100 karakter" required>
                  </div>
                </div>

                <div class="row gy-4 mb-3 align-items-center">
                  <label class="col-2 col-form-label">Alamat</label>
                  <div class="col-10">
                    <input type="text" name="address" class="form-control" placeholder="Alamat Instansi" maxlength="100" title="Maksimal 100 karakter" required>
                  </div>
                </div>
                <div class="row gy-4 mb-3 align-items-center">
                  <label class="col-2 col-form-label"></label>
                  <div class="row gy-2 col-10">
                    <div class="col-4">
                      <input type="text" name="subdistrict" class="form-control" placeholder="Kecamatan" maxlength="50" title="Maksimal 50 karakter" required>
                    </div>
                    <div class="col-4">
                      <input type="text" name="regency" class="form-control" placeholder="Kabupaten" maxlength="50" title="Maksimal 50 karakter" required>
                    </div>
                    <div class="col-4">
                      <input type="text" name="province" class="form-control" placeholder="Provinsi" maxlength="50" title="Maksimal 50 karakter" required>
                    </div>
                  </div>
                </div>

                <div class="row gy-4 mb-3 align-items-center">
                  <label id="start_date" class="col-2 col-form-label">Tanggal Mulai</label>
                  <div class="col-10">
                    <input type="date" name="start_date" class="form-control text-placeholder set-min-date" onchange="this.className = this.value ? 'form-control' : 'form-control text-placeholder'">
                  </div>
                </div>

                <div class="row gy-4 mb-3 align-items-center" id="end_date">
                  <label class="col-2 col-form-label">Tanggal Selesai</label>
                  <div class="col-10">
                    <input type="date" name="end_date" class="form-control text-placeholder set-min-date" onchange="this.className = this.value ? 'form-control' : 'form-control text-placeholder'">
                  </div>
                </div>

                <div class="row gy-4 mb-3 align-items-center">
                  <label class="col-2 col-form-label">Kebutuhan</label>
                  <div class="col-10">
                    <select class="form-select" name="necessity" required>
                        <option value="Eksternal">Eksternal (Dilaksanakan di luar kampus)</option>
                        <option value="Internal">Internal (Dilaksanakan di dalam kampus)</option>
                    </select>
                  </div>
                </div>

                <div class="row gy-4 mb-5 align-items-center">
                  <label class="col-2 col-form-label">Keterangan</label>
                  <div class="col-10">
                    <textarea class="form-control" name="note" placeholder="Keterangan untuk admin, tidak ditampilkan pada surat (kosongi jika tidak perlu)" rows="3" maxlength="255"></textarea>
                  </div>
                </div>
                  
                  <h6 class="mb-3"><strong>Data Anggota Kelompok</strong></h6>
                  
                  <div class="row gy-4 mb-3 d-flex align-items-center">
                    <label class="col-2 col-form-label">NIM</label>
                    <div class="col-10">
                      <input type="text" value="{{ $students['nim'] }}" name="nim" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="row gy-4 mb-3 d-flex align-items-center">
                    <label class="col-2 col-form-label">Nama Lengkap</label>
                    <div class="col-10">
                      <input type="text" value="{{ $students['name'] }}" name="name" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="row gy-4 mb-3 d-flex align-items-center">
                    <label class="col-2 col-form-label">Program Studi</label>
                    <div class="col-10">
                      <input type="text" value="{{ $students['study_program']['name'] }}" name="study_program" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="row gy-4 mb-5 d-flex align-items-center">
                    <label class="col-2 col-form-label">No. Telp</label>
                    <div class="col-10">
                      <input type="text" value="-" name="phone_number" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="mt-5 mb-0">
                    <button class="btn-del-anggota"><strong>X</strong></button>
                    <button class="btn-anggota">Tambah Anggota</button>
                  </div>

                  <div class="col-12 text-center mt-5 mb-0">
                    <button type="submit" class="btn">Ajukan Surat</button>
                  </div>
                
              </form>

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

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('assets/landing/plugins/select2/js/select2.full.min.js') }}"></script>
  
  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/landing/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/landing/js/main.js') }}"></script>

  <script src="{{ asset('assets/jquery.js') }}"></script>

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
      
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>

  <script>
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const dateString = `${year}-${month}-${day}`;
    
    $(".set-min-date").attr("min", dateString);
  </script>

  <script>
    function showInput() {
      const type = document.getElementById('type').value;

      const research_title = document.getElementById('research_title');
      const endDate = document.getElementById('end_date');

      const lecturer = document.getElementById('lecturer');
      const start_date = document.getElementById('start_date');

      if(type == "MK"){
        $("#research_title").show();
        $("#course").show();
        $("#end_date").hide();
        $("#lecturer").text("Dosen");
        $("#start_date").text("Tanggal Pelaksanaan");
      }
      else if (type == "PK") {
        $("#research_title").hide();
        $("#course").hide();
        $("#end_date").show();
        $("#lecturer").text("Koordinator");
        $("#start_date").text("Tanggal Mulai");
      }
      else if (type == "TA") {
        $("#research_title").show();
        $("#course").hide();
        $("#end_date").hide();
        $("#lecturer").text("Koordinator");
        $("#start_date").text("Tanggal Pelaksanaan");
      }
    }
  </script>

  <script></script>
</body>

</html>