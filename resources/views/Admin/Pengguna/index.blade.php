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
                <h2 class="mt-4">Data Pengguna</h2>
                <h5 class="breadcrumb-item active">Dashboard &raquo; Data Pengguna</h5>
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
                                        </td>                                        
                                    </tr>
                                    @php $i++; @endphp

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
@endsection
