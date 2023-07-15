@extends('pages.dashboard.layouts.main')



@section('content')

<div class="container-fluid px-4">    
<h1 class="mt-4">
  Pengisian Status Pemagangan
</h1>

@if ($message = Session::get('success'))
        <div style="color: green">{{ $message }}</div>
    @endif
    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item active">Dashboard &raquo; Pemagangan</li>
</ol>
   
<div class="col-xl-12">
  <div class="card">
      <div class="card-header bg-white">
        
      </div>
      <div class="card-body overflow-auto">
        
         
          <div class="col-sm-12">
            <h4 class="mb-4">Data Mahasiswa</h4>
      
            {{-- nama --}}
            <div class="row">
            <div class="col-sm-6 mb-4">
            <label for="basic-icon-default-fullname"class="mb-2"><strong>Nama Lengkap</strong></label>
            <div class="input-group input-group-merge"> 
              <input
                required
                readonly
                type="text"
                class="form-control @error('nama') is-invalid @enderror"
                id="nama"
                name="nama"
                placeholder="cth: Muhammad Aldisyah"
                value="{{ $us[0]->nama }}"
                aria-describedby="basic-icon-default-fullname2"
                required/>      
            </div>
            @error('nama')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
            @enderror
          </div>

          {{-- NPM --}}
          <div class="col-sm-6 mb-4">
            <label for="basic-icon-default-company"class="mb-2"><strong>Nomor Pokok Mahasiswa</strong></label>
            <div class="input-group input-group-merge">         
              <input
                 readonly
                required
                class="form-control @error('npm') is-invalid @enderror"
                type="number"
                id="npm"
                name="npm"
                placeholder="cth: 20183100xx"
                aria-describedby="basic-icon-default-company2"
                value="{{ $us[0]->npm }}"
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
              <label for="basic-icon-default-company"class="mb-2"><strong>Tanggal Pengisian</strong></label>
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
                  value="{{ $us[0]->tanggalpengajuan }}"
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
              <label for="basic-icon-default-company"class="mb-2"><strong>Fakultas</strong></label>
              <div class="input-group input-group-merge">
                <input readonly id="fakultas" name="fakultas" class="form-control @error('fakultas') is-invalid @enderror"  required  value="{{ $us[0]->fakultas }}">
              @error('fakultas')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
                </div>
            </div>
            </div>

                {{-- Semester --}}
                <div class="row">

                  <div class="col-sm-4 mb-4">
                    <label for="basic-icon-default-company"class="mb-2"><strong>Semester</strong></label>
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
                        readonly
                        value="{{ $us[0]->semester }}"
                        />

                        @error('semester')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                      @enderror

                      {{-- Program Studi --}}
                    </div>
                    </div>
                    <div class="col-sm-4 mb-4">
                      <label for="basic-icon-default-company"class="mb-2"><strong>Program Studi</strong></label>
                      <div class="input-group input-group-merge"> 
                        <input readonly id="programstudi" name="programstudi" class="form-control @error('programstudi') is-invalid @enderror" required onchange="validateForm()" value="{{ $us[0]->programstudi }}" >
                      @error('programstudi')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                          </div>
                    </div>

                    {{-- jenjangpendidikan --}}
                    <div class="col-sm-4 mb-4">
                      <label for="basic-icon-default-company"class="mb-2"><strong>Jenjang Pendidikan</strong></label>
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
                      <label for="basic-icon-default-company"class="mb-2"><strong>Tahun Masuk</strong></label>
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
                        <label for="basic-icon-default-company"class="mb-2"><strong>Kelas</strong></label>
                        <div class="input-group input-group-merge">
                          <input
                          required
                            type="text"
                            id="kelas"
                            name="kelas"
                            class="form-control @error('kelas') is-invalid @enderror"
                            placeholder="cth: TI-19A"
                            aria-describedby="basic-icon-default-company2"
                            readonly
                            value="{{ $us[0]->kelas }}"/>

                            @error('kelas')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                          @enderror

                        </div>
                        </div>
                      
                        {{-- IPK --}}
                        <div class="col-sm-4 mb-4">
                          <label for="basic-icon-default-company"class="mb-2"><strong>IPK</strong></label>
                          <div class="input-group input-group-merge">
                            <input
                            required
                              type="number"
                              max="4"
                              min="1"
                              id="ipk"
                              name="ipk"
                              class="form-control @error('ipk') is-invalid @enderror"
                              placeholder="cth: 3.50"
                              aria-describedby="basic-icon-default-company2"
                              readonly
                              value="{{ $us[0]->ipk }}"/>

                              @error('ipk')
                            <div class="invalid-feedback">
                            {{ $message }}


                            </div>
                          @enderror

                          </div>
                          </div>

                          {{-- No hp --}}
                          <div class="col-sm-4 mb-4">
                            <label for="basic-icon-default-company"class="mb-2"><strong>No Handphone</strong></label>
                            <div class="input-group input-group-merge">
                      
                            <input
                            required
                              type="number"
                              id="nohp"
                              name="nohp"
                             class="form-control @error('nohp') is-invalid @enderror"
                              placeholder="cth: 0851 xxxx xxxx"
                              aria-describedby="basic-icon-default-company2"
                              readonly
                              value="{{ $us[0]->nohp }}"/>
                              
                              @error('nohp')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                          @enderror

                          </div>
                          </div>

                          {{-- E-mail --}}
                          <div class="col-sm-4 mb-4">
                            <label for="basic-icon-default-company"class="mb-2"><strong>E-mail</strong></label>
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
                                readonly
                                value="{{ $us[0]->email }}"/>

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
                            <input readonly id="programmagang" name="programmagang" class="form-control @error('programmagang') is-invalid @enderror"
                            required onchange="showAdditionalInput()" value="{{ $us[0]->programmagang }}">

                          @error('programmagang')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror

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
                                <tr>
                                  <td><a target="_blank" href="{{ asset('storage/' . $us[0]->buktipenerimaan) }} ">
                                    {{ $us[0]->nama }}-buktipenerimaan.pdf</a></td>
                                </tr>
                              </div>
                              </div>

                              <div class="col-sm-4 mb-4">
                                <label for="basic-icon-default-company" class="mb-2"><strong>Transkrip Nilai</strong></label>
                                <div class="input-group input-group-merge">
                                <tr>
                                  <td><a target="_blank" href="{{ asset('storage/' . $us[0]->transkrip_nilai) }} ">
                                    {{ $us[0]->nama }}-transkripnilai.pdf</a></td>
                                </tr>
                              </div>
                              </div>

                              <div class="col-sm-4 mb-4">
                                <label for="basic-icon-default-company" class="mb-2"><strong>Kartu Mahasiswa</strong></label>
                                <div class="input-group input-group-merge">
                                <tr>
                                  <td><a target="_blank" href="{{ asset('storage/' . $us[0]->kartumahasiswa) }} ">
                                    {{ $us[0]->nama }}-kartumahasiswa.pdf</a></td>
                                </tr>
                              </div>
                              </div>
                      </div>
                      </div>
              
                                      </div>
                                      <div class="row mt-5 justify-content-end">
                                        <div class="col-sm-3  text-center">
                                            <button type="submit" class="btn btn-success">Simpan</button>
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
    </div>
  </div>
</div>
</div>

@endsection

@section('script')

<script src="/js/datatables/jquery-3.5.1.js"></script>
<script>
 
</script>
    
@endsection