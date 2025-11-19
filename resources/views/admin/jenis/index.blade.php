@extends('admin.layouts.layout')
@section('title', 'Jenis Surat')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
#dt_wrapper .dataTables_wrapper .row:first-child {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Jenis Surat</h1>
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
                <th width="100">No</th>
                <th width="200">Jenis</th>
                <th width="500">Keterangan</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($jenis as $j)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $j->nama }}</td>
                  <td>{{ $j->ket }}</td>
                  <td>
                    <a href="{{ route('jenis.edit', $j->id) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" data-id="{{ $j->id }}">Hapus</button>
                  </td>
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


<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apakah Anda Yakin?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-delete" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script>
$(function () {
    $("#dt").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "initComplete": function (settings, json) {
            var headerWrapper = $('#dt_wrapper').find('.row').first();
            var filterDiv = $('#dt_filter').detach();
            var buttonsDiv = $('<div class="dt-buttons"></div>').prependTo(headerWrapper.children('.col-md-6').first());
            buttonsDiv.append(`<a href="{{ route('jenis.create') }}" class="btn btn-primary">Tambah Data</a>`);
            headerWrapper.addClass('d-flex justify-content-between align-items-center');
            headerWrapper.children('.col-md-6').last().append(filterDiv);
        }
    });
});
</script>

<script>
    $('#modal-delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = $(this).find('#form-delete');
        var action = `{{ route('jenis.destroy', ':id') }}`;
        action = action.replace(':id', id);
        form.attr('action', action);
    });
</script>
@endsection