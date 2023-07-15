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

    <h2 class="mt-4">Tambah Data Pengguna</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Tambah Pengguna</h5>
    

    @if (session()->has('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif
    {{-- <div class="row justify-content-center mt-3">
      <div class="col-xl-11 mt-3">
        <div class="card">
          <div class="card-header">
          </div> --}}
          <div class="card-body overflow-auto">
            <form action="{{ route('pemagangan.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="col-sm-12">
                <h4 class="mb-4">Data Mahasiswa</h4>
    
                {{-- Nama --}}
                <div class="row">
                  <div class="col-sm-6 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>Nama Lengkap</strong></label>
                    <div class="input-group input-group-merge">         
                      <input
                        required
                        class="form-control @error('nama') is-invalid @enderror"
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ Auth::user()->name }}"
                        placeholder="cth: 20183100xx"
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
                        class="form-control @error('npm') is-invalid @enderror"
                        type="number"
                        id="npm"
                        name="npm"
                        value="{{ Auth::user()->npm }}"
                        placeholder="cth: 20183100xx"
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
                        value="{{ date('Y-m-d') }}"
                        aria-describedby="basic-icon-default-company2"
                        required/>
                      @error('tanggalpengajuan')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  {{-- Fakultas --}}
                  <div class="col-sm-6 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>Fakultas</strong></label>
                    <div class="input-group input-group-merge">
                      <select id="fakultas" name="fakultas" class="form-control @error('fakultas') is-invalid @enderror" required>
                        <option select value="Fakultas">Pilih Fakultas</option>
                        <option value="Informatika">Informatika</option>
                        <option value="Bisnis">Bisnis</option>
                      </select>
                      @error('fakultas')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
    
                <div class="row">
                  {{-- Semester --}}
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>Semester</strong></label>
                    <div class="input-group input-group-merge">
                      <input
                        onchange="validateForm()"
                        required
                        type="number"
                        id="semester"
                        name="semester"
                        class="form-control @error('semester') is-invalid @enderror"
                        placeholder="cth: 7"
                        aria-describedby="basic-icon-default-company2"
                        required/>
                      @error('semester')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  {{-- Program Studi --}}
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>Program Studi</strong></label>
                    <div class="input-group input-group-merge"> 
                      <select id="programstudi" name="programstudi" class="form-control @error('programstudi') is-invalid @enderror" required onchange="validateForm()">
                        <option select value="Prodi">Pilih Program Studi</option>
                        <option value="TI">Teknik Informatika</option>
                        <option value="SI">Sistem Informasi</option>
                        <option value="MI">Manajemen Informatika</option>
                        <option value="RPL">Rekayasa Perangkat Lunak</option>
                        <option value="AKS1">Akuntansi S1</option>
                        <option value="MAS1">Manajemen S1</option>
                        <option value="AKD3">Akuntansi D3</option>
                        <option value="MAD3">Manajemen D3</option>
                        <option value="Sekretari">Sekretari</option>
                      </select>
                      @error('programstudi')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  {{-- Jenjang Pendidikan --}}
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>Jenjang Pendidikan</strong></label>
                    <div class="input-group input-group-merge"> 
                      <input readonly type="text" id="jenjangpendidikan" placeholder="cth: S1" name="jenjangpendidikan" class="form-control @error('jenjangpendidikan') is-invalid @enderror" required>
                      @error('jenjangpendidikan')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  {{-- Tahun Masuk --}}
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>Tahun Masuk</strong></label>
                    <div class="input-group input-group-merge">
                      <input id="tahunmasuk" placeholder="cth: 2020" name="tahunmasuk" class="form-control @error('tahunmasuk') is-invalid @enderror" type="number" required>
                      @error('tahunmasuk')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  {{-- Kelas --}}
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>Kelas</strong></label>
                    <div class="input-group input-group-merge">
                      <input
                        required
                        type="text"
                        id="kelas"
                        name="kelas"
                        class="form-control @error('kelas') is-invalid @enderror"
                        placeholder="cth: TI-19A"
                        aria-describedby="basic-icon-default-company2"
                        required/>
                      @error('kelas')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  {{-- IPK --}}
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>IPK (Minimal 2.0)</strong></label>
                    <div class="input-group input-group-merge">
                      <input
                        required
                        type="number"
                        step="0.01"
                        max="4"
                        min="2"
                        id="ipk"
                        name="ipk"
                        class="form-control @error('ipk') is-invalid @enderror"
                        placeholder="cth: 3.50 (IPK minimal 2.0)"
                        aria-describedby="basic-icon-default-company2"
                        required/>
                      @error('ipk')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  {{-- No Handphone --}}
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>No Handphone</strong></label>
                    <div class="input-group input-group-merge">
                      <input
                        required
                        type="number"
                        id="nohp"
                        name="nohp"
                        class="form-control @error('nohp') is-invalid @enderror"
                        value="{{ Auth::user()->no_hp }}"
                        placeholder="cth: 0851 xxxx xxxx"
                        aria-describedby="basic-icon-default-company2"
                        required/>
                      @error('nohp')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  {{-- E-mail --}}
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>E-mail</strong></label>
                    <div class="input-group input-group-merge">
                      <input
                        required
                        readonly
                        type="input"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="cth: abc@domain.com"
                        aria-describedby="basic-icon-default-company2"
                        value="{{ Auth::user()->email }}"
                        required/>
                      @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
    
                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company" class="mb-2"><strong>Status Magang</strong></label>
                    <div class="input-group input-group-merge">
                      <select id="programmagang" name="programmagang" class="form-control @error('programmagang') is-invalid @enderror" required onchange="showAdditionalInput()">
                        <option select value="program">Pilih Status Magang</option>
                        <option value="MSIB">Diterima MSIB (Magang Studi Independen Bersertifikat)</option>
                        <option value="MAGENTA">Diterima MAGENTA (Magang Generasi Bertalenta)</option>
                        <option value="Reguler">Diterima di Perusahaan (Melamar Langsung)</option>
                        <option value="Belummagang">Belum Melakukan Pemagangan</option>
                      </select>
                      @error('programmagang')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  
                </div>
              </div>
    
                <div class="col-sm-12" id="additionalInput" style="display: none;">
                  <h4 class="mb-4">Data Perusahaan & Posisi Pemagangan</h4>
    
                  <div class="row">
                    <div class="col-sm-6 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Nama Perusahaan</strong></label>
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="namaperusahaan"
                          name="namaperusahaan"
                          class="form-control @error('namaperusahaan') is-invalid @enderror"
                          placeholder="cth: PT ABC"
                          aria-describedby="basic-icon-default-company2"/>
                        @error('namaperusahaan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
    
                    <div class="col-sm-6 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Posisi Sebagai</strong></label>
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="posisi"
                          name="posisi"
                          class="form-control @error('posisi') is-invalid @enderror"
                          placeholder="cth: Technical Writer"
                          aria-describedby="basic-icon-default-company2"/>
                        @error('posisi')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
    
                    <div class="col-sm-4 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Mulai Pemagangan</strong></label>
                      <div class="input-group input-group-merge">
                        <input
                          onchange="updateDurasi()"
                          type="date"
                          id="tanggalmulai"
                          name="tanggalmulai"
                          class="form-control @error('tanggalmulai') is-invalid @enderror"
                          aria-describedby="basic-icon-default-company2"/>
                        @error('tanggalmulai')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
    
                    <div class="col-sm-4 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Selesai Pemagangan</strong></label>
                      <div class="input-group input-group-merge">
                        <input
                          onchange="updateDurasi()"
                          type="date"
                          id="tanggalselesai"
                          name="tanggalselesai"
                          class="form-control @error('tanggalselesai') is-invalid @enderror"
                          aria-describedby="basic-icon-default-company2"/>
                        @error('tanggalselesai')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
    
                    <div class="col-sm-4 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Durasi Pemagangan</strong></label>
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="durasimagang"
                          name="durasimagang"
                          class="form-control @error('durasimagang') is-invalid @enderror"
                          aria-describedby="basic-icon-default-company2"
                          readonly/>
                        @error('durasimagang')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
    
                    <div class="col-sm-4 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Upload Surat Bukti Penerimaan</strong></label>
                      <div class="input-group input-group-merge">
                        <input
                          type="file"
                          id="buktipenerimaan"
                          name="buktipenerimaan"
                          class="form-control @error('buktipenerimaan') is-invalid @enderror"
                          aria-describedby="basic-icon-default-company2"
                          readonly/>
                        @error('buktipenerimaan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <label for="" id="p_buktipenerimaan" class="text-muted text-danger" style="font-size: smaller">* Bukti penerimaan magang kamu harus dalam format PDF dengan ukuran maksimal 5 MB</label>
                    </div>
    
                    <div class="col-sm-4 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Upload Transkrip Nilai</strong></label>
                      <div class="input-group input-group-merge">
                        <input
                          type="file"
                          id="transkrip_nilai"
                          name="transkrip_nilai"
                          class="form-control @error('transkrip_nilai') is-invalid @enderror"
                          aria-describedby="basic-icon-default-company2"
                          readonly/>
                        @error('transkrip_nilai')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <label for="" id="p_transkripnilai" class="text-muted text-danger" style="font-size: smaller">* Bukti transkrip nilai kamu harus dalam format PDF dengan ukuran maksimal 5 MB</label>
                    </div>
    
                    <div class="col-sm-4 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Upload KTM</strong></label>
                      <div class="input-group input-group-merge">
                        <input
                          type="file"
                          id="kartumahasiswa"
                          name="kartumahasiswa"
                          class="form-control @error('kartumahasiswa') is-invalid @enderror"
                          aria-describedby="basic-icon-default-company2"
                          readonly/>
                        @error('kartumahasiswa')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <label for="" id="p_kartumahasiswa" class="text-muted text-danger" style="font-size: smaller">* Bukti kartu mahasiswa kamu harus dalam format PNG/JPG dengan ukuran maksimal 2 MB</label>
                    </div>
                  </div>
                

                  <div class="col-sm-12" id="BelumMagang" style="display: none;">
                    <h4 class="mb-4">Keterlambatan Pemagangan</h4>

                    <div class="row">
                    <div class="col-sm-6 mb-4">
                      <label for="basic-icon-default-company" class="mb-2"><strong>Alasan Keterlambatan</strong></label>
                      <div class="input-group input-group-merge">
                      <input
                        type="textarea"
                        id="alasanbelummagang"
                        name="alasanbelummagang"
                        class="form-control @error('alasanbelummagang') is-invalid @enderror"
                        placeholder="cth: Belum mendapatkan tempat magang yang sesuai"
                        aria-describedby="basic-icon-default-company2"
                        />
                                @error('alasanbelummagang')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                              @enderror
                          </div>
                        </div>
                    </div>
                  </div>
    
                <div class="row mt-5 justify-content-end">
                  <div class="col-sm-3 text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ url()->previous() }}">
                      <button type="button" class="btn btn-secondary">Kembali</button>
                    </a>
                  </div>
                </div>
              </form>
            </div>
    

@endsection

<script>
function showAdditionalInput() {
  var selectElement = document.getElementById("programmagang");
  var additionalInput = document.getElementById("additionalInput");
  var BelumMagang = document.getElementById("BelumMagang");

  if (selectElement.value === "MSIB" || selectElement.value === "MAGENTA" || selectElement.value === "Reguler") {
    additionalInput.style.display = "block";
    BelumMagang.style.display = "none";
    
    var inputTextElements = document.querySelectorAll("#additionalInput input[type='text']");
    var inputDateElements = document.querySelectorAll("#additionalInput input[type='date']");

    // Reset nilai atau status elemen sesuai kebutuhan
    inputTextElements.forEach(function(element) {
      element.value = "";
    });

    inputDateElements.forEach(function(element) {
      element.value = "";
    });
  }
  
  if (selectElement.value === "Belummagang") {
    additionalInput.style.display = "none";
    BelumMagang.style.display = "block";
  }
}

function updateDurasi() {
  var tanggalmulai = document.getElementById("tanggalmulai");
  var tanggalselesai = document.getElementById("tanggalselesai");
  var durasimagang = document.getElementById("durasimagang");

  var mulai = new Date(tanggalmulai.value);
  var selesai = new Date(tanggalselesai.value);

  var selisih = Math.abs(selesai - mulai); // Selisih dalam milidetik

  var bulanMulai = mulai.getFullYear() * 12 + mulai.getMonth();
  var bulanSelesai = selesai.getFullYear() * 12 + selesai.getMonth();
  var durasiBulan = bulanSelesai - bulanMulai;

  durasimagang.value = durasiBulan + " bulan";

  if (durasiBulan < 1) {
    alert("Magang tidak boleh kurang dari 1 bulan!");
    tanggalmulai.value = "";
    tanggalselesai.value = "";
    return false;
  } else {
    return true;
  }
}

  function updateDurasi() {
  var tanggalmulai = document.getElementById("tanggalmulai");
  var tanggalselesai = document.getElementById("tanggalselesai");
  var durasimagang = document.getElementById("durasimagang");

  var mulai = new Date(tanggalmulai.value);
  var selesai = new Date(tanggalselesai.value);

  var selisih = Math.abs(selesai - mulai); // Selisih dalam milidetik

  var bulanMulai = mulai.getFullYear() * 12 + mulai.getMonth();
  var bulanSelesai = selesai.getFullYear() * 12 + selesai.getMonth();
  var durasiBulan = bulanSelesai - bulanMulai;

  durasimagang.value = durasiBulan + " bulan";
  
  if (durasiBulan < 1){
      alert("Magang tidak boleh kurang dari 1 bulan!");
      tanggalmulai.value ="";
      tanggalselesai.value ="";
      return false;
    }
    else {
      return true;
    }
}

function validateForm() {
  var selectElement = document.getElementById("programstudi").value;
  var inputTextElement = document.getElementById("jenjangpendidikan");
  var semesterElement = document.getElementById("semester");
  var semester = semesterElement.value;
  
  if (selectElement === "TI" || selectElement === "SI" || selectElement === "RPL") {
    inputTextElement.value = "S1";
    if (semester < 7) {
      semesterElement.value = "";
      alert("Jenjang pendidikan S1 minimal boleh mengikuti pemagangan pada semester 7!");
    }
  } else if (selectElement === "AKS1" || selectElement === "MAS1") {
    inputTextElement.value = "S1";
    if (semester < 7) {
      semesterElement.value = "";
      alert("Jenjang pendidikan S1 minimal boleh mengikuti pemagangan pada semester 7!");
    }
  } else if (selectElement === "AKD3" || selectElement === "MAD3" || selectElement === "MI" || selectElement === "Sekretari") {
    inputTextElement.value = "D3";
    if (semester < 5) {
      semesterElement.value = "";
      alert("Jenjang pendidikan D3 minimal boleh mengikuti pemagangan pada semester 5!");
    }
  }
}
</script>
