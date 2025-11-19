@extends('admin.layouts.layout')
@section('title', 'Data Dosen')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Dosen</h1>
      </div>
      <!-- <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Surat Diproses</a></li>
          <li class="breadcrumb-item active">Surat Masuk</li>
        </ol>
      </div> -->
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-body">
            <table id="dt" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th width="50">No</th>
                <th width="150">NIP</th>
                <th width="450">Nama</th>
                <th width="100">Prodi</th>
                <th>No. HP</th>
                <!-- <th>Aksi</th> -->
              </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($dosen as $d)
                <tr>
                  <td>{{ $no++; }}</td>
                  <td>{{ $d->NIP }}</td>
                  <td>{{ $d->NAMA_DOSEN }}</td>
                  <td>{{ $d->PRODI }}</td>
                  <td>{{ $d->NO_HP }}</td>
                  <!-- <td>
                    <a class="btn btn-warning btn-sm" href="">Edit</a>
                    <a class="btn btn-info btn-sm" href="">Reset Password</a>
                    <a href="#!" class="btn btn-danger btn-sm" onclick= "konfirmasi_modal('')">Hapus</a>
                  </td> -->
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script src="{{ asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(function () {
    $("#dt").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#srtdiproses_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection