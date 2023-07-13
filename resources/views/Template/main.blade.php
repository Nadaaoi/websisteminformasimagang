@include('Template.css')
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
      @include('Template.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
           
          @yield('content')
                
          
        </div>
        {{-- footer --}}
        <footer class="py-3 bg-light mt-5">
          <div class="container-fluid px-4">
              <div class="d-flex align-items-center justify-content-center small">
                  <div class="text-muted">&copy; Universitas Bina Insani {{ date('Y') }}</div>
              </div>
          </div>
      </footer>
      </div>
      
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->

@yield('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>


$(".js-example-tags").select2({
  tags: true
});

$(document).ready(function() {
        $('.js-example-basic-single').select2();
        $(".js-example-responsive").select2({
        width: 'resolve', // need to override the changed default
        maximumSelectionLength: 3
        });

});
</script>
</body>

</html>

{{-- Dibuat dengan bangga, Nada Aura Wansa --}}

