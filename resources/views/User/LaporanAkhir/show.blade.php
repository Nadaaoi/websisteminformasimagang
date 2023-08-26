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
          <tr>
            <td><a target="_blank" href="{{ asset('storage/' . $us[0]->laporanakhir) }} ">
              {{ $us[0]->nama }}-laporanakhir.pdf</a></td>
          </tr>
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
          <tr>
            <td><a target="_blank" href="{{ asset('storage/' . $us[0]->sertifikat) }} ">
              {{ $us[0]->nama }}-Sertifikat.pdf</a></td>
          </tr>
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
          <tr>
            <td><a target="_blank" href="{{ asset('storage/' . $us[0]->nilai) }} ">
              {{ $us[0]->nama }}-Nilai.pdf</a></td>
          </tr>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
