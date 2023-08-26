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

    <h2 class="mt-4">Pengajuan Status Pemagangan</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Informasi Pemagangan</h5>

    <div class="card-body overflow-auto">
        <div class="col-sm-12">
          <h4 class="mb-4">Data Mahasiswa</h4>

          {{-- Nama --}}
          <div class="row">
            <div class="col-sm-6 mb-4">
              <label for="basic-icon-default-company" class="mb-2"><strong>Nama Lengkap</strong></label>
              <div class="input-group input-group-merge">         
                <input
                  required
                  readonly
                  class="form-control @error('nama') is-invalid @enderror"
                  type="text"
                  id="nama"
                  name="nama"
                  value="{{ $us[0]->nama }}"
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
                  readonly
                  class="form-control @error('npm') is-invalid @enderror"
                  type="number"
                  id="npm"
                  name="npm"
                  value="{{ $us[0]->npm }}"
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
                  value="{{ $us[0]->tanggalpengajuan }}"
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
                <input readonly id="fakultas" name="fakultas" class="form-control @error('fakultas') is-invalid @enderror" value="{{ $us[0]->fakultas }}">
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
                  value="{{ $us[0]->semester }}"
                  readonly
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
                <input value="{{ $us[0]->programstudi }}" readonly id="programstudi" name="programstudi" class="form-control @error('programstudi') is-invalid @enderror" required onchange="validateForm()">
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
                <input readonly value="{{ $us[0]->jenjangpendidikan }}" type="text" id="jenjangpendidikan" placeholder="cth: S1" name="jenjangpendidikan" class="form-control @error('jenjangpendidikan') is-invalid @enderror" required>
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
                <input readonly value="{{ $us[0]->tahunmasuk }}" id="tahunmasuk" placeholder="cth: 2020" name="tahunmasuk" class="form-control @error('tahunmasuk') is-invalid @enderror" type="number" required>
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
                  readonly
                  value="{{ $us[0]->kelas }}"
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
                  readonly
                  value="{{ $us[0]->ipk }}"
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
                  readonly
                  value="{{ $us[0]->nohp }}"
                  type="number"
                  id="nohp"
                  name="nohp"
                  class="form-control @error('nohp') is-invalid @enderror"
                  value="{{ $us[0]->nohp }}"
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
                  value="{{ $us[0]->email }}"
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
                <input readonly value="{{ $us[0]->programmagang }}" id="programmagang" name="programmagang" class="form-control @error('programmagang') is-invalid @enderror" required onchange="showAdditionalInput()">
                @error('programmagang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            
          </div>
        </div>
                <div class="col-sm-12" id="additionalInput" style="display: block;">
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
                    aria-describedby="basic-icon-default-company2"
                    readonly
                    value="<?= ($us[0]->namaperusahaan == null) ? '-' : $us[0]->namaperusahaan?>"
                    />
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
                        readonly
                        type="text"
                        id="posisi"
                        name="posisi"
                        class="form-control @error('posisi') is-invalid @enderror"
                        placeholder="cth: Technical Writer"
                        aria-describedby="basic-icon-default-company2"
                        value="<?= ($us[0]->posisi == null) ? '-' : $us[0]->posisi?>"
                        />
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
                          readonly
                            onchange="updateDurasi()"
                            type="date"
                            id="tanggalmulai"
                            name="tanggalmulai"
                            class="form-control @error('tanggalmulai') is-invalid @enderror"
                            aria-describedby="basic-icon-default-company2"
                            value="<?= ($us[0]->tanggalmulai == null) ? '-' : $us[0]->tanggalmulai?>"
                            />
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
                              readonly
                                onchange="updateDurasi()"
                                type="date"
                                id="tanggalselesai"
                                name="tanggalselesai"
                                class="form-control @error('tanggalselesai') is-invalid @enderror"
                                aria-describedby="basic-icon-default-company2"
                                value="<?= ($us[0]->tanggalselesai == null) ? '-' : $us[0]->tanggalselesai?>"
                                />
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
                                  readonly
                                    type="text"
                                    id="durasimagang"
                                    name="durasimagang"
                                    class="form-control @error('durasimagang') is-invalid @enderror"
                                    aria-describedby="basic-icon-default-company2"
                                    readonly
                                    value="<?= ($us[0]->durasimagang == null) ? '-' : $us[0]->durasimagang?>"
                                    />
                                            @error('durasimagang')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                          @enderror
                                          </div>
                                    </div>
                            </div>
                            </div>

                            <div class="col-sm-12" id="BelumMagang">
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
                                  readonly
                                  value="<?= ($us[0]->alasanbelummagang == null) ? '-' : $us[0]->alasanbelummagang?>"
                                  />
                                          @error('alasanbelummagang')
                                          <div class="invalid-feedback">
                                          {{ $message }}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>  

                                  <div class="col-sm-12">
                                    <h4 class="mb-4">Dokumen</h4>
                                </div>
                                
                                <div class="col-sm-4 mb-4">
                                    <label for="basic-icon-default-company" class="mb-2"><strong>Surat Bukti Penerimaan</strong></label>
                                    <div class="input-group input-group-merge">
                                        @if ($us[0]->programmagang === "Belummagang")
                                        <p>-</p>
                                        @else
                                        <a target="_blank" href="{{ asset('storage/' . $us[0]->buktipenerimaan) }}">
                                            {{ $us[0]->nama }}-buktipenerimaan.pdf</a>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-sm-4 mb-4">
                                    <label for="basic-icon-default-company" class="mb-2"><strong>Transkrip Nilai</strong></label>
                                    <div class="input-group input-group-merge">
                                        @if ($us[0]->programmagang === "Belummagang")
                                        <p>-</p>
                                        @else
                                        <a target="_blank" href="{{ asset('storage/' . $us[0]->transkrip_nilai) }}">
                                            {{ $us[0]->nama }}-transkripnilai.pdf</a>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-sm-4 mb-4">
                                    <label for="basic-icon-default-company" class="mb-2"><strong>Kartu Mahasiswa</strong></label>
                                    <div class="input-group input-group-merge">
                                        @if ($us[0]->programmagang === "Belummagang")
                                        <p>-</p>
                                        @else
                                        <a target="_blank" href="{{ asset('storage/' . $us[0]->kartumahasiswa) }}">
                                            {{ $us[0]->nama }}-kartumahasiswa.pdf</a>
                                        @endif
                                    </div>
                                </div>
                                

                        <div class="row mt-5 justify-content-end">
                          <div class="col-sm-3  text-center">
                            <a href="{{ url()->previous() }}">
                          <button type="button" class="btn btn-secondary">Kembali</button>
                            </a>
                          </div>
                        </div>
@endsection

@section('script')
<script src="/js/datatables/jquery-3.5.1.js"></script>
@endsection