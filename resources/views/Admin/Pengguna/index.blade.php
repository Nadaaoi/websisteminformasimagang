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

    <h2 class="mt-4">Data Pengguna</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Data Pengguna</h5>
    

    @if (session()->has('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

                <div class="card-body overflow-auto">
                    <a href="{{ url('data-pengguna/create') }}">
                        <button type="button" class="btn btn-primary mb-4">
                            Tambah Pengguna
                        </button>
                    </a>
                    <table id="example" class="table table-striped text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email / Username</th>
                                <th class="text-center">Roles</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Ubah Password</th>
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
                                            <a href="/dashboard/data-pengguna/{{ $dp->slug }}/edit"
                                                class="text-white text-decoration-none">
                                                <button type="button" class="btn btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    @if ($dp->roles == 'PEMBIMBING' || $dp->roles == 'ADMIN')
                                        <td>
                                            <button type="button" onclick="ubahPassword(this)" class="btn btn-warning"
                                                data-slug="{{ $dp->slug }}" data-emailuser="{{ $dp->username }}"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Kata Sandi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="actionUbah">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="">Username / Email</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input readonly id="emailuser" type="text" class="bg-white form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="">Kata Sandi Baru</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input name="password" id="password" type="password"
                                                    class="bg-white form-control">
                                                <input type="checkbox" onclick="myFunction()"> Lihat Kata Sandi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- akhir modal --}}
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

            table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        });

        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function ubahPassword(data2) {
            var slug = data2.getAttribute("data-slug");
            var emailuser = data2.getAttribute("data-emailuser");
            $('#emailuser').val(emailuser);
            $('#actionUbah').attr('action', '/dashboard/data-pengguna/update-password/' + slug);
        }

        $('.fs-b').click(function() {
            const max = 10;
            const textarea = $('.mb-3-dynamic textarea').length;
            if (textarea === max) {
                return false;
            };
            $('.multip').clone().appendTo('.mb-3-dynamic');
            $('.mb-3-dynamic .multip').addClass('single remove');
            $('.single .fs-b').remove();
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
        });
    </script>
@endsection
