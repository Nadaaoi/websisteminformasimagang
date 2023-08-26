@include('Template.css')

<body>
    <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
    @include('Template.navbar')
    @include('Template.sidebar')
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
        @yield('container')
        @yield('content')
    {{-- @include('Template.modal') --}}
      </div>
      </div>
       <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <div class="text-muted">&copy; Universitas Bina Insani {{ date('Y') }}</div>
          </div>
        </footer>
    </div>
  </div>

  <script src="/vendors/js/vendor.bundle.base.js"></script>
  <script src="/vendors/chart.js/Chart.min.js"></script>
  <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="/js/dataTables.select.min.js"></script>
  <script src="/js/off-canvas.js"></script>
  <script src="/js/hoverable-collapse.js"></script>
  <script src="/js/template.js"></script>
  <script src="/js/settings.js"></script>
  <script src="/js/todolist.js"></script>
  <script src="/js/dashboard.js"></script>
  <script src="/js/Chart.roundedBarCharts.js"></script>
  @yield('script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(".js-example-tags").select2({
      tags: true
    });

    $(document).ready(function() {
  $('.js-example-basic-single').select2();
  $(".js-example-responsive").select2({
    width: 'resolve',
    maximumSelectionLength: 3
  });
});
</script>
</body>
</html>
{{-- Dibuat dengan bangga, Nada Aura Wansa --}}