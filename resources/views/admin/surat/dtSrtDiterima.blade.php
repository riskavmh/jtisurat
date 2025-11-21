@extends('admin.layouts.layout')
@section('title', 'Surat Dapat Dicetak')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Surat Diterima</h1>
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
          <div class="card-header">
            <h3 class="card-title">Surat Dapat Dicetak</h3>
          </div>
          <div class="card-body">
            <table id="srtdiproses" class="table table-bordered">
              <thead class="text-center bg-primary">
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Jenis Surat</th>
                <th>Nama Mitra</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($surat as $s)
                @if($s->status == 2)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $s->nim }}</td>
                  <td>{{ $s->jenis }}</td>
                  <td>{{ $s->mitra }}</td>
                  <td>{{ $s->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</td>
                  <td>
                    <a class="btn btn-info btn-sm" href="{{ route('detail', $s->id) }}">Detail</a>
                    <a href="{{ route('print',$s->id) }}" class="btn btn-success btn-sm" style="padding-left: 1rem; padding-right: 1rem;">Print</a>
                  </td>
                </tr>
                @endif
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
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

<script>
  $(function () {
    $("#srtdiproses").DataTable({
      "paging": true, "lengthChange": true, "autoWidth": true,
      "searching": true, "ordering": true, "responsive": true,
    });
  });
</script>
@endsection