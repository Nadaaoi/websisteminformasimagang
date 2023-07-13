@extends('Template.main')

@section('css')
    <style>
      
    </style>
@endsection

@section('content')

    <h2 class="mt-4">Tambah Data Pengguna</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Tambah Pengguna</h5>
    

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