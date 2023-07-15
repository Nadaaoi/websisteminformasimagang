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
                            <select required id="roles" class="form-control roles @error('roles') is-invalid @enderror" name="roles" aria-label="Default select example">
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
                            <input required type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $pengguna->name }}">
                            @error('name')
                                <div class="invalid-feedback nama">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="inputPassword" class="noHP col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-4 noHP">
                            <input required type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $pengguna->no_hp }}">
                            @error('no_hp')
                                <div class="invalid-feedback noHP">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="inputPassword" class="mb-3 col-sm-2 col-form-label email">Email</label>
                        <div class="col-sm-4 email">
                            <input required type="email" class="mb-3 form-control @error('email') is-invalid @enderror" value="{{ $pengguna->email }}" name="email" autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label for="inputPassword" id="labelfakultas" style="display: none;" class="labelfakultas col-sm-2 col-form-label">Fakultas</label>
                        <div class="col-sm-4">
                            <select style="display: none;" id="fakultas_id" class="form-control roles @error('fakultas_id') is-invalid @enderror" name="fakultas_id" aria-label="Default select example">
                                <option selected value="" id="fakultas" value="">Pilih Fakultas</option>
                                @foreach ($fakultas as $u)
                                    <option <?= ($pengguna->fakultas_id == $u->id) ? 'selected' : '' ?> value="{{ $u->id }}">{{ $u->fakultas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="inputPassword" id="labelprogramstudi" style="display: none;" class="labelprogramstudi mb-3 col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-4">
                            <select style="display: none;" id="programstudi" class="form-control roles @error('programstudi') is-invalid @enderror" name="programstudi" aria-label="Default select example">
                                <option selected value="" id="programstudi" value="">Pilih Program Studi</option>
                                @foreach ($programstudi as $u)
                                    <option <?= ($pengguna->programstudi_id == $u->id) ? 'selected' : '' ?> value="{{ $u->id }}">{{ $u->programstudi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="inputPassword" id="labelnpm" style="display: none;" class="mb-3 col-sm-2 col-form-label npm">NPM</label>
                        <div class="col-sm-4">
                            <input id="npm" style="display: none;" type="text" class="mb-3 form-control @error('npm') is-invalid @enderror" value="{{ $pengguna->npm }}" name="npm" autocomplete="npm">
                            @error('npm')
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
<script>
  
const roles = document.getElementById('roles');
const labelprogramstudi = document.getElementById('labelprogramstudi');
const programstudi = document.getElementById('programstudi');

roles.addEventListener('change', function() {
    if (roles.value === 'USER') {
        labelprogramstudi.style.display = 'block';
        programstudi.style.display = 'block';
        labelnpm.style.display = 'block';
        npm.style.display = 'block';
        labelfakultas.style.display = 'block';
        fakultas_id.style.display = 'block';
    } else if (roles.value === 'PEMBIMBING') {
        labelprogramstudi.style.display = 'none';
        programstudi.style.display = 'none';
        labelnpm.style.display = 'none';
        npm.style.display = 'none';
        labelfakultas.style.display = 'block';
        fakultas_id.style.display = 'block';
    } else if (roles.value === 'ADMIN') {
        labelprogramstudi.style.display = 'none';
        programstudi.style.display = 'none';
        labelnpm.style.display = 'none';
        npm.style.display = 'none';
        labelfakultas.style.display = 'none';
        fakultas_id.style.display = 'none';
    }
});

</script>
@endsection
