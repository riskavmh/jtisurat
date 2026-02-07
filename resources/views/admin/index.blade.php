@extends('admin.layouts.layout')
@section('title', 'Dashboard')
@section('content')
<div class="nxl-content d-flex flex-column min-vh-100">
    <div class="main-content">
        <div class="row">
            <!-- [Mini Card] start -->
            <div class="col-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="hstack justify-content-between mb-4 pb-">
                            <div>
                                <h5 class="mb-1">Surat</h5>
                                <!-- <span class="fs-12 text-muted">Rekap Surat</span> -->
                            </div>
                            <!-- <a href="javascript:void(0);" class="btn btn-light-brand">View Alls</a> -->
                        </div>
                        <div class="row">
                            <div class="col-xxl-3 col-lg-6 col-md-6">
                                <div class="card stretch stretch-full border border-dashed border-gray-5">
                                    <div class="card-body rounded-3 text-center">
                                        <i class="bi bi-envelope-plus fs-3 text-warning"></i>
                                        <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ $letterCounts['dtPending'] }}</div>
                                        <p class="fs-14 fw-bold text-muted text-spacing-1 mb-0 text-truncate-1-line">Surat Masuk</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-6 col-md-6">
                                <div class="card stretch stretch-full border border-dashed border-gray-5">
                                    <div class="card-body rounded-3 text-center">
                                        <i class="bi bi-envelope-heart fs-3 text-teal"></i>
                                        <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ $letterCounts['dtApproved'] }}</div>
                                        <p class="fs-14 fw-bold text-muted text-spacing-1 mb-0 text-truncate-1-line">Surat Dicetak</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-6 col-md-6">
                                <div class="card stretch stretch-full border border-dashed border-gray-5">
                                    <div class="card-body rounded-3 text-center">
                                        <i class="bi bi-envelope-check fs-3 text-success"></i>
                                        <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ $letterCounts['dtDone'] }}</div>
                                        <p class="fs-14 fw-bold text-muted text-spacing-1 mb-0 text-truncate-1-line">Surat Selesai</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-6 col-md-6">
                                <div class="card stretch stretch-full border border-dashed border-gray-5">
                                    <div class="card-body rounded-3 text-center">
                                        <i class="bi bi-envelope-slash fs-3 text-danger"></i>
                                        <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ $letterCounts['dtRejected'] }}</div>
                                        <p class="fs-14 fw-bold text-muted text-spacing-1 mb-0 text-truncate-1-line">Surat Ditolak</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xxl-12 col-lg-12 col-md-12">
                            <div class="card stretch stretch-full border border-dashed border-gray-5">
                                <div class="card-body rounded-3 text-center">
                                    <i class="bi bi-envelope fs-3 text-primary"></i>
                                    <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ array_sum($letterCounts) }}</div>
                                    <p class="fs-14 fw-bold text-muted text-spacing-1 mb-0 text-truncate-1-line">Total Surat</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection