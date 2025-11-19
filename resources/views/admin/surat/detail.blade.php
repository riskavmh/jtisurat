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
              <div class="card-header">
                <h3 class="card-title">Detail Surat</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table text-nowrap">
                  <thead class="bg-primary">
                    <tr>
                      <th colspan="2">Data Mahasiswa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>NIM</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Nama Mahasiswa</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Prodi</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>No Telp</td>
                      <td>John Doe</td>
                    </tr>
                  </tbody>
                </table>

                <table class="table text-nowrap">
                  <thead class="bg-primary">
                    <tr>
                      <th colspan="2">Dosen Pembimbing</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Koordinator</td>
                      <td>John Doe</td>
                    </tr>
                  </tbody>
                </table>

                <table class="table text-nowrap">
                  <thead class="bg-primary">
                    <tr>
                      <th colspan="2">Data Surat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Judul Penelitian</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Jenis Surat</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Kepada</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Nama Mitra</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Tanggal Dibuat</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Tanggal Pelaksanaan</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Kebutuhan</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>John Doe</td>
                    </tr>
                    <tr>
                      <td>Status Surat</td>
                      <td><span class="bg-warning pt-1 pb-1 pl-2 pr-2 rounded"><strong>Surat diproses</strong></span></td>
                    </tr>
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
                      <td>No</td>
                      <td>Nama Anggota</td>
                      <td>NIM</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>John Doe</td>
                      <td>E31192024</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
               <div class="card-footer p-3">
                <a class="btn btn-info mr-2" href="/detailSrt">Kembali</a>
                <a href="#!" class="btn btn-success" onclick= "konfirmasi_modal('')"> Konfirmasi</a>
                <form action="" method="post" class="mt-4">
                  <label><strong>Alasan Surat Ditolak :</strong></label>
                  <input type="text" name="alasan" class="form-control mb-2" maxlength="250" title="Maksimal 250 karakter" required>
                  <a href="#!" class="btn btn-danger" onclick= "konfirmasi_modal('')">Tolak</a>
                </form>
               </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection