@extends('Template.main')

@section('css')
    <link rel="stylesheet" href="/css/datatables/bootstrap.min.css">
    <link rel="stylesheet" href="/css/datatables/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="/css/datatables/dataTables.bootstrap5.min.css">
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

    <h2 class="mt-4">Lihat Bimbingan</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Pencatatan Bimbingan &raquo; Lihat Bimbingan Ke-{{ $bimbingan->pertemuan }}</h5>

    <div class="card-body overflow-auto">
        <div class="col-sm-12">

            {{-- Nama --}}
            <div class="row">
              <div class="col-sm-6 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Nama Lengkap</strong></label>
                <div class="input-group input-group-merge">         
                  <input
                    required
                    readonly
                    class="form-control @error('nama') is-invalid @enderror"
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ $bimbingan->nama }}"
                    
                    aria-describedby="basic-icon-default-company2"
                    required/>
                  @error('nama  ')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror 
                </div>
              </div>

              {{-- NPM --}}
              <div class="col-sm-6 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Nomor Pokok Mahasiswa</strong></label>
                <div class="input-group input-group-merge">         
                  <input
                    required
                    readonly
                    class="form-control @error('npm') is-invalid @enderror"
                    type="number"
                    id="npm"
                    name="npm"
                    value="{{ $bimbingan->npm }}"
                    
                    aria-describedby="basic-icon-default-company2"
                    required/>
                  @error('npm')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror 
                </div>
              </div>
            </div>

            {{-- Tanggal Pengajuan --}}
            <div class="row">
              <div class="col-sm-6 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Tanggal Pengisian</strong></label>
                <div class="input-group input-group-merge"> 
                  <input
                    required
                    readonly
                    class="form-control @error('tanggalpengajuan') is-invalid @enderror"
                    type="date"
                    id="tanggalpengajuan"
                    name="tanggalpengajuan"
                    value="{{ $bimbingan->tanggalpengjuan }}"
                    aria-describedby="basic-icon-default-company2"
                    required/>
                  @error('tanggalpengajuan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              {{-- Kelas --}}
              <div class="col-sm-6 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Kelas</strong></label>
                <div class="input-group input-group-merge">
                  <input
                    readonly
                    required
                    type="text"
                    id="kelas"
                    name="kelas"
                    class="form-control @error('kelas') is-invalid @enderror"
                   
                    aria-describedby="basic-icon-default-company2"
                    value="{{ $bimbingan->kelas }}"
                    required/>
                  @error('kelas')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            

              <div class="col-sm-4 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Program Magang</strong></label>
                <div class="input-group input-group-merge">
                  <input readonly id="programmagang" name="programmagang" class="form-control @error('programmagang') is-invalid @enderror" value="{{ $bimbingan->npm }}" required>
                  @error('programmagang')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-4 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Nama Perusahaan</strong></label>
                <div class="input-group input-group-merge">
                  <input readonly id="namaperusahaan" name="namaperusahaan" class="form-control @error('namaperusahaan') is-invalid @enderror" value="{{ $bimbingan->namaperusahaan }}" required>
                  @error('namaperusahaan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-4 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Posisi Sebagai</strong></label>
                <div class="input-group input-group-merge">
                  <input readonly value="{{ $bimbingan->posisi }}" id="posisi" name="posisi" class="form-control @error('posisi') is-invalid @enderror" required>
                  @error('posisi')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-6 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Nama Pembimbing</strong></label>
                <div class="input-group input-group-merge">
                  <input readonly value="{{ $bimbingan->namapembimbing }}" id="namapembimbing" name="namapembimbing" class="form-control @error('namapembimbing') is-invalid @enderror" required>
                  @error('namapembimbing')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-6 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Pertemuan ke-</strong></label>
                <div class="input-group input-group-merge">
                  <input readonly value="{{ $bimbingan->pertemuan }}" type="number" id="pertemuan" name="pertemuan" class="form-control @error('pertemuan') is-invalid @enderror" required>
                  @error('pertemuan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-6 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Deskripsi Bimbingan</strong></label>
                <div class="input-group input-group-merge">
                    <input readonly value="{{ $bimbingan->deskripsibimbingan }}" rows="20" cols="50" id="deskripsibimbingan" name="deskripsibimbingan" class="form-control @error('deskripsibimbingan') is-invalid @enderror" required/>                     
                  @error('deskripsibimbingan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-6 mb-4">
                <label for="basic-icon-default-company" class="mb-2"><strong>Hasil Bimbingan</strong></label>
                <div class="input-group input-group-merge">
                    <input readonly value="{{ $bimbingan->hasilbimbingan }}" rows="20" cols="50" id="hasilbimbingan" name="hasilbimbingan" class="form-control @error('hasilbimbingan') is-invalid @enderror" required/>                   
                  @error('hasilbimbingan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
        </div>
        
        <div class="row mt-3 justify-content-end">
            <div class="col-sm-2 text-center">
                <a href="{{ url()->previous() }}">
                  <button type="button" class="btn btn-secondary">Kembali</button>
                </a>
            </div>
        </div>
</div>
@endsection


@section('script')

@endsection