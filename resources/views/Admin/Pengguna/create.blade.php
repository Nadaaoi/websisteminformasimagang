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

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h2 class="mt-4">Tambah Data Pengguna</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Tambah Pengguna</h5>

                          <div class="card-body overflow-auto">
                            <form class="forms-sample" method="POST" action="{{ url('data-pengguna/store') }}">
                              @csrf
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="mb-3 row" id="-email">

                                    <label for="inputPassword" class="col-sm-2 col-form-label mb-3">Pilih Role</label>
                                    <div class="col-sm-4 mb-3">
                                      <select required id="roles" class="form-control roles @error('roles') is-invalid @enderror" name="roles" aria-label="Default select example">
                                        <option selected value="">Pilih Role</option>
                                        <option <?= (old('roles') == 'ADMIN') ? 'selected' : '' ?> value="ADMIN">Pendidikan (Admin)</option>
                                        <option <?= (old('roles') == 'PEMBIMBING') ? 'selected' : '' ?> value="PEMBIMBING">Pembimbing</option>
                                        <option <?= (old('roles') == 'USER') ? 'selected' : '' ?> value="USER">Mahasiswa</option>
                                      </select>
                                      @error('roles')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>

                                    <label for="inputPassword" class="nama col-sm-2 col-form-label">Nama lengkap</label>
                                    <div class="col-sm-4 nama">
                                      <input required type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Cth: Nada Aura Wansa">
                                      @error('name')
                                      <div class="invalid-feedback nama">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    
                                    <label for="inputPassword" class="noHP col-sm-2 col-form-label">Nomor HP</label>
                                    <div class="col-sm-4 noHP">
                                      <input required type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" placeholder="Cth: 0851xxxxxx">
                                      @error('no_hp')
                                      <div class="invalid-feedback noHP">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>

                                    <label for="inputPassword" class="mb-3 col-sm-2 col-form-label email">Email</label>
                                    <div class="col-sm-4 email">
                                      <input required type="email" class="mb-3 form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" autocomplete="email" placeholder="cth: abc@mail.com">
                                      @error('email')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                    </div>

                                    <label for="inputPassword" id="labelnip" class="mb-3 col-sm-2 col-form-label npm ">NIP</label>
                                    <div class="col-sm-4">
                                      <input type="text" class="mb-3 form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" name="nip" id="nip" placeholder="Cth: NIP.123">
                                      @error('nip')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                    </div>

                                    <label for="inputPassword" id="labelfakultas" style="display: none;" class="labelfakultas col-sm-2 col-form-label">Fakultas</label>
                                    <div class="col-sm-4">
                                      <select style="display: none;" id="fakultas_id" class="form-control roles @error('fakultas_id') is-invalid @enderror" name="fakultas_id" aria-label="Default select example">
                                        <option selected value="" id="fakultas" value="">Pilih Fakultas</option>
                                        @foreach ($fakultas as $u)
                                        <option value="{{ $u->id }}">{{ $u->fakultas }}</option>
                                        @endforeach
                                      </select>
                                    </div>


                                    <label for="inputPassword" id="labelprogramstudi" style="display: none;" class="labelprogramstudi mb-3 col-sm-2 col-form-label">Program Studi</label>
                                    <div class="col-sm-4">
                                      <select style="display: none;" id="programstudi" class="form-control roles @error('programstudi') is-invalid @enderror" name="programstudi" aria-label="Default select example">
                                        <option selected value="" id="programstudi" value="">Pilih Program Studi</option>
                                        @foreach ($programstudi as $u)
                                        <option value="{{ $u->id }}">{{ $u->programstudi }}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <label for="inputPassword" id="labelnpm" style="display: none;" class="mb-3 col-sm-2 col-form-label npm">NPM</label>
                                    <div class="col-sm-4">
                                      <input id="npm" style="display: none;" type="text" class="mb-3 form-control @error('npm') is-invalid @enderror" value="{{ old('npm') }}" name="npm" autocomplete="npm" placeholder="Cth: 20193200XX">
                                      @error('npm')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
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
                              </div>
                            </form>
                          </div>
@endsection

@section('script')

<script src="/js/datatables/jquery-3.5.1.js"></script>
<script src="/js/datatables/jquery-3.5.1.js"></script>


<script>
    const roles = document.getElementById('roles');
    const labelprogramstudi = document.getElementById('labelprogramstudi');
    const programstudi = document.getElementById('programstudi');
    // const labelnip = document.querySelector('.labelnip');
    // const nip = document.getElementById('nip');

    roles.addEventListener('change', function() {
        if (roles.value === 'USER') {
            labelprogramstudi.style.display = 'block';
            programstudi.style.display = 'block';
            labelnpm.style.display = 'block';
            npm.style.display = 'block';
            labelfakultas.style.display = 'block';
            fakultas_id.style.display = 'block';
            labelnip.style.display = 'block';
            nip.style.display = 'block';
            nip.placeholder = '-';
            nip.readOnly = true;
            nip.value = '';
        } else if (roles.value === 'PEMBIMBING') {
            labelprogramstudi.style.display = 'none';
            programstudi.style.display = 'none';
            labelnpm.style.display = 'none';
            npm.style.display = 'none';
            labelfakultas.style.display = 'block';
            fakultas_id.style.display = 'block';
            labelnip.style.display = 'block';
            nip.style.display = 'block';
            nip.placeholder = '';
            nip.readOnly = false;
        } else if (roles.value === 'ADMIN') {
            labelprogramstudi.style.display = 'none';
            programstudi.style.display = 'none';
            labelnpm.style.display = 'none';
            npm.style.display = 'none';
            labelfakultas.style.display = 'none';
            fakultas_id.style.display = 'none';
            labelnip.style.display = 'block';
            nip.style.display = 'block';
            nip.placeholder = '';
            nip.readOnly = false;
        }
    });
</script>
@endsection
