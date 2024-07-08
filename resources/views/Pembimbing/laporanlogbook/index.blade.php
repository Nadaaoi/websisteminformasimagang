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

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-4">Pengisian Log Book Mahasiswa</h2>
                <h5 class="breadcrumb-item active">Dashboard &raquo; Pengisian Log Book Mahasiswa</h5>
            </div>

            <div class="card-body overflow-auto">
                <div class="row">
                    <div class="col-12">
                        <table id="example" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Kelas</th>
                                    <th>Program Magang</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemagangan as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->npm }}</td>
                                        <td>{{ $p->kelas }}</td>
                                        <td>{{ $p->programmagang }}</td>
                                        <td>{{ $p->namapembimbing }}</td>
                                        <td>
                                                {{-- <a href="/laporanlogbook/show/{{ $p->user_id }}" class="text-white text-decoration-none"> --}}
                                                    <a href="/laporanlogbookpembimbing/show/{{ $p->user_id }}/" class="text-white text-decoration-none">
                                                    <button type="button" class="btn btn-warning" title="Lihat data">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </a>
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
