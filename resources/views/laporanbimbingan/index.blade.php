@extends('Template.main')

@section('css')
<style>
    .button-group {
        display: flex;
        flex-direction: column; /* Menampilkan tombol dalam kolom */
        align-items: center; /* Pusatkan tombol dalam kolom */
        gap: 10px; /* Jarak antar tombol */
    }

    .button-link {
        text-decoration: none;
    }

    /* Gunakan media query untuk mengatur tampilan tombol saat layar diperkecil */
    @media (max-width: 768px) {
        .button-group {
            flex-direction: row; /* Kembali ke tampilan horizontal pada layar kecil */
            align-items: flex-start; /* Pertahankan penempatan kiri atas tombol */
        }
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
                <h2 class="mt-4">Laporan Bimbingan</h2>
                <h5 class="breadcrumb-item active">Dashboard &raquo; Laporan Bimbingan</h5>
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
                                            <div class="button-group">
                                                <a href="/laporanbimbingan/show/{{ $p->user_id }}" class="button-link">
                                                    <button type="button" class="btn btn-warning" title="Lihat data">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('laporanbimbingan.showpdf', ['user_id' => $p->user_id]) }}" class="button-link">
                                                    <button type="button" class="btn btn-info" title="Unggah PDF">
                                                        <i class="bi bi-filetype-pdf"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('laporanbimbingan.showexcel', ['user_id' => $p->user_id]) }}" class="button-link">
                                                    <button type="button" class="btn btn-info" title="Unggah Excel">
                                                        <i class="bi bi-filetype-xlsx"></i>
                                                    </button>
                                                </a>
                                            </div>
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
