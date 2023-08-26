@extends('pages.dashboard.layouts.main')


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

@section('content')
<div class="container-fluid px-4">    
  <h2 class="mt-4">
    Data pribadi
  </h2>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard &raquo; Data Pribadi</li>
  </ol>
  
  <div class="row justify-content-center mt-5 mb-5">
      <div class="col-xl-12">
          <div class="card">
              <div class="card-header bg-white">
                
              </div>
              <div class="card-body overflow-auto">
                <form action="{{ route('data-pribadi.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                @method('put')
                  <div class="col-sm-12">

                    <h4 class="mb-4">Data Pribadi</h4>


                     
                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                          <div class="col-sm-4">
                            <input readonly required type="text" class="form-control bg-white @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama',$data->nama)    }}" id="inputPassword" >
                            @error('nama')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
                          <div class="col-sm-4">
                            <input readonly required type="number" class="form-control bg-white @error('nik') is-invalid @enderror" name="nik" id="inputPassword" value="{{ old('nik',  $data->nik) }}" >
                            @error('nik')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Tempat</label>
                          <div class="col-sm-4">
                            <input required type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="inputPassword" value="{{ old('tempat_lahir', $data->tempat_lahir) }}" >
                            @error('tempat_lahir')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal lahir</label>
                          <div class="col-sm-4">
                            <input required type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" id="inputPassword" value="{{ old('tgl_lahir') ?? $data->tgl_lahir }}">
                            @error('tgl_lahir')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                      </div>
                      <div class="mb-3 row">
                         
                        <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-4">
                            <select required id="inputProvinsi" class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                              <option selected value="">PILIH JENIS KELAMIN</option>
                              <option  value="LAKI-LAKI"<?= ($data->jenis_kelamin == 'LAKI-LAKI') ? 'selected' : '' ?>>LAKI-LAKI</option>
                              <option value="PEREMPUAN" <?= ($data->jenis_kelamin == 'PEREMPUAN') ? 'selected' : '' ?>>PEREMPUAN</option>
                            </select>
                            @error('jenis_kelamin')
                              <div class="invalid-feedback">
                              {{ $message }}
                              </div>
                            @enderror
                        </div>

                       





                      </div>

                    

                      <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <div class="form-floating mb-3">
                            <input required type="text" value="{{ old('nama_jalan_ktp') ?? $data->nama_jalan_ktp }}"  class="@error('nama_jalan_ktp') is-invalid @enderror form-control" id="nama_jalan" placeholder="name@example.com" name="nama_jalan_ktp" >
                            <label for="floatingInput">Nama Jalan</label>
                            @error('nama_jalan_ktp')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                       
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input required type="number" value="{{ old('rt_ktp') ?? $data->rt_ktp }}" class="form-control @error('rt_ktp') is-invalid @enderror" id="rt" placeholder="name@example.com" name="rt_ktp">
                            @error('rt_ktp')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                            <label for="floatingInput">RT</label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input required type="number" value="{{ old('rw_ktp') ?? $data->rw_ktp }}"  class="form-control @error('rw_ktp') is-invalid @enderror" id="rw" placeholder="name@example.com" name="rw_ktp">
                            <label for="floatingInput">RW</label>
                            @error('rw_ktp')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-floating mb-3">
                            <input required type="number" value="{{ old('kode_pos_ktp') ?? $data->kode_pos_ktp }}" class="form-control @error('kode_pos_ktp') is-invalid @enderror" id="kode_pos" placeholder="name@example.com" name="kode_pos_ktp">
                            <label for="floatingInput">Kode Pos</label>
                            @error('kode_pos_ktp')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input required type="text" value="{{ old('kecamatan_ktp') ?? $data->kecamatan_ktp }}" class="form-control @error('kecamatan_ktp') is-invalid @enderror" id="kecamatan" placeholder="name@example.com" name="kecamatan_ktp">
                            <label for="floatingInput">Kecamatan</label>
                            @error('kecamatan_ktp')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input required type="text" value="{{ old('kelurahan_ktp') ?? $data->kelurahan_ktp }}" class="form-control @error('kelurahan_ktp') is-invalid @enderror" id="kelurahan" placeholder="name@example.com" name="kelurahan_ktp">
                            <label for="floatingInput">Kelurahan</label>
                            @error('kelurahan_ktp')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <select id="provinsi" required  class="js-example-tags form-select text-center @error('provinsi_ktp') is-invalid @enderror" name="provinsi_ktp">
                            <option value="">Pilih Provinsi</option>
                            <?php $i = 0 ?>
                            @foreach ($provinsi as $prov)
                              @if (old('provinsi_ktp') == $prov->nama_provinsi)
                                <option selected value="{{ $prov->nama_provinsi }}">{{ $prov->nama_provinsi }}</option>
                                
                              @else
                                <option  <?= ($data->provinsi_ktp == $prov->nama_provinsi) ? 'selected' : '' ?> value="{{ $prov->nama_provinsi }}">{{ $prov->nama_provinsi }}</option>
                                  
                              @endif
                            @endforeach
                           
                          </select>
                          @error('provinsi_ktp')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                      @enderror



                          

                          <div class="form-check mt-1">
                            <input class="form-check-input" type="checkbox" value="" id="check">
                            <label class="form-check-label" for="flexCheckDefault">
                              Alamat Tinggal Sesuai Dengan KTP
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <select id="kota" required  class="js-example-tags form-select text-center @error('kota_ktp') is-invalid @enderror" name="kota_ktp">
                            <option value="">Pilih Kota</option>
                            @foreach ($kota as $p)

                              <option <?= ($data->kota_ktp == $p->nama_kota) ? 'selected' : '' ?> value="{{ $p->nama_kota }}">{{ $p->nama_kota }}</option>
                                
                            @endforeach
                           
                          </select>


                        
                        </div>
                        
                    </div>
                     <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat Tinggal</label>
                        <div class="col-sm-10">
                          <div class="form-floating mb-3">
                            <input required type="text" value="{{ old('nama_jalan_tgl') ?? $data->nama_jalan_ktp }}" class="nama_jalan form-control @error('nama_jalan_tgl') is-invalid @enderror"  placeholder="name@example.com" name="nama_jalan_tgl">
                            <label for="floatingInput">Nama Jalan</label>
                            @error('nama_jalan_tgl')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                       
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input required type="number" value="{{ old('rt_tgl') ?? $data->rt_tgl }}" class="rt form-control @error('rt_tgl') is-invalid @enderror"  placeholder="name@example.com" name="rt_tgl">
                            <label for="floatingInput">RT</label>
                            @error('rt_tgl')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input required type="number" value="{{ old('rw_tgl') ?? $data->rw_tgl }}" class="rw form-control @error('rw_tgl') is-invalid @enderror"  placeholder="name@example.com" name="rw_tgl">
                            <label for="floatingInput">RW</label>
                            @error('rw_tgl')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-floating mb-3">
                            <input required type="number" name="kode_pos_tgl" value="{{ old('kode_pos_tgl') ?? $data->kode_pos_tgl }}" class="kode_pos form-control @error('kode_pos_tgl') is-invalid @enderror"  placeholder="name@example.com" name="kode_pos_tgl">
                            <label for="floatingInput">Kode Pos</label>
                            @error('kode_pos_tgl')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input required type="text" value="{{ old('kecamatan_tgl') ?? $data->kecamatan_tgl }}" class="kecamatan form-control @error('kecamatan_tgl') is-invalid @enderror"  placeholder="name@example.com" name="kecamatan_tgl">
                            <label for="floatingInput">Kecamatan</label>
                            @error('kecamatan_tgl')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input required type="text" value="{{ old('kelurahan_tgl') ?? $data->kelurahan_tgl }}" class="kelurahan form-control @error('kelurahan_tgl') is-invalid @enderror"  placeholder="name@example.com" name="kelurahan_tgl">
                            <label for="floatingInput">Kelurahan</label>
                            @error('kelurahan_tgl')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">

                          <select required  class="provinsi js-example-tags form-select text-center @error('provinsi_tgl') is-invalid @enderror" name="provinsi_tgl">
                            <option value="">Pilih Provinsi</option>
                            <?php $i = 0 ?>
                            @foreach ($provinsi as $prov)
                            @if (old('provinsi_tgl') == $prov->nama_provinsi)
                              <option selected value="{{ $prov->nama_provinsi }}">{{ $prov->nama_provinsi }}</option>
                            
                            @else
                              <option  <?= ($data->provinsi_tgl == $prov->nama_provinsi) ? 'selected' : '' ?> value="{{ $prov->nama_provinsi }}">{{ $prov->nama_provinsi }}</option>
                               
                           @endif

                                
                            @endforeach
                           
                          </select>
                          @error('provinsi_tgl')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror

                        </div>
                        <div class="col-sm-5">

                          <select required  class="kota js-example-tags form-select text-center @error('kota_tgl') is-invalid @enderror" name="kota_tgl">
                            <option value="">Pilih Kota</option>
                            @foreach ($kota as $p)

                              <option <?= ($data->kota_tgl == $p->nama_kota) ? 'selected' : '' ?> value="{{ $p->nama_kota }}">{{ $p->nama_kota }}</option>
                                
                            @endforeach
                           
                          </select>
                          @error('kota_tgl')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                      @enderror


                         
                        </div>
                        
                    </div>

                      <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">No handphone</label>
                        <div class="col-sm-4">
                          <input readonly required type="number" name="no_hp" class="form-control bg-white @error('no_hp') is-invalid @enderror" id="inputPassword" value="{{ old('no_hp') ?? $data->no_hp }}">
                          @error('no_hp')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <label for="inputEmail" class="col-sm-2 col-form-label">Alamat email </label>
                        <div class="col-sm-4">
                          <input required readonly type="email" name="email" class="form-control bg-white @error('email') is-invalid @enderror" id="inputEmail" value="{{ old('email') ?? $data->email }}">
                          @error('email')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                      @enderror
                        </div>
                    </div>

                    <h4 class="mb-4 mt-5">Data Siswa / Mahasiswa</h4>

                    <div class="row">
                      <label class="col-sm-2 col-form-label mb-3">Pendidikan</label>
                      <div class="col-sm-4 mb-3">
                        
                          <select required name="jenjang_pendidikan" id="jenjang_pendidikan" class="form-select bg-white  @error('jenjang_pendidikan') is-invalid  @enderror" aria-label="Default select example">
                              <option selected value="">Pilih Jenjang Pendidikan</option>
                              <option <?= (old('jenjang_pendidikan', $data->jenjang_pendidikan) == 'SMK') ? 'selected' : '' ?> value="SMK">SMK</option>
                            
                              <option <?= (old('jenjang_pendidikan', $data->jenjang_pendidikan) == 'D3') ? 'selected' : '' ?> value="D3">D3</option>
                              <option <?= (old('jenjang_pendidikan', $data->jenjang_pendidikan) == 'D4/S1') ? 'selected' : '' ?> value="D4/S1">D4/S1</option>
                           
                              <option <?= (old('jenjang_pendidikan', $data->jenjang_pendidikan) == 'FRESH GRADUATE') ? 'selected' : '' ?> value="FRESH GRADUATE">FRESH GRADUATE</option>
                              
                          </select>
                      </div>
                    </div>

                    <div class="row chk">
                      <label for="inputPassword" class="col-sm-2 mb-3 col-form-label">Universitas</label>
                      <div class="col-sm-4 mb-3">
                        <select required  class="js-example-tags form-select text-center @error('universitas') is-invalid @enderror" name="universitas" id="universitas">
                          <option value="">Pilih Universitas</option>
                          <option selected value="{{ $data->universitas }}">{{ $data->universitas }}</option>
                          @foreach ($univ as $u)
                          @if (old('universitas') == $u->nama_universitas )
                            <option selected value="{{ $u->nama_universitas }}">{{ $u->nama_universitas }}</option>
                              
                          @else
                              
                            <option <?= ($data->universitas == $u->nama_universitas) ? 'selected' : '' ?> value="{{ $u->nama_universitas }}">{{ $u->nama_universitas }}</option>
                          @endif
                              
                          @endforeach
                         
                        </select>
                        @error('universitas')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <label for="inputPassword" class="col-sm-2 mb-3 col-form-label">Jurusan</label>
                      <div class="col-sm-4 mb-3">
                        <select required  class="js-example-tags form-select text-center @error('jurusan') is-invalid @enderror" name="jurusan">
                          <option value="">Pilih Jurusan</option>
                          <option selected value="{{ $data->jurusan }}">{{ $data->jurusan }}</option>
                          @foreach ($jurusan as $j)
                            
                            @if (old('jurusan') == $j->prodi )
                              <option selected value="{{ $j->prodi }}">{{ $j->prodi }}</option>
                                        
                            @else
                              <option <?= ($data->jurusan == $j->prodi) ? 'selected' : '' ?> value="{{ $j->prodi }}">{{ $j->prodi }}</option>
                                
                            @endif
                              
                          @endforeach
                         
                        </select>
                        @error('jurusan')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                      </div>

                     

                      <label for="inputPassword" class="col-sm-2 mb-3  col-form-label">Tahun Masuk</label>
                      <div class="col-sm-4 mb-3">
                        <input required  type="text" class="form-control" name="tahun_masuk" id="inputPassword" value="{{ old("tahun_masuk", $data->tahun_masuk) }}" >
                      </div>
                      @error("tahun_masuk")
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror


                       
                      <label for="inputPassword" class="col-sm-2 nim mb-3 col-form-label">NIM / NIS</label>
                      <div class="col-sm-4 mb-3 nim">
                        <input required  type="number" class="@error('nim') is-invalid @enderror form-control" name="nim" id="inputPassword" value="{{ old('nim', $data->nim) }}" >
                        @error('nim')
                          <div class="invalid-feedback nim">
                          {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <label for="inputPassword" class="col-sm-2 mb-3 ipk col-form-label">IPK Terakhir</label>
                      <div class="col-sm-4 mb-3 ipk">
                        <input required id="ipk"  type="text" class="form-control" name="ipk_terakhir" id="inputPassword" value="{{ old("ipk_terakhir", $data->ipk_terakhir) }}" >
                      </div>
                      @error("ipk_terakhir")
                        <div class="invalid-feedback ipk">{{ $message }}</div>
                      @enderror

                    

                      <label for="inputPassword" class="semester mb-3 col-sm-2 col-form-label">Semester</label>
                      <div class="col-sm-4 semester mb-3">
                        <input required   type="number" value="{{ old('semester', $data->semester)  }}" id="semester"  class="form-control @error('semester') is-invalid @enderror" id="floatingInput"  name="semester" >

                      </div>
                      @error('semester')
                        <div class="invalid-feedback semester">
                        {{ $message }}
                        </div>
                      @enderror

                     

                    
                    </div>




                    <div class="row">
                      

                      <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 mb-3  col-form-label">Kompetensi Spesifik</label>
                        <div class="col-sm-10 mb-3">
                          <textarea required class="bg-white form-control mb-3" rows="2" name="kompetensi_spesifik">{{ old('kompetensi_spesifik', $data->kompetensi_spesifik) }}</textarea>
                        </div>
                        @error("kompetensi_spesifik")
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
  
                        <label for="inputPassword" class="col-sm-2 col-form-label">CP Sekolah / Kampus</label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input required  type="number" class="form-control" name="telepon_univ" id="inputPassword" value="{{ old("telepon_univ", $data->telepon_univ) }}" >
                            <label for="floatingInput">Telepon</label>
                          </div>
                        </div>
                        @error("telepon_univ")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input required  type="text" class="form-control" name="email_univ" id="inputPassword" value="{{ old("email_univ", $data->email_univ) }}" >
                            <label for="floatingInput">Email</label>
                          </div>
                        </div>
                        @error("email_univ")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                       
                      </div>



                  </div>










                      
                    <div class="row mt-5 justify-content-end">
                        <div class="col-sm-3  text-center">
                            <button type="button" id="simpanbtn" class="btn btn-primary">Simpan</button>
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
{{-- {{ $eq }} --}}
@endsection


@section('script')

    {{-- Datatables --}}
    <script src="/js/datatables/jquery-3.5.1.js"></script>
    <script src="/js/scriptDataPribadiCreate.js"></script>
    

   <script>
   
     

     
    </script>
     <script>

      $(document).ready(function() {

        function ipkTerakhir(){
            $ipkTkr = $('#ipk').val();
            $floatIPK = parseFloat($ipkTkr);
            
            
            if($floatIPK < 2.5){
              alert('Mohon maaf untuk IPK yang anda masukkan tidak memenuhi syarat pendaftaran magang.')
              // $('#ipk').val('');
              $('#simpanbtn').attr('type', 'button');
            }
            if($floatIPK > 2.5){
              $('#simpanbtn').attr('type', 'submit');

            }
        }

        $('#simpanbtn').on('click', function(){
          var jenjang_pendidikan = $('#jenjang_pendidikan').val();

          if(jenjang_pendidikan !== 'SMK'){
            ipkTerakhir()
          } else {
            $('#simpanbtn').attr('type', 'submit');
          }
        })

        var jenjang_pendidikan = $('#jenjang_pendidikan').val();

        
        if(jenjang_pendidikan == 'FRESH GRADUATE'){
                $('.nim').remove()
                $('.semester').remove()
            }
        if(jenjang_pendidikan == 'SMK'){
                $('.ipk').remove()
          }

          $('#jenjang_pendidikan').on('change', function(){
            var jenjang_pendidikan = $('#jenjang_pendidikan').val();
            var nim = $('.nim');

            if(jenjang_pendidikan == 'SMK'){
                $('.ipk').remove()
                $('.semester').remove()
                var html1 = ' <label for="inputPassword" class="mb-3 col-sm-2 col-form-label semester">Semester</label>'
                    html1 += ' <div class="col-sm-4 semester mb-3">'
                      html1 += '  <input required type="number" value="{{ old("semester", $data->semester) }}" id="semester"  class="semester  form-control @error("semester") is-invalid @enderror" id="floatingInput"  name="semester" ></div>'
                      html1 += ' @error("semester")<div class="invalid-feedback semester">{{ $message }}</div>@enderror'

                    $('.chk').append(html1)
                return false;
            }
            
            // alert(program)
            if(jenjang_pendidikan == 'FRESH GRADUATE'){
                // $('.nim').remove()
                $('.ipk').remove()
                var html2 = ' <label for="inputPassword" class="ipk col-sm-2 col-form-label">IPK Terakhir</label>'
                    html2 += ' <div class="col-sm-4 ipk mb-3">'
                      html2 += '  <input required   type="text" class="form-control" name="ipk_terakhir" id="ipk" value="{{ old("ipk_terakhir", $data->ipk_terakhir) }}" >  </div>'
                      html2 += ' @error("ipk_terakhir")  <div class="invalid-feedback ipk"> {{ $message }}  </div>  @enderror'
                      $('.chk').append(html2);
                $('.semester').remove()
            }else {
              $('.nim').remove()
              $('.semester').remove()
              $('.ipk').remove()
                var html = ' <label for="inputPassword" class="nim col-sm-2 mb-3 col-form-label">NIM / NIS</label>'
                    html += ' <div class="col-sm-4 mb-3 nim">'
                      html += '  <input required   type="number" class="form-control" name="nim" id="inputPassword" value="{{ old("nim", $data->nim) }}" >  </div>'
                      html += ' @error("nim")  <div class="invalid-feedback mb-3 nim"> {{ $message }}  </div>  @enderror'
                      $('.chk').append(html);
                var html2 = ' <label for="inputPassword" class="ipk col-sm-2 col-form-label">IPK Terakhir</label>'
                    html2 += ' <div class="col-sm-4 ipk">'
                      html2 += '  <input required   type="text" class="form-control" name="ipk_terakhir" id="ipk" value="{{ old("ipk_terakhir", $data->ipk_terakhir) }}" >  </div>'
                      html2 += ' @error("ipk_terakhir")  <div class="invalid-feedback ipk"> {{ $message }}  </div>  @enderror'
                      $('.chk').append(html2);
                      


                var html1 = ' <label for="inputPassword" class="mb-3 col-sm-2 col-form-label semester">Semester</label>'
                    html1 += ' <div class="col-sm-4 semester mb-3">'
                      html1 += '  <input required type="number" value="{{ old("semester", $data->semester) }}" id="semester"  class="semester  form-control @error("semester") is-invalid @enderror" id="floatingInput"  name="semester" ></div>'
                      html1 += ' @error("semester")<div class="invalid-feedback semester">{{ $message }}</div>@enderror'

                    $('.chk').append(html1)
            }

        })






















        <?php echo('var provinsi_ktp = "' . $data->provinsi_ktp . '";') ?>
        <?php echo('var provinsi_tgl = "' . $data->provinsi_tgl . '";') ?>
        <?php echo('var kota_ktp = "' . $data->kota_ktp . '";') ?>
        <?php echo('var kota_tgl = "' . $data->kota_tgl . '";') ?>
        if(provinsi_ktp){
          var html_p = '<option selected value="';
             html_p += provinsi_ktp;
             html_p += '">';
             html_p += provinsi_ktp;
             html_p += '</option>';
             $('#provinsi').append(html_p);
             
        }
        if(provinsi_tgl){
          var html_pt = '<option selected value="';
             html_pt += provinsi_tgl;
             html_pt += '">';
             html_pt += provinsi_tgl;
             html_pt += '</option>';
             $('.provinsi').append(html_pt);
             
        }
        if(kota_ktp){
          var html_k = '<option selected value="';
             html_k += kota_ktp;
             html_k += '">';
             html_k += kota_ktp;
             html_k += '</option>';
             $('#kota').append(html_k);
             
        }
        if(kota_tgl){
          var html_kt = '<option selected value="';
             html_kt += kota_tgl;
             html_kt += '">';
             html_kt += kota_tgl;
             html_kt += '</option>';
             $('.kota').append(html_kt);
             
        }
           
            
       




        $('#check').on('click', function(){
          var ch = document.getElementById("check").checked;
          var nama_jalan = $('#nama_jalan').val();
          var rt = $('#rt').val();
          var rw = $('#rw').val();
          var kode_pos = $('#kode_pos').val();
          var kelurahan = $('#kelurahan').val();
          var kecamatan = $('#kecamatan').val();
          var kota = $('#kota').val();
          var provinsi = $('#provinsi').val();

          if (ch === true){
            $('.nama_jalan').val(nama_jalan);
            $('.rt').val(rt);
            $('.rw').val(rw);
            $('.kode_pos').val(kode_pos);
            $('.kelurahan').val(kelurahan);
            $('.kecamatan').val(kecamatan);var htmlk = '<option selected value="'
             htmlk += kota
             htmlk += '">'
             htmlk += kota
             htmlk += '</option>'
            var htmlp = '<option selected value="'
             htmlp += provinsi
             htmlp += '">'
             htmlp += provinsi
             htmlp += '</option>'
            $('.kota').append(htmlk);
            $('.provinsi').append(htmlp);
          } else{
            $('.nama_jalan').val('');
            $('.rt').val('');
            $('.rw').val('');
            $('.kode_pos').val('');
            $('.kelurahan').val('');
            $('.kecamatan').val(''); 
            var htmlk = '<option selected value="'
             htmlk += ' ">'
             htmlk += '</option>'
            var htmlp = '<option selected value="'
             htmlp += ' ">'
             htmlp += '</option>'
            $('.kota').append(htmlk);
            $('.provinsi').append(htmlp);
          }
          // alert(ch)
        })
       
       
      
              
      } );
  
      </script>
   
@endsection

