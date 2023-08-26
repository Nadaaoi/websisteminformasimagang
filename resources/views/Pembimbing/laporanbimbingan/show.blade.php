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
                                    <th>Aksi</th>

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
                                            <button type="button" class="btn btn-warning" title="Konfirmasi" data-toggle="modal" data-target="#konfirmasiModal{{ $p->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            @else
                                            <span class="badge bg-success">{{ $p->tandatanganpembimbing }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    <div class="modal fade" id="konfirmasiModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Tindakan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin melakukan konfirmasi terhadap bimbingan ini?
                                                    <form action="{{ route('simpan.konfirmasi') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="bimbingan_id" value="{{ $p->id }}">
                                                        <input type="hidden" name="tandatanganpembimbing" id="tandatanganpembimbing" value="DISETUJUI">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" id="konfirmasiBtn">Konfirmasi</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
