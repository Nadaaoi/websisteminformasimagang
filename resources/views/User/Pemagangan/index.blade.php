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
                <h2 class="mt-4">Pengajuan Status Pemagangan</h2>
                <h5 class="breadcrumb-item active">Dashboard &raquo; Pengajuan Status Pemagangan</h5>
            </div>
            
            <div class="card-body overflow-auto">
                <a href="{{ url('pemagangan/create') }}">
                    <button type="button" class="btn btn-primary mb-4">
                        Buat Pengajuan
                    </button>
                </a>

                <div class="row">
                    <div class="col-12">
                        <table id="example" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach ($pemagangans as $p)
                                    <tr>
                                        <td>Pengajuan ke-{{ $i }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->npm }}</td>
                                        <td>{{ $p->programstudi }}</td>
                                        <td>{{ $p->fakultas }}</td>
                                        <td>{{ $p->semester }}</td>
                                        <td>
                                            <a href="/pemagangan/show/{{ $p->slug }}" class="text-white text-decoration-none">
                                                <button type="button" class="btn btn-warning" title="Lihat data">
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
@endsection