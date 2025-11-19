@extends('admin.layouts.layout')
@section('title', 'Jenis Surat')

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
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Ubah Data</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="jenis">Jenis Surat</label>
            <input type="text" name="nama" class="form-control form-control-border border-width-2" minlength="2" maxlength="10" value="{{ old('jenis', $jenis->nama) }}" required>
          </div>
          <div class="form-group mb-5">
            <label for="ket">Keterangan</label>
            <input type="text" name="ket" class="form-control form-control-border border-width-2" minlength="5" maxlength="50" value="{{ old('ket', $jenis->ket) }}" required>
          </div>
          <a class="btn btn-info mr-2" href="{{ route('jenis.index') }}">Kembali</a>
          <button type="reset" class="btn btn-warning text-white mr-2">Reset</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection