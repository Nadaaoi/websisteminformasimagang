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
                    <h2 class="mt-4">Laporan Akhir Mahasiswa</h2>
                    <h5 class="breadcrumb-item active">Dashboard &raquo; Laporan Akhir Mahasiswa</h5>
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
                                        <th>Dosen Pembimbing</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemagangan as $p)
                                    @php
                                    // Ubah query untuk mengambil model LaporanLP dengan user_id yang sesuai
                                    $laporanlp = \App\Models\laporanakhir::where('user_id', $p->user_id)->first();
                                    @endphp
                                        <tr>    
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->npm }}</td>
                                            <td>{{ $p->namapembimbing }}</td>
                                            <td>
                                                @if($laporanlp == null)
                                                    <span class="badge bg-danger">Belum Unggah</span>
                                                @else
                                                    <span class="badge bg-success">Sudah Unggah</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning" title="Lihat data" data-toggle="modal" data-target="#dataModal{{ $loop->iteration }}" data-laporanakhir="{{ $laporanlp ? $laporanlp->laporanakhir : '-' }}" data-sertifikat="{{ $laporanlp ? $laporanlp->sertifikat : '-' }}" data-nilai="{{ $laporanlp ? $laporanlp->nilai : '-' }}">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        
                                        <!-- Modal untuk menampilkan informasi Laporan Akhir, Sertifikat, dan Nilai -->
                                        <div class="modal fade" id="dataModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="dataModalLabel">Informasi Dokumen Laporan Akhir Mahasiswa</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Laporan Akhir:</strong>
                                                            @if($laporanlp)
                                                                <a target="_blank" href="{{ asset('storage/' . $laporanlp->laporanakhir) }}">{{ $laporanlp->nama }}-Nilai.pdf</a>
                                                            @else
                                                                Data not available.
                                                            @endif
                                                        </p>
                                                        <p><strong>Sertifikat:</strong>
                                                            @if($laporanlp)
                                                                <a target="_blank" href="{{ asset('storage/' . $laporanlp->sertifikat) }}">{{ $laporanlp->nama }}-Sertifikat.pdf</a>
                                                            @else
                                                                Data not available.
                                                            @endif
                                                        </p>
                                                        <p><strong>Nilai:</strong>
                                                            @if($laporanlp)
                                                                <a target="_blank" href="{{ asset('storage/' . $laporanlp->nilai) }}">{{ $laporanlp->nama }}-Nilai.pdf</a>
                                                            @else
                                                                Data not available.
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
    <script src="/js/datatables/exportlp.js"></script>

    <script>
        // Event listener untuk menampilkan data di dalam modal saat tombol diklik
        $('#dataModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var index = button.closest('tr').index(); // Ambil indeks baris dari tombol yang diklik
            var pemagangan = @json($pemagangan); // Ambil data pemagangan dari Blade ke JavaScript sebagai array JSON

            // Set data ke dalam modal berdasarkan indeks yang sesuai
            var modal = $(this);
            modal.find('#laporanAkhirData').text(pemagangan[index].laporanakhir);
            modal.find('#sertifikatData').text(pemagangan[index].sertifikat);
            modal.find('#nilaiData').text(pemagangan[index].nilai);
        });
    </script>
@endsection
