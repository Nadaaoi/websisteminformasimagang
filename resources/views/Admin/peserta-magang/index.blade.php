@extends('pages.dashboard.layouts.main')

@section('css')
   <link rel="stylesheet" href="/css/datatables/bootstrap.min.css">
   <link rel="stylesheet" href="/css/datatables/buttons.bootstrap5.min.css">
   <link rel="stylesheet" href="/css/datatables/dataTables.bootstrap5.min.css">
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


    
        <h1 class="mt-4"> Daftar Peserta Magang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard &raquo; Peserta Magang</li>
        </ol>
        @if (session()->has('success'))
      
        <script>
        alert('{{ session('success') }}')
      </script>
      
        @endif
        

        <div class="row justify-content-center ">
            <div class="col-xl-12 mt-3">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body overflow-auto">

                        <a href="{{ url('dashboard/peserta-magang/create') }}">
                            {{-- <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              Tambah Peserta Magang
                            </button> --}}
                            
                          </a>
                       
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr> <?php $i = 1; ?>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Semester</th>
                                    <th>Status Magang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesertamagang as $d)
                                    
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->npm }}</td>
                                    <td>{{ $d->programstudi }}</td>
                                    <td>{{ $d->fakultas }}</td>
                                    <td>{{ $d->semester }}</td>
                                    <td><span class="badge bg-success">{{ $d->status_akun }}</span></td>
                                    <td>

                                        @if ($d->status_akun == 'DITERIMA')
                                            <a href="/dashboard/data-peserta/{{ $d->slug }}/edit" class=" text-white text-decoration-none">
                                                <button type="button" class="text-white btn btn-warning fs-x">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </a> 
                                            
                                        @endif
                                        <a href="/dashboard/peserta-magang/{{ $d->slug }}" class="text-white text-decoration-none"> 
                                            <button type="button" class="btn btn-primary  fs-x">
                                              <i class="bi bi-eye"></i>
                                            </button>
                                          </a>
                                       
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach

                                
                            </tbody>
                           
                        </table>
                    </div>
                  </div>
                
            </div>
            
            
        </div> 
   
</div>


    
@endsection








@section('script')

    {{-- Datatables --}}
    <script src="/js/datatables/jquery-3.5.1.js"></script>
    <script src="/js/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/datatables/dataTables.bootstrap5.min.js"></script>
    <script src="/js/datatables/dataTables.buttons.min.js"></script>
    <script src="/js/datatables/buttons.bootstrap5.min.js"></script>
    <script src="/js/datatables/jszip.min.js"></script>
    <script src="/js/datatables/pdfmake.min.js"></script>
    <script src="/js/datatables/vfs_fonts.js"></script>
    <script src="/js/datatables/buttons.html5.min.js"></script>
   <script src="/js/datatables/buttons.colVis.min.js"></script>
   <script src="/js/datatables/buttons.print.min.js"></script>

   <script>

    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: false
           
        } );
     
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
            
    } );

    </script>
  
@endsection