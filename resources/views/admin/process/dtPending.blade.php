@extends('admin.layouts.layout')
@section('title', 'Data Surat Masuk')
@section('content')
<div class="nxl-content nxl-content d-flex flex-column min-vh-100">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover" id="proposalList">
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
                                    @if($l->status == 'diproses')
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
                                                <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#proposalSent">
                                                    <i class="feather feather-send"></i>
                                                </a>
                                                <a href="proposal-view.html" class="avatar-text avatar-md">
                                                    <i class="feather feather-eye"></i>
                                                </a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="proposal-edit.html">
                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                                <i class="feather feather-printer me-3"></i>
                                                                <span>Print</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                <i class="feather feather-clock me-3"></i>
                                                                <span>Remind</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                <i class="feather feather-archive me-3"></i>
                                                                <span>Archive</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                <i class="feather feather-alert-octagon me-3"></i>
                                                                <span>Report Spam</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                <i class="feather feather-trash-2 me-3"></i>
                                                                <span>Delete</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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