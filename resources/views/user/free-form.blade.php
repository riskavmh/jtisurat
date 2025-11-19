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
  <link href="{{ asset('assets/landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/landing/css/main.css') }}" rel="stylesheet">

  <style>
    .note-editable p {
      margin-bottom: 1em !important;
      color: rgb(0, 0, 0) !important;
    }
    .note-editable {
      font-family: 'Times New Roman';
      line-height: 1.15 !important;
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

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><div style="height: 55px"></div></li>
          <li class="dropdown"><a href="#"><span>Riska Virliana Maharanti H</span>&nbsp;<i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Logout <i class="bi bi-box-arrow-right"></i></a></li>
            </ul>
          </li>
        </ul>
      </nav>

      <!-- <a class="btn-getstarted" href="">Login</a> -->
      

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
              
              <form action="{{ route('surat.store') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                @csrf
                  <textarea id="form" name="form"></textarea>

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

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/landing/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/pure-counter@2.0.3/dist/js/pure-counter.js"></script> -->
  <script src="{{ asset('assets/landing/js/main.js') }}"></script>
  <script src="{{ asset('assets/jquery.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <script>
    $(document).ready(function() {
        $('#form').summernote({
            placeholder: 'Tulis Surat Anda di sini...',
            tabsize: 2,
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']]
            ]
        });
    });
  </script>
</body>

</html>