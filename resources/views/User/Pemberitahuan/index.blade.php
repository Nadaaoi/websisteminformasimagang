@extends('pages.dashboard.layouts.main')

@section('css')
   <link rel="stylesheet" href="/css/datatables/bootstrap.min.css">
   <link rel="stylesheet" href="/css/datatables/buttons.bootstrap5.min.css">
   <link rel="stylesheet" href="/css/datatables/dataTables.bootstrap5.min.css">
   <style>
       .fs-x{
            font-size: smaller;
            padding: 2px 12px;
        }
   </style>

@endsection

@section('content')

<div class="container-fluid px-4">    
  <h1 class="mt-4">Pemberitahuan</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard &raquo; Pemberitahuan</li>
  </ol>
  

  <div class="row justify-content-center mt-5 ">
      <div class="col-xl-12">
          <div class="card">
              <div class="card-header ">
             
              </div>
              <div class="card-body overflow-auto">
              <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                            
                              <th>No</th>
                              <th>Waktu</th>
                              <th>Pemberitahuan</th>
                              {{-- <th>Action</th> --}}
                          </tr>
                      </thead>
                      <tbody><?php $i=1; ?>
                        @foreach ($pemberitahuan as $p)
                            
                        <tr>
                            <td>{{ $i; }}</td>
                            <td>{{ $p->created_at }}</td>
                            {{-- <td>{{ $p->pemberitahuan }}</td> --}}
                            <td>{!! $p->pemberitahuan !!}</td>
                            
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                      </tbody>
                  </table>
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

   <script>

    $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'pdf', 'excel']
    } );
 
    } );


    </script>
    <script>
        
        $('.fs-b').click(function (){
            const max = 10;
            const textarea = $('.mb-3-dynamic textarea').length;
            if ( textarea === max){
                return false;
                };
            $('.multip').clone().appendTo('.mb-3-dynamic');
            $('.mb-3-dynamic .multip').addClass('single remove');
            $('.single .fs-b').remove();
            // $('.single').append('<div class="btn-delete-branch"><a href="#" class="remove-field"><span class="badge bg-danger">-</span></a></div>');
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
      
        })
    </script>
@endsection
