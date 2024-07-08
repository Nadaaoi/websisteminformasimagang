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

    <h2 class="mt-4">Tambah Data Fakultas</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Manajemen Fakultas &raquo; Tambah Data Fakultas</h5>

    <div class="card-body overflow-auto">
        <form class="forms-sample" method="POST" action="{{ route('data-fakultas.store') }}">
          @csrf
          <div class="row">
            <div class="col-sm-12">
              <div class="mb-3 row" id="-email">
                <label for="inputPassword" class="fakultas col-sm-2 col-form-label">Fakultas</label>
                <div class="col-sm-4 fakultas">
                  <input required type="text" class="form-control @error('fakultas') is-invalid @enderror" id="fakultas" name="fakultas" value="{{ old('fakultas') }}">
                  @error('fakultas')
                  <div class="invalid-feedback fakultas">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <label for="inputPassword" class="ketua_fakultas col-sm-2 col-form-label">Nama Ketua Fakultas</label>
                <div class="col-sm-4 ketua_fakultas">
                  <input required type="text" class="form-control @error('ketua_fakultas') is-invalid @enderror" id="ketua_fakultas" name="ketua_fakultas" value="{{ old('ketua_fakultas') }}">
                  @error('ketua_fakultas')
                  <div class="invalid-feedback ketua_fakultas">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="row mt-4 justify-content-end">
                <div class="col-sm-3 text-center">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                  <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      Kembali
                    </button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    
@endsection

@section('script')

@endsection