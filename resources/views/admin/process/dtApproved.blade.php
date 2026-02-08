@extends('admin.layouts.layout')
@section('title', 'Data Surat Diterima')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/vendors/css/dataTables.bs5.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('assets/dashboard/vendors/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendors/js/dataTables.bs5.min.js') }}"></script>

<script>
  $(function () {
    $("#pendingLetter").DataTable({
      "paging": true, "lengthChange": true, "autoWidth": true,
      "searching": true, "ordering": true, "responsive": true,
    });
  });
</script>
@endsection

@section('content')
<div class="nxl-content nxl-content d-flex flex-column min-vh-100">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover" id="pendingLetter">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Jenis Surat</th>
                                        <th>Nama Mitra</th>
                                        <th>Tanggal Dibuat</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($letters as $l)
                                    @if($l->status == 'dicetak')
                                    <tr class="single-item">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $l->leader_nim }}</td>
                                        <td>{{ collect($data['type'])->firstWhere('id', $l->type_id)->abbr ?? null }}</td>
                                        <td>{{ $l->company }}</td>
                                        <td>{{ $l->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</td>
                                        <!-- <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('detail', $l->id) }}">Detail</a>
                                        </td> -->
                                        <td>
                                            <div class="hstack gap-2 justify-content-end">
                                                <!-- <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-placement="top" title="kirim">
                                                    <i class="feather feather-send"></i>
                                                </a> -->
                                                <a href="{{ route('detail', $l->id) }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-placement="top" title="detail">
                                                    <i class="feather feather-info"></i>
                                                </a>
                                                <a href="{{ route('print', $l->id) }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-placement="top" title="print">
                                                    <i class="feather feather-printer"></i>
                                                </a>
                                            </div>
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
    </div>
</div>
@endsection

