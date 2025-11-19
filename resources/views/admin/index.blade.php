@extends('admin.layouts.layout')
@section('title', 'Dashboard')
@section('content')
<section class="content-header">
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
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card col-lg-12 col-md-12">
      <div class="card-header">
        <h3 class="card-title">
          Dashboard
        </h3>
      </div>
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
@endsection