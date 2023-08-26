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
    Data Peserta Magang
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard &raquo; Data {{ $data->nama }}</li>
  </ol>
  
  <div class="row justify-content-center mt-5 mb-5">
      <div class="col-xl-11">
          <div class="card">
              <div class="card-header">
              </div>
              <div class="card-body overflow-auto">
               
                  <div class="col-sm-12">
                    
                   <h4 class="mb-4">Data Pribadi</h4>
                      
                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                          <div class="col-sm-4">
                            <input readonly type="text" class="form-control bg-white" value="{{ $data->nama }}"  >
                          </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal Wawancara</label>
                          <div class="col-sm-4">
                            <input readonly type="text" class="form-control bg-white" value="{{ $data->jadwal_peserta->wawancara }}" id="wawancara" >
                          </div>
                      </div>

                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Tempat Lahir</label>
                          <div class="col-sm-4">
                            <input readonly value="{{ $data->tempat_lahir }}" type="text" class="form-control bg-white">
                          </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal lahir</label>
                          <div class="col-sm-4">
                            <input readonly value="{{ $data->tgl_lahir }}" type="text" class="form-control bg-white" >
                          </div>
                      </div>

                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
                          <div class="col-sm-4">
                            <input readonly value="{{ $data->nik }}" type="text" class="form-control bg-white" >
                          </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                          <div class="col-sm-4">
                              <select disabled id="inputProvinsi" class="form-select bg-white">
                                <option <?= ($data->jenis_kelamin === 'LAKI-LAKI / PEREMPUAN') ? 'selected' : '' ?> >LAKI-LAKI/PEREMPUAN</option>
                                <option <?= ($data->jenis_kelamin === 'LAKI-LAKI') ? 'selected' : '' ?> >LAKI-LAKI</option>
                                <option <?= ($data->jenis_kelamin == 'PEREMPUAN') ? 'selected' : '' ?>>PEREMPUAN</option>
                              </select>
                          </div>
                      </div>

                     
                     

                      <div class="mb-3 row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Alamat KTP</label>
                          <div class="col-sm-10">
                              <div class="form-floating mb-3">
                                <input readonly value="{{ $data->nama_jalan_ktp }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com" >
                                <label for="floatingInput">Nama Jalan</label>
                              </div>
                          </div>
                       
                          <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                          <div class="col-sm-3">
                            <div class="form-floating mb-3">
                              <input readonly value="{{ $data->rt_ktp }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                              <label for="floatingInput">RT</label>
                            </div>
                          </div>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->rw_ktp }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">RW</label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->kode_pos_ktp }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Kode Pos</label>
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->kecamatan_ktp }}" type="text"  class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Kecamatan</label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->kelurahan_ktp }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Kelurahan</label>
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->provinsi_ktp }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Provinsi</label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->kota_ktp }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Kota</label>
                          </div>
                        </div>
                        
                    </div>
                     <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat Tinggal</label>
                        <div class="col-sm-10">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->nama_jalan_tgl }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Nama Jalan</label>
                          </div>
                        </div>
                       
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->rt_tgl }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">RT</label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->rw_tgl }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">RW</label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->kode_pos_tgl }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Kode Pos</label>
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->kecamatan_tgl }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Kecamatan</label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->kelurahan_tgl }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Kelurahan</label>
                          </div>
                        </div>
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->provinsi_tgl }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Provinsi</label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-floating mb-3">
                            <input readonly value="{{ $data->kota_tgl }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Kota</label>
                          </div>
                        </div>
                        
                    </div>

                      <div class="mb-5 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">No handphone</label>
                        <div class="col-sm-4">
                          <input readonly value="{{ $data->no_hp }}" type="text"  class="form-control bg-white"  >
                        </div>
                        <label for="inputEmail" class="col-sm-2 col-form-label">Alamat email </label>
                        <div class="col-sm-4">
                          <input readonly value="{{ $data->email }}" type="email"  class="form-control bg-white" id="inputEmail">
                        </div>
                      </div>






                      {{-- Data Mahasiswa --}}
                      <h4 class="mb-4">Data Mahasiswa</h4>

                      <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Sekolah / Universitas</label>
                        <div class="col-sm-4">
                          <input readonly value="{{ $data->universitas }}" type="text" class="form-control bg-white" >
                        </div>
                          <label for="inputPassword" class="col-sm-2 col-form-label">Jurusan</label>
                          <div class="col-sm-4">
                            <input readonly value="{{ $data->jurusan }}" type="text" class="form-control bg-white">
                          </div>
                      </div>


                      <div class="mb-3 row">
                         
                        <label for="inputPassword" class="col-sm-2 col-form-label">NIM / NIS</label>
                        <div class="col-sm-4">
                          <input readonly type="text" class="form-control bg-white" value="{{ $data->nim }}"  >
                        </div>
                        <label class="col-sm-2 col-form-label">Jenjang Pendidikan</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control bg-white"  id="inputPassword" value="{{ $data->jenjang_pendidikan }}" readonly>
                        </div>
                       
                    </div>
                    <div class="mb-3 row">
                      <label for="inputPassword" class="col-sm-2 mb-3 col-form-label">Semester</label>
                      <div class="col-sm-4">
                        <input readonly value="{{ $data->semester }}" type="text" class="form-control bg-white" >
                      </div>
                      <label for="inputPassword" class="col-sm-2 mb-3 col-form-label">IPK Terakhir</label>
                      <div class="col-sm-4">
                        <input readonly value="{{ $data->ipk_terakhir }}" type="text" class="form-control bg-white" >
                      </div>
                      <label for="inputPassword" class="col-sm-2 col-form-label">Tahun Masuk</label>
                      <div class="col-sm-4">
                        <input readonly value="{{ $data->tahun_masuk }}" type="text" class="form-control bg-white" >
                      </div>
                      <label for="inputPassword" class="col-sm-2 mb-3 col-form-label">Kompetensi Spesifik</label>
                      <div class="col-sm">
                        <textarea readonly class="bg-white mb-3 form-control mb-3" rows="2">{{ $data->kompetensi_spesifik }}</textarea>
                        
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="inputPassword" class="col-sm-2 col-form-label">CP Sekolah / Kampus</label>
                      <div class="col-sm-5">
                        <div class="form-floating mb-3">
                          <input readonly value="{{ $data->telepon_univ }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com" >
                          <label for="floatingInput">Telepon</label>
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-floating mb-3">
                          <input readonly value="{{ $data->email_univ }}" type="text" class="form-control bg-white" id="floatingInput" placeholder="name@example.com" >
                          <label for="floatingInput">Email</label>
                        </div>
                      </div>
                    </div>










                      <div class="mt-5 mb-5 row justify-content-center">
                        <div class="col-sm-11">
                          <table class="table table-striped">
                            <thead>
                              <th>Nama Dokumen</th>
                              <th>Dokumen</th>
                            </thead>
                            <tbody>
                              <tr>
                              @if ($count == 0)
                                <td>
                                  -
                                </td>
                                <td>-</td>
                                    
                                @endif
                              </tr>
                              <tr>
                                @if ($count > 0)
                                  <td>Proposal Magang</td>
                                  <td><a target="_blank" href="/dashboard/peserta-magang/download-proposal/{{ $user[0]->id }}">
                                    {{ $dok[0]->data_pribadi->nama }}-proposal.pdf</a></td>
                                    
                                @endif
  
                              </tr>
                              <tr>
                                @if ($count > 0)
                                  <td>KTP</td>
                                  <td><a target="_blank" href="/dashboard/peserta-magang/download-ktp/{{ $user[0]->id }}">
                                    {{ $dok[0]->data_pribadi->nama }}-ktp.pdf</a></td>
                                    
                                @endif
  
                              </tr>
                              <tr>
                                @if ($count > 0)
                                  <td>CV</td>
                                  <td><a target="_blank" href="/dashboard/peserta-magang/download-cv/{{ $user[0]->id }}">
                                    {{ $dok[0]->data_pribadi->nama }}-cv.pdf</a></td>
                                    
                                @endif
                                
                              </tr>
                              <tr>
                                @if ($count > 0)
                                  <td>Transkrip Nilai</td>
                                  <td><a target="_blank" href="/dashboard/peserta-magang/download-transkrip/{{ $user[0]->id }}">
                                    {{ $dok[0]->data_pribadi->nama }}-transkrip-nilai.pdf</a></td>
  
                                @endif
                              </tr>
                            </tbody>
                          </table>

                        </div>
                      </div>


                    
                      
                      
                      <div class="row mt-3 justify-content-end">
                        <div class="col-sm-3 text-end">
                          <a href="{{ url()->previous() }}">
                            <button type="button" class="btn btn-secondary">
                              Kembali
                            </button>
                          </a>
                        </div>
                      </div>
                    </form>

                 

                  </div>
                  
              </div>
          </div>
      </div>
</div>
@endsection

@section('script')
<script src="/js/datatables/jquery-3.5.1.js"></script>
<script>
  var wawancara = document.getElementById('wawancara').value;
  var wawancara1 = document.getElementById('wawancara');
  if(wawancara == ''){
    wawancara1.value = '-';
  }
</script>




@endsection
