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

    <h2 class="mt-4">Manajemen Program Studi</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Manajemen Program Studi</h5>

<div class="card-body overflow-auto">
    <div class="row mt-2">
        <div class="col-sm-4">
            <select required id="select_prodi"
                class="form-control text-center @error('programstudi') is-invalid  @enderror" name="programstudi">
                <option id="pilih1" value="">Pilih Program Studi</option>
                @foreach ($programstudi as $u)
                    <option value="{{ $u->id }}">{{ $u->programstudi }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <a href="{{ url('/data-programstudi/create') }}">
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    Tambah Program Studi
                </button>
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-11 justify-content-center">
            <div class="row justify-content-end">
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <th>Nama Program Studi</th>
                            <th>Ketua Jurusan</th>
                            <th>Terakhir Diubah</th>
                        </thead>
                        <tbody class="text-center">
                            <tr class="text-center">
                                <form id="form_prodi" method="POST">
                                    @method('put')
                                    @csrf
                                    <td>
                                        <input id="programstudi" readonly required value="" type="text"
                                            class="text-center form-control bg-white @error('programstudi') is-invalid  @enderror"
                                            name="programstudi">
                                    </td>
                                    <td>
                                        <input id="kajur" readonly required value="" type="text"
                                            class="text-center form-control bg-white @error('kajur') is-invalid  @enderror"
                                            name="kajur">
                                    </td>
                                    <td>
                                        <input id="updated_at" readonly required value="" type="text"
                                            class="text-center form-control bg-white @error('') is-invalid  @enderror">
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2 text-end">
                </div>
            </div>
        </div>
        <div class="col-sm-1 button-sm">
            <button id="btn-sm" type="button" hidden class="btn btn-success"><i
                    class="bi bi-pencil-square"></i></button>
        </div>
        </form>
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
        var table = $('#example').DataTable({
            lengthChange: false

        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });

</script>
<script>
    $(document).ready(function() {

        $('#select_prodi').on('change', function() {
            var select_prodi = $('#select_prodi').val();

            $.ajax({
                url: "/getdataprogramstudis/" + select_prodi,

                method: 'get',
                dataType: 'json',
                error: function(data) {
                    $('#programstudi').val('');
                    $('#kajur').val('');
                    $('#updated_at').val('');
                    $('#btn-sm').remove();
                    $('#form').remove();
                },
                success: function(data) {
                    var date = new Date(data[0].updated_at);
                    var created_at = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate() + '  ' +
                        date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
                    $('#btn-sm').remove();
                    $('#form').remove();
                    $('#programstudi').val(data[0].programstudi);
                    $('#kajur').val(data[0].kajur);
                    $('#updated_at').val(created_at);

                    var id = data[0].id;
                    var programstudi1 = data[0].programstudi;
                    var html = '<button id="btn-sm" type="button" class="btn btn-warning mb-1"><i class="bi text-white bi-pencil-square"></i></button>';
                    var ht2 = '<form id="form" action="/data-programstudi/';
                    ht2 += id;
                    ht2 += '" method="POST">@method("delete") @csrf';
                    ht2 += '<button onclick="return ';
                    ht2 += "confirm('Apakah anda yakin menghapus data?";
                    ht2 += programstudi1;
                    ht2 += " ?') ";
                    ht2 += '" type="submit" class="btn btn-danger fs-x"> <i class="bi bi-trash"></i> </button></form>';
                    $('.button-sm').append(html)
                    $('.button-sm').append(ht2)

                    $('#form_prodi').attr('action', "/data-programstudi/" + id);

                    $('#btn-sm').on('click', function() {
                        $('#btn-sm').remove();
                        $('#form').remove();
                        $('#updated_at').val('-');
                        $('#programstudi').removeAttr('readonly');
                        $('#programstudi').attr('autofocus', 'true');
                        $('#kajur').removeAttr('readonly');
                        $('#updated_at').attr('disabled', 'disabled');
                        $('#updated_at').removeClass('bg-white');

                        var html1 = '<button id="submit-1" class="btn btn-primary mb-1"><i class="bi bi-check2-circle"></i></button>';
                        var html2 = '<button id="btn-x" type="button" class="btn btn-danger"><i class="bi bi-x"></i></button>';
                        $('.button-sm').append(html1)
                        $('.button-sm').append(html2)
                        $('#submit-1').attr('type', 'submit')

                        $('#submit-1').on('click', function() {
                            $('#form_prodi').submit()
                        })
                        $('#btn-x').on('click', function() {
                            location.reload(true)
                        })
                    })
                }
            })
        })
    })

</script>
@endsection
