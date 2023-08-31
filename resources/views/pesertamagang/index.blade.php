@extends('Template.main')

@section('css')
    <!-- Tambahkan link CSS untuk DataTables di sini -->
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

<style>
    .form-control-sm {
        width: 10%; /* Ukuran normal untuk tampilan desktop */
    }

    .btn-sm {
        width: 10%; /* Ukuran normal untuk tampilan desktop */
    }

    @media (max-width: 576px) { /* Atur ukuran untuk tampilan dengan lebar maksimum 576px (ukuran layar kecil seperti smartphone) */
        .form-control-sm {
            width: 50%; /* Ukuran yang lebih besar untuk tampilan mobile */
        }

        .btn-sm {
            width: 50%; /* Ukuran yang lebih besar untuk tampilan mobile */
        }
    }
</style>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-4">Peserta Magang {{ $selectedYear }}</h2>
                <h5 class="breadcrumb-item active">Dashboard &raquo; Peserta Magang</h5>
            </div>

            <div class="card-body overflow-auto">
                <div class="row">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('pesertamagang.index') }}" method="GET">
                                <label for="year"><b>Tahun</b></label>
                                <select class="form-control form-control-sm" name="year" id="year">
                                    @for ($i = date('Y'); $i >= 2018; $i--)
                                        <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }} class="text-center">{{ $i }}</option>
                                    @endfor
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary mt-2 rounded-3">Filter</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12">
                        <table id="example" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Program Studi</th>
                                    <th>Fakultas</th>
                                    <th>Dosen Pembimbing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesertamagang as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->npm }}</td>
                                        <td>{{ $p->programstudi }}</td>
                                        <td>{{ $p->fakultas }}</td>
                                        <td>{{ $p->namapembimbing }}</td>
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
    <!-- Tambahkan link untuk script DataTables di sini -->
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
        $('#example').DataTable({
            lengthChange: false,
            buttons: ['pdf', 'excel']
        });
    });
    </script>
@endsection
