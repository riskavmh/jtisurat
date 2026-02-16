@extends('admin.layouts.layout')
@section('title', 'Data Jenis Surat')

@section('content')
<div class="nxl-content">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <!-- <hr class="mt-0"> -->
                    <div class="card-body general-info">
                        <div class="mb-5 d-flex align-items-center justify-content-between">
                            <a href="{{ route('type.index') }}" class="btn btn-secondary"><strong>Kembali</strong></a>
                            <h5 class="fw-bold mb-0 me-4 text-end">
                                <span class="d-block mb-2">Masukkan Data Jenis Surat</span>
                                <!-- <span class="fs-12 fw-normal text-muted text-truncate-1-line">Harap isi dengan sesuai.</span> -->
                            </h5>
                        </div>
                        <hr class="mb-5">
                        <form action="{{ route('type.update', $type->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="abbr" class="fw-semibold">Singkatan: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="abbr" id="abbr" placeholder="Singkatan" value="{{ old('abbr', $type->abbr) }}" minlength="2" maxlength="10" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="expan" class="fw-semibold">Keterangan: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="expan" id="expan" placeholder="Keterangan" value="{{ old('expan', $type->expan) }}" minlength="5" maxlength="50" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label class="fw-semibold">Status: </label>
                            </div>
                            <div class="col-lg-10">
                                <select class="form-control" data-select2-selector="status" name="status">
                                    <option value="active" {{ old('status', $type->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $type->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-10"></div>
                            <div class="col-lg-2 d-flex align-items-center justify-content-end gap-2">
                                <button type="submit" class="btn btn-success col-12"><strong>Ajukan</strong></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection