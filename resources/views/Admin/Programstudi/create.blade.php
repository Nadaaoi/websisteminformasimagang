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

    <h2 class="mt-4">Data Program Studi</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Tambah Program Studi</h5>

    <div class="card-body overflow-auto">
        <form class="forms-sample" method="POST" action="{{ route('data-programstudi.store') }}">
          @csrf
          <div class="row">
            <div class="col-sm-12">
              <div class="mb-3 row" id="-email">
                <label for="inputPassword" class="programstudi col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-4 programstudi">
                  <input required type="text" class="form-control @error('programstudi') is-invalid @enderror" id="programstudi" name="programstudi" value="{{ old('programstudi') }}">
                  @error('programstudi')
                  <div class="invalid-feedback programstudi">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <label for="inputPassword" class="kajur col-sm-2 col-form-label">Nama Ketua Jurusan</label>
                <div class="col-sm-4 kajur">
                  <input required type="text" class="form-control @error('kajur') is-invalid @enderror" id="kajur" name="kajur" value="{{ old('kajur') }}">
                  @error('kajur')
                  <div class="invalid-feedback kajur">
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