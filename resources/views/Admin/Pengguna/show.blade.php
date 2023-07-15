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

    <h2 class="mt-4">Edit Data Pengguna</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Edit Pengguna</h5>
    

    @if (session()->has('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    <div class="card-body overflow-auto">
        <form class="forms-sample" method="POST" action="{{ url('data-pengguna/update', $pengguna->id) }}">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3 row" id="-email">
                        <label for="inputPassword" class="col-sm-2 col-form-label mb-3">Pilih Role</label>
                        <div class="col-sm-4 mb-3">
                            <select readonly required id="roles" class="form-control roles @error('roles') is-invalid @enderror" name="roles" aria-label="Default select example">
                                <option <?= ($pengguna->roles == 'ADMIN') ? 'selected' : '' ?> value="ADMIN">Pendidikan (Admin)</option>
                                <option <?= ($pengguna->roles == 'PEMBIMBING') ? 'selected' : '' ?> value="PEMBIMBING">Pembimbing</option>
                                <option <?= ($pengguna->roles == 'USER') ? 'selected' : '' ?> value="USER">Mahasiswa</option>
                            </select>
                            @error('roles')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="inputPassword" class="nama col-sm-2 col-form-label">Nama lengkap</label>
                        <div class="col-sm-4 nama">
                            <input readonly type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $pengguna->name }}">
                            @error('name')
                                <div class="invalid-feedback nama">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="inputPassword" class="noHP col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-4 noHP">
                            <input readonly required type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $pengguna->no_hp }}">
                            @error('no_hp')
                                <div class="invalid-feedback noHP">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="inputPassword" class="mb-3 col-sm-2 col-form-label email">Email</label>
                        <div class="col-sm-4 email">
                            <input readonly required type="email" class="mb-3 form-control @error('email') is-invalid @enderror" value="{{ $pengguna->email }}" name="email" autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="inputPassword" class="mb-3 col-sm-2 col-form-label fakultas">Fakultas</label>
                        <div class="col-sm-4 fakultas_id">
                            <input readonly required type="fakultas_id" class="mb-3 form-control @error('fakultas_id') is-invalid @enderror" value="{{ $pengguna->fakultas_id }}" name="fakultas_id" autocomplete="fakultas_id">
                            @error('fakultas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="inputPassword" class="mb-3 col-sm-2 col-form-label email">Email</label>
                        <div class="col-sm-4 email">
                            <input readonly required type="email" class="mb-3 form-control @error('email') is-invalid @enderror" value="{{ $pengguna->email }}" name="email" autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="inputPassword" class="mb-3 col-sm-2 col-form-label email">Email</label>
                        <div class="col-sm-4 email">
                            <input readonly required type="email" class="mb-3 form-control @error('email') is-invalid @enderror" value="{{ $pengguna->email }}" name="email" autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-end">
                        <div class="col-sm-3 text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

<script src="/js/datatables/jquery-3.5.1.js"></script>

@endsection
