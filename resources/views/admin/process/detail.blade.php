@extends('admin.layouts.layout')
@section('title', 'Detail Surat')

@section('script')
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
@endsection

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
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)" class="d-flex me-1" data-alert-target="invoicSendMessage">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Send">
                                    <i class="feather feather-send"></i>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="d-flex me-1 printBTN">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Print"><i class="feather feather-printer"></i></div>
                            </a>
                            <a href="javascript:void(0)" class="d-flex me-1 file-download">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Download"><i class="feather feather-download"></i></div>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('update', $letter->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Data Mahasiswa</th>
                                        </tr>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>No. Telp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $mk = '53a29d29-6ed5-4c96-9266-3703b0c8d3c9';
                                            $ta = '2b1f4b1c-a840-4c72-bf75-e88336edcd13';
                                            $pk = '109cd964-a1e5-47cd-821d-5edf3023f534';
                                            $t  = $letter->type_id; $s = $letter->status;
                                        @endphp
                                        @foreach($letter->members as $member) 
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $member->nim }}</td>
                                            <td>{{ $memberName }}</td>
                                            <td rowspan="{{ $totalMembers }}"></td>
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
                                                    <input type="text" name="ref_no" class="form-control pb-1 pt-1" placeholder="Nomor Surat" autocomplete="off">
                                                </div>
                                                <div class="col-9 pb-1 pt-1">
                                                    <label>PL17.3.5 / PP / {{ date('Y') }}</label>
                                                </div>
                                            </div>
                                            @elseif(($s == 'diproses') && ($letter->necessity == 'eksternal'))
                                            <div class="row">
                                                <div class="col-12 pb-1 pt-1">
                                                    <label><span class="d-inline-block" style="width: 150px;"></span> / PL17 / PP / {{ date('Y') }}</label>
                                                </div>
                                            </div>
                                            @else($s == 'dicetak' || $s == 'selesai')
                                            {{ $letter->ref_no }}
                                            @endif
                                            </td>
                                        </tr>
                                        @if($t == $mk || $t == $ta)
                                        <tr>
                                            <td>Judul Penelitian</td>
                                            <td>{{ $letter->judul }}</td>
                                        </tr>
                                        @endif
                                        @if($t == $mk)
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
                                        @if($t == $pk)
                                        <tr>
                                            <td>Tanggal Selesai</td>
                                            <td>{{ \Carbon\Carbon::parse($letter->end_date)->locale('id')->translatedFormat('d F Y') }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>Kebutuhan</td>
                                            <td>{{ $letter->necessity }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status Surat</td>
                                            <td>
                                                <span class="badge {{ ($s == 'diproses' ? 'bg-warning' : ($s == 'dicetak' ? 'bg-teal' : ($s == 'selesai' ? 'bg-success' : 'bg-danger'))) }} text-light rounded">
                                                    <strong>{{ ($s == 'diproses' ? "Surat Diproses" : ($s == 'dicetak' ? "Surat Dapat Dicetak" : ($s == 'selesai' ? "Surat Selesai" : "Surat Ditolak"))) }}</strong>
                                                </span>
                                            </td>
                                        </tr>
                                        @if($s == 'ditolak')
                                        <tr class="bg-danger">
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
                                                        <a href="{{ route('print',$letter->id) }}" class="btn btn-success" style="padding-left: 2rem; padding-right: 2rem;">Print</a>
                                                        @endif
                                                        @if($s == "diproses")
                                                        <button type="submit" name="action" value="confirm" class="btn btn-success">Konfirmasi</button>
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
                            <!-- <div class="px-4">
                                <div class="alert alert-dismissible p-4 mt-3 alert-soft-warning-message" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <p class="mb-0">
                                        <strong>NOTES:</strong> All accounts are to be paid within 7 days from receipt of invoice. <br>
                                        To be paid by cheque or credit card or direct payment online. <br>
                                        If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.
                                    </p>
                                </div>
                            </div> -->
                            <div class="px-4 pt-4 d-sm-flex align-items-center justify-content-between">
                                <div class="input-group mb-4">
                                    <input type="text" name="excuses" class="form-control" placeholder="Alasan ditolak" maxlength="250" data-bs-toggle="tooltip" data-bs-placement="top" title="Tuliskan alasan ditolak dengan detail" autocomplete="off">
                                    <button type="submit" name="action" value="reject" class="input-group-text bg-danger text-light" onclick="return confirm('Apakah Anda yakin ingin MENOLAK surat ini?');">Tolak</button>
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