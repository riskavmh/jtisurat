@extends('admin.layouts.layout')
@section('title', 'Data Jenis Surat')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/vendors/css/dataTables.bs5.min.css') }}">

<style>
#dt_wrapper .dataTables_wrapper .row:first-child {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
@endsection

@section('script')
<script src="{{ asset('assets/dashboard/vendors/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendors/js/dataTables.bs5.min.js') }}"></script>

<script>
$(function () {
    $("#letterType").DataTable({
        "responsive": true,
        "autoWidth": false,
        "dom": "<'row'<'col-sm-12 col-md-1'<'#btn-place'>><'col-sm-12 col-md-11'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'l>" + 
               "<'col-sm-12 col-md-8 d-flex align-items-center justify-content-end gap-4'i p>>",
        "initComplete": function (settings, json) {
            $("#btn-place").html('<a href="{{ route("type.create") }}" class="btn btn-primary btn-block">Tambah Data</a>');
            $('.dataTables_length select').addClass('form-select form-select-sm');
        }
    });
});
</script>

<script>
    $('#modal-delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = $(this).find('#form-delete');
        var action = `{{ route('type.destroy', ':id') }}`;
        action = action.replace(':id', id);
        form.attr('action', action);
    });
</script>
@endsection

@section('content')
<div class="nxl-content d-flex flex-column min-vh-100">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover" id="letterType">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Surat</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($type as $t)
                                    <tr class="single-item">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $t->abbr }}</td>
                                        <td>{{ $t->expan }}</td>
                                        <td><span class="badge {{ $t->status == 'active' ? 'bg-soft-success text-success' : 'bg-gray-200 text-secondary' }}">{{ $t->status }}<span class="badge bg-soft-success text-success"></td>
                                        <td>
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{ route('type.edit', $t->id) }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                    <i class="feather feather-edit"></i>
                                                </a>
                                                <a href="{{ route('type.destroy', $t->id) }}" class="avatar-text avatar-md text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="hapus" data-bs-target="#modal-delete" data-id="{{ $t->id }}">
                                                    <i class="feather feather-trash-2"></i>
                                                </a>
                                            </div>
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
    </div>
</div>
@endsection

