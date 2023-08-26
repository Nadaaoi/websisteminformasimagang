@extends('pages.dashboard.layouts.main')

@section('css')
   
   <style>
       .fs-x{
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

<div class="container-fluid px-4">


    
        <h1 class="mt-4">Data Peserta</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard &raquo; Data Peserta</li>
        </ol>
        

        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                   
                    </div>
                    <div class="card-body overflow-auto">
                        <div class="row">
                            <form method="POST" action="/dashboard/data-peserta/{{ $pemagangan[0]->user_id }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                    <div class="col-sm-12">
                                       
                                     
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label mb-3">Nama</label>
                                            <div class="col-sm-4 mb-3">
                                                <input required readonly value="{{ $pemagangan[0]->nama }}" type="text" class="date-a form-control bg-white" >

                                            </div>
                                            <label class="col-sm-2 col-form-label mb-3">NPM</label>
                                            <div class="col-sm-4 mb-3">
                                                <input required readonly value="{{ $pemagangan[0]->npm }}" type="text" class="date-a form-control bg-white">

                                            </div>
                                            <label class="col-sm-2 col-form-label mb-3">Program Studi</label>
                                            <div class="col-sm-4 mb-3">
                                                <input required readonly value="{{ $pemagangan[0]->programstudi }}" type="text" class="date-a form-control bg-white">

                                            </div>
                                           
                                            <label class="col-sm-2 col-form-label">Nama PEMBIMBING</label>
                                            <div class="col-sm-4">
                                                <select id="PEMBIMBING_id" required  class="js-example-basic-single form-select text-center @error('PEMBIMBING_id') is-invalid  @enderror" name="PEMBIMBING_id">
                                                    <option selected value="">Pilih PEMBIMBING</option>
                                                    @foreach ($Pembimbing as $m)
                                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- <label class="col-sm-2 col-form-label">CP PEMBIMBING</label>
                                            <div class="col-sm-4">
                                              <input id="cp_PEMBIMBING" readonly required  value="{{ old('cp_PEMBIMBING') }}"  type="text" class="form-control bg-white @error('cp_PEMBIMBING') is-invalid  @enderror" name="cp_PEMBIMBING">
                                            </div> --}}
                                        </div>
                                    
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Rencana Waktu Magang</label>
                                            <div class="col-sm-2">
                                                <div class="form-floating">
                                                    <input readonly required value="{{ $pemagangan[0]->tanggalmulai }}" type="date" class="date-a form-control bg-white @error('rencana_waktu_mulai') is-invalid  @enderror" id="mulai" name="rencana_waktu_mulai">
                                                    <label for="floatingPassword">Waktu Mulai</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-floating">
                                                    <input required readonly value="{{ $pemagangan[0]->tanggalselesai }}" type="date" class="date-a form-control bg-white @error('rencana_waktu_selesai') is-invalid  @enderror" id="selesai" name="rencana_waktu_selesai">
                                                    <label for="floatingPassword">Waktu Selesai</label>
                                                    
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Rencana Durasi Magang</label>
                                            <div class="col-sm-3 isIn">
                                                <input required readonly type="text" value="{{ $pemagangan[0]->durasimagang }}" class="form-control bg-white  @error('rencana_durasi_magang') is-invalid  @enderror" name="rencana_durasi_magang" id="durasi">
                                                
                                            </div>
                                            <label class="col-sm-1 col-form-label">Bulan</label>
                                        </div>
                                        
                                       

                                        
                                      <div class="row mt-3 justify-content-end">
                                          <div class="col-sm-3  text-center">
                                              <button type="submit" class="btn btn-primary">Simpan</button>
                                              <a href="{{ url()->previous() }}">
                                                  <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                      Kembali
                                                  </button>
                                              </a>

                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        
                                    </div>
                            </form>
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

    $(document).ready(function (){

            $('#PEMBIMBING_id').on('change', function (){
                var selectPEMBIMBING = $('#PEMBIMBING_id').val();
                $.ajax({
                    url: "/dashboard/getPEMBIMBING/" + selectPEMBIMBING ,
                    
                    method: 'get',
                    dataType: 'json',
                    error: function(data){
                        $('#cp_PEMBIMBING').val('');
                      
                    },
                    success: function(data) {
                     
                        $('#cp_PEMBIMBING').val(data[0].no_hp);
    
                    }
                })

            })




        


     


    }) //penutup awal
    
   
</script>
@endsection