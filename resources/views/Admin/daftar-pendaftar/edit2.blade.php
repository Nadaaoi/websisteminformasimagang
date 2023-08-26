@extends('pages.dashboard.layouts.main')


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

<div class="container-fluid px-4">    
  <h1 class="mt-4">
     Status Pendaftar 
  </h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard &raquo; Status Pendaftar</li>
  </ol>
  
  <div class="row justify-content-center mt-5 mb-5">
      <div class="col-xl-11">
          <div class="card">
              <div class="card-header">
              
              </div>
              <div class="card-body overflow-auto">
                <form action="/dashboard/daftar-pendaftar/{{ $u->user_id }}" method="POST" enctype="multipart/form-data">
                  @method('put')
                  @csrf
                  <div class="col-sm-12">
                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                          <div class="col-sm-4">
                            <input disabled required disabled type="text" class="form-control bg-white @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $u->nama) }}" id="inputPassword" >
                          </div>
                          <label for="inputEmail" class="col-sm-2 col-form-label">Alamat email </label>
                          <div class="col-sm-4">
                            <input required disabled type="email" name="email" class="form-control bg-white @error('email') is-invalid @enderror" id="inputEmail" value="{{ old('email', $u->email) }}">
                          </div>
                         
                      </div>
                   

                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Universitas</label>
                          <div class="col-sm-4">
                            <input required disabled type="text" class="form-control bg-white @error('universitas') is-invalid @enderror" id="inputPassword" name="universitas" value="{{ old('universitas', $u->universitas) }}" >
                          </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">Jurusan</label>
                          <div class="col-sm-4">
                            <input required disabled type="text" class="form-control bg-white @error('jurusan') is-invalid @enderror" id="inputPassword" name="jurusan" value="{{ old('jurusan', $u->jurusan) }}" >
                          </div>
                      </div>

                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">No handphone</label>
                          <div class="col-sm-4">
                            <input required disabled type="text" name="no_hp" class="form-control bg-white @error('no_hp') is-invalid @enderror" id="inputPassword" value="{{ old('no_hp', $u->no_hp) }}">
                          </div>
                         
                      </div>
                      <div class="mb-3 row">
                        @can('admin')
                            
                        <label for="inputPassword" class="col-sm-2 col-form-label">Status Pendaftar</label>
                        <div class="col-sm-4">
                            <select id="select-status" name="status_kebutuhan" class="form-select bg-white @error('status_kebutuhan') is-invalid @enderror" aria-label="Default select example">
                              <option <?= ( $u->user->status_akun == 'TERDAFTAR') ? 'selected' : '' ?> value="TERDAFTAR">TERDAFTAR</option>
                              <option <?= ( $u->user->status_akun == 'LOLOS ADMINISTRASI') ? 'selected' : '' ?> value="LOLOS ADMINISTRASI">LOLOS ADMINISTRASI</option>
                              <option <?= ( $u->user->status_akun == 'TIDAK LOLOS ADMINISTRASI') ? 'selected' : '' ?> value="TIDAK LOLOS ADMINISTRASI">TIDAK LOLOS ADMINISTRASI</option>
                            
                            </select>
                          
                          
                          
                        </div>
                        @endcan

                        @can('unit')
                          <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal Wawancara</label>
                          <div class="col-sm-4">
                            <input required type="date" class="form-control @error('tgl_wawancara') is-invalid @enderror" id="tglw" name="tgl_wawancara" id="inputPassword" value="{{ old('tgl_wawancara', $u->jadwal_peserta->wawancara) }}">
                          </div>
                        @endcan
                        <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label ">Pemberitahuan</label>
                        <div class="col-sm-4">
                            <textarea id="pemberitahuan"  required class="bg-white form-control mb-2 @error('pemberitahuan') is-invalid @enderror" rows="3" name="pemberitahuan"></textarea>
                        </div>
                        
                      </div>
                      
                    <div class="row mt-5 justify-content-end">
                        <div class="col-sm-3  text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-secondary">
                                    Kembali
                                </button>
                            </a>

                        </div>
                    </div>
                  </div>
                
                </form>
              </div>
          </div>
      </div>
</div>
@endsection

@section('script')
<script src="/js/datatables/jquery-3.5.1.js"></script>

<script>

    $(document).ready(function (){
        $('#select-status').on('change', function(){
          var selectS = $('#select-status').val();
          var pemberitahuan = $('#pemberitahuan').val();
            if(selectS == 'LOLOS ADMINISTRASI'){
              $('#pemberitahuan').val('Untuk administrasi yang anda masukkan sudah sesuai, mohon periksa pemberitahuan secara berkala untuk informasi selanjutnya.');
            }
            if(selectS == 'TIDAK LOLOS ADMINISTRASI'){
              $('#pemberitahuan').val('Mohon maaf anda belum memenuhi persyaratan !');
            }
        })

        $('#tglw').on('change', function(){
          var selectS = $('#tglw').val();
          var pemberitahuan = $('#pemberitahuan').val();
          const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
              var wawancara = new Date(selectS);
              var created_at = wawancara.getDate() + ' ' + bulan[wawancara.getMonth()] + ' ' + wawancara.getFullYear();
          $('#pemberitahuan').val('Selamat anda kami undang wawancara pada tanggal ' + created_at);

          
            var sekarang = new Date();
            var tgl_wawancara = new Date($('#tglw').val());
            var dt = new Date(tgl_wawancara - sekarang);
            var hari = dt / 1000 / 60 / 60 / 24;

            var hari = Math.round(dt / 1000 / 60 / 60 / 24);
            var b = Math.round(hari / 1);

            if(b < 1){
                alert('Mohon diperiksa kembali untuk tanggal wawancara yang dimasukkan ! ')
             
                $('#tglw').val('')
            } 
           
           
        })
       


    })
    
   
</script>
@endsection