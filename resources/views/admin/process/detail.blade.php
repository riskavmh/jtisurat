@extends('admin.layouts.layout')
@section('title', 'Detail Surat')

@push('styles')

<style>
    .alert-button {
    font-size: 14px !important; /* Ukuran font lebih kecil */
    padding: 7px 15px !important;
    font-weight: bold;
}
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $("#choose-file").change(function() {
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                var fileName = input.files[0].name;
                $("#choose-file-label").text(fileName);
            } else {
                $("#choose-file-label").text("Upload Scan Surat");
            }
        });
    });
</script>

<script>
  $(document).ready(function() {

      const $row = $(this);
      const type = $row.find('.type').text().trim();

      const $dosenElement = $row.find('.lecturer');
      const $startDateElement = $row.find('.start_date');

      let lecturerText = '';
      let startDateText = '';

      if(type === "Mata Kuliah"){
        lecturerText = 'Data Dosen Pembimbing';
        startDateText = 'Tanggal Pelaksanaan';
      }
      else if (type === "Praktek Kerja Lapang") {
        lecturerText = 'Data Koordinator';
        startDateText = 'Tanggal Mulai';
      }
      else if (type === "Survey Tugas Akhir") {
        lecturerText = 'Data Koordinator';
        startDateText = 'Tanggal Pelaksanaan';
      }

      $dosenElement.html(lecturerText);
      $startDateElement.html(startDateText);
  }); 
</script>

<script>
    $(function() {
        $('.form-konfirmasi').on('submit', function(e) {
            e.preventDefault();
            
            var form = this;
            var action = $(document.activeElement).val();
            var necessity = $(this).data('necessity'); 
            var refNo = $(form).find('.input-ref-no').val();
            var fileScan = $(form).find('.input-file-scan').val();
            var config = {};

            if (action === 'done') {
                if (!fileScan) {
                    showError('File scan surat wajib diunggah sebelum menyelesaikan!');
                    return;
                }
                if (necessity === 'eksternal' && !refNo) {
                    showError('Nomor surat wajib diisi!');
                    return;
                }
                config = {
                    text: "Selesaikan surat ini?",
                    icon: 'question',
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'Ya, Selesai!',
                    reverseButtons: true
                };
            } 
            
            else if (action === 'confirm') {
                if (necessity === 'internal' && !refNo) {
                    showError('Nomor surat wajib diisi!');
                    return;
                }
                config = {
                    text: "Konfirmasi surat ini?",
                    icon: 'warning',
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'Ya, Konfirmasi!',
                    reverseButtons: true
                };
            }

            else if (action === 'reject') {
                var excuses = $(form).find('.input-excuses').val();
                if (!excuses) {
                    showError('Alasan ditolak wajib diisi!');
                    return;
                }
                config = {
                    text: "Tolak surat ini?",
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tolak!'
                };
            }

            Swal.fire({
                ...config,
                width: '350px',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                customClass: {
                    htmlContainer:'fs-16', 
                    confirmButton: 'mx-1 alert-button',
                    cancelButton: 'mx-1 alert-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('<input>').attr({ type: 'hidden', name: 'action', value: action }).appendTo(form);
                    form.submit();
                }
            });

            function showError(message) {
                Swal.fire({
                    icon: 'error',
                    text: message,
                    width: '350px',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#d33',
                    customClass: { htmlContainer:'fs-16', confirmButton: 'alert-button' }
                });
            }
        });
    });
</script>
@endpush

