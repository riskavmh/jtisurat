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
                                <span class="d-block mb-2">Masukkan Data Format Surat</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Harap isi dengan sesuai.</span>
                            </h5>
                        </div>
                        <form action="{{ route('type.store') }}" method="POST">
                            @csrf
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="fullnameInput" class="fw-semibold">Name: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="fullnameInput" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="mailInput" class="fw-semibold">Email: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mailInput" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="usernameInput" class="fw-semibold">Username: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="url" class="form-control" id="usernameInput" placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="phoneInput" class="fw-semibold">Phone: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="phoneInput" placeholder="Phone">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="companyInput" class="fw-semibold">Company: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="companyInput" placeholder="Company">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="designationInput" class="fw-semibold">Designation: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="designationInput" placeholder="Designation">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="websiteInput" class="fw-semibold">Website: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="websiteInput" placeholder="Website">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="VATInput" class="fw-semibold">VAT: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="VATInput" placeholder="VAT">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="addressInput" class="fw-semibold">Address: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <textarea class="form-control" id="addressInput" cols="30" rows="3" placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label for="descriptionInput" class="fw-semibold">Description: </label>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <textarea class="form-control" id="descriptionInput" cols="30" rows="5" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label class="fw-semibold">Country: </label>
                            </div>
                            <div class="col-lg-10">
                                <select class="form-control" data-select2-selector="country">
                                    <option data-country="af">Afghanistan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-2">
                                <label class="fw-semibold">Status: </label>
                            </div>
                            <div class="col-lg-10">
                                <select class="form-control" data-select2-selector="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
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