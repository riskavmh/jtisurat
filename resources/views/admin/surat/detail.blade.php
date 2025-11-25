@extends('admin.layouts.layout')
@section('title', 'Detail Surat')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Detail Surat</a></li>
              <!-- <li class="breadcrumb-item active">Simple Tables</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">Detail Surat</h3>
              </div> -->
              <form action="{{ route('update', $surat->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body table-responsive p-0">
                  <table class="table text-nowrap">
                    <thead class="bg-primary">
                      <tr>
                        <th colspan="2">Data Mahasiswa</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td width="25%">NIM</td>
                        <td>{{ $surat->nim }}</td>
                      </tr>
                      <tr>
                        <td>Nama Mahasiswa</td>
                        <td>{{ $surat->nama }}</td>
                      </tr>
                      <tr>
                        <td>Prodi</td>
                        <td>D-III Manajemen Informatika</td>
                      </tr>
                      <tr>
                        <td>No Telp</td>
                        <td>081234567890</td>
                      </tr>
                    </tbody>
                  </table>

                  <table class="table text-nowrap dtlSurat">
                    <thead class="bg-primary">
                      <tr>
                        <th colspan="2">Dosen Pembimbing</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="dosen" width="25%">Dosen</td>
                        <td>{{ $dosen->NAMA_DOSEN }}</td>
                      </tr>
                    </tbody>
                  </table>

                  <table class="table text-nowrap dtlSurat">
                    <thead class="bg-primary">
                      <tr>
                        <th colspan="2">Data Surat</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $j = $surat->jenis; $s = $surat->status; @endphp
                      <tr>
                        <td>Nomor Surat</td>
                        <td>
                          @if($s == 1)
                          <div class="row">
                            <div class="col-2">
                              <input type="text" name="no_surat" class="form-control" placeholder="Nomor Surat">
                            </div>
                            <div class="col-9">
                              <label>{{ $surat->kebutuhan == 'Eksternal' ? 'PL17' : 'PL17.3.5'}} / PP / {{ date('Y') }}</label>
                            </div>
                          </div>
                          @else($s == 2)
                          {{ $surat->no_surat }}
                          @endif
                        </td>
                      </tr>
                      @if($j == "MK" || $j == "TA")
                      <tr>
                        <td>Judul Penelitian</td>
                        <td>{{ $surat->judul }}</td>
                      </tr>
                      @endif
                      @if($j == "MK")
                      <tr>
                        <td>Mata Kuliah</td>
                        <td>John Doe</td>
                      </tr>
                      @endif
                      <tr>
                        <td width="25%">Jenis Surat</td>
                        <td class="jenis">{{ $surat->jenis }}</td>
                      </tr>
                      <tr>
                        <td>Kepada</td>
                        <td>{{ $surat->kepada }}</td>
                      </tr>
                      <tr>
                        <td>Nama Mitra</td>
                        <td>{{ $surat->mitra }}</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>{{ $surat->alamat }}, {{ $surat->kecamatan }}, {{ $surat->kabupaten }}, {{ $surat->provinsi }}</td>
                      </tr>
                      <tr>
                        <td class="start_date">Tanggal Mulai</td>
                        <td>{{ \Carbon\Carbon::parse($surat->start)->locale('id')->translatedFormat('d F Y') }}</td>
                      </tr>
                      @if($j == "PK")
                      <tr>
                        <td>Tanggal Selesai</td>
                        <td>{{ \Carbon\Carbon::parse($surat->end)->locale('id')->translatedFormat('d F Y') }}</td>
                      </tr>
                      @endif
                      <tr>
                        <td>Kebutuhan</td>
                        <td>{{ $surat->kebutuhan }}</td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>{{ $surat->keterangan }}</td>
                      </tr>
                      <tr>
                        <td>Status Surat</td>
                        <td>
                          <span class="{{ ($s == 1 ? 'bg-warning' : ($s == 2 ? 'bg-success' : 'bg-danger') ) }} pt-1 pb-1 pl-2 pr-2 rounded">
                            <strong>{{ ($s == 1 ? "Surat Diproses" : ($s == 2 ? "Surat Selesai" : "Surat Ditolak") ) }}</strong>
                          </span>
                        </td>
                      </tr>
                      @if($s == 3)
                      <tr class="bg-danger">
                        <td>Alasan Surat Ditolak</td>
                        <td>{{ $surat->alasan }}</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>

                  <table class="table text-nowrap">
                    <thead class="bg-primary">
                      <tr>
                        <th colspan="3">Data Anggota</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="text-bold">
                        <td width="15%">No</td>
                        <td>Nama Anggota</td>
                        <td>NIM</td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>{{ $surat->nim }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer p-3">
                  <a class="btn btn-info mr-2" href="{{ url()->previous() }}">Kembali</a>
                  @if($s == 2)
                  <a href="{{ route('print',$surat->id) }}" class="btn btn-success" style="padding-left: 2rem; padding-right: 2rem;">Print</a>
                  @endif
                  @if($s == 1)
                  <button type="submit" name="action" value="confirm" class="btn btn-success">Konfirmasi</button><hr>

                  <!-- <form action="" method="post" class="mt-4"> -->
                    <label><strong>Alasan Surat Ditolak :</strong></label>
                    <input type="text" name="alasan" class="form-control mb-2" maxlength="250" title="Maksimal 250 karakter">
                    <!-- <a href="#!" class="btn btn-danger">Tolak</a> -->
                    <button type="submit" name="action" value="reject" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin MENOLAK surat ini?');">Tolak</button><hr>
                  <!-- </form> -->
                  @endif

                </div>
              </form>
               
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('script')
<script>
  $(document).ready(function() {

      const $row = $(this);
      const jenis = $row.find('.jenis').text().trim().toUpperCase();

      const $dosenElement = $row.find('.dosen');
      const $startDateElement = $row.find('.start_date');

      let dosenText = '';
      let startDateText = '';

      if(jenis === "MK"){
        dosenText = 'Dosen';
        startDateText = 'Tanggal Pelaksanaan';
      }
      else if (jenis === "PK") {
        dosenText = 'Koordinator';
        startDateText = 'Tanggal Mulai';
      }
      else if (jenis === "TA") {
        dosenText = 'Koordinator';
        startDateText = 'Tanggal Pelaksanaan';
      }

      $dosenElement.html(dosenText);
      $startDateElement.html(startDateText);
      
      
  }); 
</script>
@endsection