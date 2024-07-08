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
                <h2 class="mt-4">Manajemen Pengguna</h2>
                <h5 class="breadcrumb-item active">Dashboard &raquo; Manajemen Pengguna</h5>
            </div>

            <div class="card-body overflow-auto">
                <a href="{{ url('data-pengguna/create') }}" id="tambahPenggunaButton" class="{{ Request::is('data-pengguna*') || Request::is('data-pengguna/create') ? 'active' : '' }}">
                    <button type="button" class="btn btn-primary mb-4">
                        Tambah Pengguna
                    </button>
                </a>
                

                <div class="row">
                    <div class="col-12">
                        <table id="example" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Email / Username</th>
                                    <th class="text-center">Roles</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($data_pengguna as $dp)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $dp->name }}</td>
                                        @if ($dp->email == null)
                                            <td>{{ $dp->username }}</td>
                                        @else
                                            <td>{{ $dp->email }}</td>
                                        @endif
                                        <td>{{ $dp->roles }}</td>
                                        <td>
                                            @if ($dp->roles == 'ADMIN' || $dp->roles == 'USER' || $dp->roles == 'PEMBIMBING')
                                                {{-- <a href="/data-pengguna/show/{{ $dp->id }}" class="btn btn-success text-white" title="Edit Data">
                                                    <i class="bi bi-eye"></i>
                                                </a> --}}
                                                
                                                <form style="display: inline-block;" action="{{ route('hapus.pengguna', ['user' => $dp->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-warning" title="Hapus Data" onclick="return confirm('Yakin ingin hapus data?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                        
                                                <a href="#" class="btn btn-danger text-white" title="Ubah Sandi" data-bs-toggle="modal" data-bs-target="#modalUbahSandi{{ $dp->id }}">
                                                    <i class="bi bi-unlock"></i>
                                                </a>
                                            @else
                                                -
                                            @endif

                                            @if ($dp->roles == 'PEMBIMBING')
                                                                
                                            @if ($dp->iskaprodi == '0')
                                            <button type="button" class="btn btn-success" title="Konfirmasi Kaprodi" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiKaprodi{{ $dp->id }}">
                                                <i class="bi bi-check"></i>
                                            </button>
                                                @else
                                                    <button type="button" class="btn btn-danger" title="Hapus Akses Kaprodi" data-bs-toggle="modal" data-bs-target="#modalHapusAksesKaprodi{{ $dp->id }}">
                                                    <i class="bi bi-x-circle"></i>
                                                    </button>
                                                @endif
                                            @else                           
                                            @endif
                                        </td>                                        
                                    </tr>
                                    @php $i++; @endphp


                                    <!-- Modal untuk konfirmasi "is not kaprodi" -->
                                    <div class="modal fade" id="modalHapusAksesKaprodi{{ $dp->id }}" tabindex="-1" aria-labelledby="modalHapusAksesKaprodiLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalHapusAksesKaprodiLabel">Konfirmasi Hapus Sebagai Kaprodi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin membatalkan {{ $dp->name }} sebagai Kaprodi?
                                                </div>
                                                <form id="konfirmasiForm{{ $dp->id }}" action="{{ route('konfirmasi-hapus-kaprodi', ['userId' => $dp->id]) }}" method="POST">
                                                    @csrf
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal untuk konfirmasi "is kaprodi" -->
                                    <div class="modal fade" id="modalKonfirmasiKaprodi{{ $dp->id }}" tabindex="-1" aria-labelledby="modalKonfirmasiKaprodiLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalKonfirmasiKaprodiLabel">Konfirmasi Kaprodi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="konfirmasiForm{{ $dp->id }}" action="{{ route('konfirmasi-kaprodi', ['userId' => $dp->id]) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin mengkonfirmasi {{ $dp->name }} sebagai Kaprodi?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" id="modalUbahSandi{{ $dp->id }}" tabindex="-1" aria-labelledby="modalUbahSandiLabel{{ $dp->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalUbahSandiLabel{{ $dp->id }}">Ubah Sandi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form untuk mengubah password -->
                                                    <form action="{{ route('update.password', ['user' => $dp->slug]) }}" method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">Password Baru</label>
                                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                                                            @error('password')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <button type="submit" class="btn btn-danger text-white">
                                                            <i class="bi bi-unlock"></i> Ubah Sandi
                                                        </button>
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
    <!-- Referensi untuk JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false
            });

            table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>

<script>
    function confirmDelete(id) {
        if (confirm("Yakin ingin hapus data?")) {
            // Jika pengguna mengonfirmasi, lakukan penghapusan data dengan mengarahkan ke URL destroy
            window.location.href = "/data-pengguna/destroy/" + id;
        } else {
            // Jika pengguna tidak mengonfirmasi, batalkan operasi penghapusan
            // Opsional: Anda bisa melakukan tindakan lain di sini jika diperlukan
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById("modalUbahSandi{{ $dp->id }}"));
    });
</script>
<script>
    // Menggunakan jQuery untuk menangani klik tombol "Konfirmasi"
    $('#modalKonfirmasiKaprodi{{ $dp->id }}').on('submit', 'form', function (event) {
        event.preventDefault(); // Mencegah aksi default formulir

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    alert('Konfirmasi berhasil.');
                    $('#modalKonfirmasiKaprodi{{ $dp->id }}').modal('hide');
                    // Lakukan tindakan lain jika diperlukan
                } else {
                    alert('Konfirmasi gagal.');
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat mengirim permintaan.');
            }
        });
    });
</script>
<script>
    // Menggunakan jQuery untuk menangani klik tombol "Konfirmasi"
    $('#modalHapusAksesKaprodi{{ $dp->id }}').on('submit', 'form', function (event) {
        event.preventDefault(); // Mencegah aksi default formulir

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    alert('Konfirmasi berhasil.');
                    $('#modalHapusAksesKaprodi{{ $dp->id }}').modal('hide');
                    // Lakukan tindakan lain jika diperlukan
                } else {
                    alert('Konfirmasi gagal.');
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat mengirim permintaan.');
            }
        });
    });
</script>
@endsection
