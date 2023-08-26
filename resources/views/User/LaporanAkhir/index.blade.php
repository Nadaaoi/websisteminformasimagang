@extends('Template.main')

@section('css')
<link rel="stylesheet" href="/css/datatables/bootstrap.min.css">
<link rel="stylesheet" href="/css/datatables/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="/css/datatables/dataTables.bootstrap5.min.css">
<style>
  .fs-x {
    font-size: smaller;
    padding: 2px 12px;
  }
</style>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning">
    {{ session('warning') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('laporanakhir.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
@if($pemagangan->isNotEmpty())
    @foreach($pemagangan as $item)
        <input type="hidden" value="{{ $item->nama }}" id="nama" name="nama"/>
        <input type="hidden" value="{{ $item->npm }}" id="NPM" name="NPM"/>
        <input type="hidden" value="{{ $item->namapembimbing }}" id="namapembimbing" name="namapembimbing"/>
    @endforeach
@endif


<div class="row">
  <div class="col-md-4">
    <div class="card mb-3">
      <div class="card-header">
        Upload Laporan Akhir
      </div>
      <div class="card-body">
        <h5 class="card-title">Laporan Akhir Mahasiswa</h5>
        <p class="card-text">Upload laporan akhir kerja praktik mu dibawah ini</p>
        <div class="input-group input-group-merge">
          <input
          required
            type="file"
            id="laporanakhir"
            name="laporanakhir"
            class="form-control @error('laporanakhir') is-invalid @enderror"
            aria-describedby="basic-icon-default-company2"
            readonly
          />
          @error('laporanakhir')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card mb-3">
      <div class="card-header">
        Upload Sertifikat
      </div>
      <div class="card-body">
        <h5 class="card-title">Sertifikat Mahasiswa</h5>
        <p class="card-text">Upload sertifikat kerja praktik mu dibawah ini</p>
        <div class="input-group input-group-merge">
          <input
          required
            type="file"
            id="sertifikat"
            name="sertifikat"
            class="form-control @error('sertifikat') is-invalid @enderror"
            aria-describedby="basic-icon-default-company2"
            readonly
          />
          @error('sertifikat')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card mb-3">
      <div class="card-header">
        Upload Nilai
      </div>
      <div class="card-body">
        <h5 class="card-title">Nilai Kerja Praktik Mahasiswa</h5>
        <p class="card-text">Upload penilaian kerja praktik mu dibawah ini</p>
        <div class="input-group input-group-merge">
          <input
          required
            type="file"
            id="nilai"
            name="nilai"
            class="form-control @error('nilai') is-invalid @enderror"
            aria-describedby="basic-icon-default-company2"
            readonly
          />
          @error('nilai')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-5 justify-content-end">
    <div class="col-sm-3 text-center">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url()->previous() }}">
          <button type="button" class="btn btn-secondary">Kembali</button>
        </a>
    </div>
</div>
</div>
<input type="hidden" value="Sudah Upload" id="status_laporan" name="status_laporan"/>
</form>

@endsection
