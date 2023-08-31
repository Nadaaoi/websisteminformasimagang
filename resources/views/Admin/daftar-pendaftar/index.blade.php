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
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-4">Data Pengajuan</h2>
                <h5 class="breadcrumb-item active">Dashboard &raquo; Pengajuan</h5>
            </div>

            <div class="card-body overflow-auto">
                <div class="row">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('daftar-pendaftar.index') }}" method="GET" class="d-flex flex-column ">
                                <div class="form-group mb-2">
                                    <label for="year"><b>Tahun</b></label>
                                    <select class="form-control form-control-sm" name="year" id="year" style="width: 10%;">
                                        @for ($i = date('Y'); $i >= 2018; $i--)
                                            <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-sm btn-primary rounded-3" style="width: 10%;">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>                    
                    <div class="col-12">
                        
                        <table id="example" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    {{-- <th>Pengajuan</th> --}}
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Semester</th>
                                    <th>Pembimbing</th>
                                    <th>Status Pendaftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($us as $u)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $u->id }}</td> --}}
                                        <td>{{ $u->nama }}</td>
                                        <td>{{ $u->npm }}</td>
                                        <td>{{ $u->programstudi }}</td>
                                        <td>{{ $u->fakultas }}</td>
                                        <td>{{ $u->semester }}</td>
                                        <td>
                                            @if ($u->programmagang === 'Belummagang')
                                                <span class="badge bg-secondary">BELUM MAGANG</span>
                                            @elseif ($u->namapembimbing == '')
                                                <span class="badge bg-danger">{{ "BELUM DIINPUT" }}</span>
                                            @else
                                                <span class="badge bg-success">{{ $u->namapembimbing }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($u->programmagang === 'Belummagang')
                                                <span class="badge bg-secondary">BELUM MAGANG</span>
                                            @elseif ($u->statuspengajuan === 'TERDAFTAR')
                                                <span class="badge bg-secondary">{{ $u->statuspengajuan }}</span>
                                            @elseif ($u->statuspengajuan === 'DITERIMA')
                                                <span class="badge bg-success">{{ $u->statuspengajuan }}</span>
                                            @elseif ($u->statuspengajuan === 'TIDAK DITERIMA')
                                                <span class="badge bg-danger">{{ $u->statuspengajuan }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($u->statuspengajuan === 'TERDAFTAR')
                                                @if ($u->programmagang === 'Belummagang')
                                                <a href="/daftar-pendaftar/showbelummagang/{{ $u->slug }}" class="text-white text-decoration-none">
                                                    <button type="button" class="btn btn-warning btn-sm" title="Lihat Data">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                @else
                                                <a href="/daftar-pendaftar/edit/{{ $u->slug }}" class="text-white text-decoration-none">
                                                    <button type="button" class="btn btn-warning btn-sm" title="Edit Data">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </a>
                                                @endif
                                            @elseif ($u->statuspengajuan === 'DITERIMA'||'TIDAK DITERIMA')
                                            <a href="/daftar-pendaftar/show/{{ $u->slug }}" class="text-white text-decoration-none">
                                                <button type="button" class="btn btn-warning btn-sm" title="Lihat Data">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
<script src="/js/data-table.js"></script>
<script>

$(document).ready(function() {
var table = $('#example').DataTable( {
lengthChange: false,
buttons: [ 'pdf', 'excel']
} );

} );


</script>
<script>

$('.fs-b').click(function (){
    const max = 10;
    const textarea = $('.mb-3-dynamic textarea').length;
    if ( textarea === max){
        return false;
        };
    $('.multip').clone().appendTo('.mb-3-dynamic');
    $('.mb-3-dynamic .multip').addClass('single remove');
    $('.single .fs-b').remove();
    // $('.single').append('<div class="btn-delete-branch"><a href="#" class="remove-field"><span class="badge bg-danger">-</span></a></div>');
    $('.single').append('<div class="btn-delete-branch"><button type="button" class="remove-field btn btn-primary fs-b">-</button></div>');
    $('.mb-3-dynamic > .single').attr("class", "remove");

    $('.mb-3-dynamic textarea').each(function() {
        var count = 0;
        var fieldname = $(this).attr("name");
        $(this).attr('name', fieldname + count++);
        count++;
    });

    });

    $(document).on('click', '.remove-field', function(e) {
    $(this).parent('.btn-delete, .btn-delete-branch').parent('.remove').remove();
    e.preventDefault();

})
</script>
<style>
    @media (min-width: 576px) { /* Destop mode */
        #year {
            width: 80%;
        }
        .btn-sm {
            width: 80%;
        }
    }
</style>
@endsection