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
                <h2 class="mt-4">Laporan Bimbingan</h2>
                <h5 class="breadcrumb-item active">Dashboard &raquo; Laporan Bimbingan</h5>
            </div>

            <div class="card-body overflow-auto">
                <div class="row">
                    <div class="col-12">
                        <table id="example" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Pertemuan</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Deskripsi Bimbingan</th>
                                    <th>Hasil Bimbingan</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanbimbingan as $p)
                                    <tr>
                                        <td>Pertemuan ke-{{ $p->pertemuan }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->npm }}</td>
                                        <td>{{ $p->tanggalpengajuan }}</td>
                                        <td>{{ $p->deskripsibimbingan }}</td>
                                        <td>{{ $p->hasilbimbingan }}</td>
                                        <td>
                                            @if ($p->tandatanganpembimbing == null)
                                            <span class="badge bg-danger">BELUM DISETUJUI</span>
                                            @else
                                            <span class="badge bg-success">{{ $p->tandatanganpembimbing }}</span>
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
    <script src="/js/datatables/exportbimbingan.js"></script>
@endsection