@section('content')
<div class="nxl-content">
    <div class="main-content container-lg">
        <div class="row">
            <div class="col-lg-12">
                <div class="card invoice-container">
                    <div class="card-header">
                        <div>
                            <h2 class="fs-16 fw-700 text-truncate-1-line mb-0 mb-sm-1">Detail Surat</h2>
                        </div>
                        @if($letter->status == 'dicetak' || $letter->status == 'selesai')
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)" class="d-flex me-1" data-alert-target="invoicSendMessage">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Send">
                                    <i class="feather feather-send"></i>
                                </div>
                            </a>
                            <a href="{{ route('print',$letter->id) }}" class="d-flex me-1 printBTN" target="blank">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Print"><i class="feather feather-printer"></i></div>
                            </a>
                            <a href="javascript:void(0)" class="d-flex me-1 file-download">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Download"><i class="feather feather-download"></i></div>
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('update', $letter->id) }}" method="POST" class="form-konfirmasi" enctype="multipart/form-data" data-necessity="{{ $letter->necessity }}">
                        @csrf
                        @method('PATCH')
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Data Mahasiswa</th>
                                        </tr>
                                        <tr  class="text-center">
                                            <th width="5%">No</th>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>No. Telp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $t  = $letter->type_id; $s = $letter->status;
                                        @endphp
                                        @foreach($letter->members as $member) 
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-center">{{ $member->user->identity_no }}</td>
                                            <td>{{ $member->user->name }}</td>
                                            @if($loop->first)
                                            <td rowspan="{{ $totalMembers }}" class="text-center">{{ $dtLeader->leader->user->phone_number ?? null }}</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr class="border-dashed mt-3 mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="lecturer" colspan="2">Data Dosen Pembimbing</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="25%">Nama </td>
                                            <td>{{ $lecturer['label'] ?? null }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr class="border-dashed mt-3 mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Data Surat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="25%">Nomor Surat</td>
                                            <td>
                                            @if(($s == 'diproses') && ($letter->necessity == 'internal'))
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="text" name="ref_no" class="form-control pb-1 pt-1 input-ref-no" placeholder="Nomor Surat" autocomplete="off">
                                                </div>
                                                <div class="col-9 pb-1 pt-1">
                                                    <label> / PL17.3.5 / PP / {{ date('Y') }}</label>
                                                </div>
                                            </div>
                                            @elseif(($s == 'diproses') && ($letter->necessity == 'eksternal'))
                                            <div class="row">
                                                <div class="col-12 pb-1 pt-1">
                                                    <label><span class="d-inline-block" style="width: 150px;"></span> / PL17 / PP / {{ date('Y') }}</label>
                                                </div>
                                            </div>
                                            @elseif(($s == 'dicetak') && ($letter->necessity == 'eksternal'))
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="text" name="ref_no" class="form-control pb-1 pt-1 input-ref-no" placeholder="Nomor Surat" autocomplete="off">
                                                </div>
                                                <div class="col-9 pb-1 pt-1">
                                                    <label> / PL17 / PP / {{ date('Y') }}</label>
                                                </div>
                                            </div>
                                            @else($s == 'dicetak' || $s == 'selesai')
                                            {{ $letter->ref_no }}
                                            @endif
                                            </td>
                                        </tr>
                                        @if($letter->type->abbr === 'TA' || $letter->type->abbr === 'MK')
                                        <tr>
                                            <td>Judul Penelitian</td>
                                            <td>{{ $letter->research_title }}</td>
                                        </tr>
                                        @endif
                                        @if($letter->type->abbr === 'MK')
                                        <tr>
                                            <td>Mata Kuliah</td>
                                            <td>{{ $letter->course }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td width="25%">Jenis Surat</td>
                                            <td class="type">{{ collect($data['type'])->firstWhere('id', $letter->type_id)->expan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kepada</td>
                                            <td>{{ $letter->to ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Mitra</td>
                                            <td>{{ $letter->company }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>{{ $letter->address }}, {{ $letter->subdistrict }}, {{ $letter->regency }}, {{ $letter->province }}</td>
                                        </tr>
                                        <tr>
                                            <td class="start_date">Tanggal Mulai</td>
                                            <td>{{ \Carbon\Carbon::parse($letter->start_date)->locale('id')->translatedFormat('d F Y') }}</td>
                                        </tr>
                                        @if($letter->type->abbr === 'PK')
                                        <tr>
                                            <td>Tanggal Selesai</td>
                                            <td>{{ \Carbon\Carbon::parse($letter->end_date)->locale('id')->translatedFormat('d F Y') }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>Kebutuhan</td>
                                            <td>{{ Str::title($letter->necessity) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status Surat</td>
                                            <td>
                                                <span class="badge {{ ($s == 'diproses' ? 'bg-warning' : ($s == 'dicetak' ? 'bg-teal' : ($s == 'selesai' ? 'bg-success' : 'bg-danger'))) }} text-white rounded">
                                                    <strong>{{ ($s == 'diproses' ? "Surat Diproses" : ($s == 'dicetak' ? "Surat Dapat Dicetak" : ($s == 'selesai' ? "Surat Selesai" : "Surat Ditolak"))) }}</strong>
                                                </span>
                                            </td>
                                        </tr>
                                        @if($s == 'ditolak')
                                        <tr>
                                            <td>Alasan Surat Ditolak</td>
                                            <td>{{ $letter->excuses }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="2">
                                                <div class="row">
                                                    <div class="col-6 d-flex gap-2">
                                                        <a class="btn btn-secondary mr-2" href="{{ url()->previous() }}">Kembali</a>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-end gap-2">
                                                        @if($s == 'dicetak')
                                                        <a href="{{ route('print',$letter->id) }}" class="btn btn-info" style="padding-left: 2rem; padding-right: 2rem;" target="blank">Print</a>
                                                        @endif
                                                        @if($s == "diproses")
                                                        <button type="submit" name="action" value="confirm" class="btn btn-success btn-approve">Konfirmasi</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if($s == "diproses")
                            <hr class="border-dashed mt-0">
                            <div class="px-4 pt-4 d-sm-flex align-items-center justify-content-between">
                                <div class="input-group mb-4">
                                    <input type="text" name="excuses" class="form-control input-excuses" placeholder="Alasan ditolak" maxlength="250" data-bs-toggle="tooltip" data-bs-placement="top" title="Tuliskan alasan ditolak dengan detail" autocomplete="off">
                                    <button type="submit" name="action" value="reject" class="input-group-text bg-danger text-light btn-reject" >Tolak</button>
                                </div>
                            </div>
                            @endif
                            @if($s == "dicetak")
                            <hr class="border-dashed mt-0">
                            <div class="px-4">
                                <div class="alert alert-dismissible p-4 mt-3 alert-soft-warning-message" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <p class="mb-0">
                                        <strong>NOTES:</strong> Format file yang diperboleh adalah <img src="{{ asset('assets/dashboard/images/file-icons/pdf.png') }}" class="img-fluid me-0" style="width: 30px;"> <strong>.pdf</strong><br>
                                        Upload scan surat yang telah dibubuhi nomor surat dan ditandangani oleh pihak yang berwajib.
                                    </p>
                                </div>
                            </div>
                            <div class="px-4 pt-4 align-items-center justify-content-between">
                                <div class="input-group mb-4">
                                    <label for="choose-file" class="form-control d-flex align-items-center m-0 px-3" id="choose-file-label" style="background-color: #f8f9fa; border: 2px dashed #e4e6ef; cursor: pointer; color: #7e8299; box-shadow: none; min-height: 70px;">
                                        Upload Scan Surat
                                    </label>
                                    <input name="scanPath" class="input-file-scan" type="file" id="choose-file" accept="application/pdf" style="display: none">
                                    <button type="submit" name="action" value="done" class="btn btn-success d-flex align-items-center justify-content-center px-4">
                                        Selesai
                                    </button>
                                </div>
                            </div>
                            @endif

                            @if($s == "selesai")
                            <hr class="border-dashed mt-0">
                            <div class="px-4">
                                <div class="mt-4">
                                    <h5>Dokumen Scan Surat:</h5>
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ $scanUrl }}#pagemode=none&view=FitW" width="100%" height="600px" style="border: none;">
                                            <p>Browser Anda tidak mendukung iframe. 
                                            <a href="{{ $scanUrl }}">Klik di sini untuk mengunduh PDF.</a>
                                            </p>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection