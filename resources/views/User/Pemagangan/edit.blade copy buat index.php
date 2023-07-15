@extends('pages.dashboard.layouts.main')



@section('content')
<div class="container-fluid px-4">    
  <h2 class="mt-4">
    Data pribadi
  </h2>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">
         &raquo; Edit
      </li>
  </ol>
  
  <div class="row justify-content-center mb-5">
      <div class="col-xl-12">
          <div class="card">
              <div class="card-header">
                 Data pribadi
              </div>
              <div class="card-body overflow-auto">
                <form action="" method="POST" enctype="multipart/form-data">
                  @csrf
                @method('put')
                  <div class="col-sm-12">
                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="nama" id="inputPassword" >
                          </div>
                        </div>
                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Tempat</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="tempat_lahir" id="inputPassword">
                          </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal lahir</label>
                          <div class="col-sm-4">
                            <input type="date" class="form-control" name="tgl_lahir" id="inputPassword">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="nik" id="inputPassword">
                          </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-4">
                          <select id="inputProvinsi" class="form-select" name="jenis_kelamin">
                            <option selected >Choose...</option>
                            <option value="Pria">Pria</option>
                            <option value="wanita">Wanita</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPassword" name="jurusan">
                        </div>
                      </div>

                      <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <div class="form-floating mb-3">
                            <input type="text"  class="form-control" id="floatingInput" placeholder="name@example.com" name="nama_jalan_ktp" >
                            <label for="floatingInput">Nama Jalan</label>
                          </div>
                        </div>
                       
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="rt_ktp">
                            <label for="floatingInput">RT</label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="rw_ktp">
                            <label for="floatingInput">RW</label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="kode_pos_ktp">
                            <label for="floatingInput">Kode Pos</label>
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input type="text"  class="form-control" id="floatingInput" placeholder="name@example.com" name="kecamatan_ktp">
                            <label for="floatingInput">Kecamatan</label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="kelurahan_ktp">
                            <label for="floatingInput">Kelurahan</label>
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="provinsi_ktp">
                            <label for="floatingInput">Provinsi</label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="kota_ktp">
                            <label for="floatingInput">Kota</label>
                          </div>
                        </div>
                        
                    </div>
                     <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat Tinggal</label>
                        <div class="col-sm-10">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama_jalan_tgl">
                            <label for="floatingInput">Nama Jalan</label>
                          </div>
                        </div>
                       
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="rt_tgl">
                            <label for="floatingInput">RT</label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="rw_tgl">
                            <label for="floatingInput">RW</label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="kode_pos_tgl">
                            <label for="floatingInput">Kode Pos</label>
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="kecamatan_tgl">
                            <label for="floatingInput">Kecamatan</label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="kelurahan_tgl">
                            <label for="floatingInput">Kelurahan</label>
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="provinsi_tgl">
                            <label for="floatingInput">Provinsi</label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="kota_tgl">
                            <label for="floatingInput">Kota</label>
                          </div>
                        </div>
                        
                    </div>

                      <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">No handphone</label>
                        <div class="col-sm-4">
                          <input type="number" name="no_hp" class="form-control" id="inputPassword" >
                        </div>
                        <label for="inputEmail" class="col-sm-2 col-form-label">Alamat email </label>
                        <div class="col-sm-4">
                          <input type="email" name="email" class="form-control" id="inputEmail">
                        </div>
                    </div>
                      
                    <div class="row mt-3 justify-content-end">
                        <div class="col-sm-3  text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-secondary">
                                    Kembali
                                </button>
                            </a>

                        </div>
                    </div>
                  </div>
                  {{-- <div class="col-sm-6">
                      
                  </div> --}}
          </form>
              </div>
          </div>
      </div>
</div>
@endsection

