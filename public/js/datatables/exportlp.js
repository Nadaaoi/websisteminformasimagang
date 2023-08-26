$(document).ready(function() {
    var table = $('#example').DataTable({
        lengthChange: false,
        buttons: ['pdf', 'excel']
    });

    // Tambahkan event listener untuk tombol PDF
    table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    table.button(0).action(function(e, dt, node, config) {
        e.preventDefault();
        window.location.href = '/export/pdf/laporanlp';
    });

    // Tambahkan event listener untuk tombol Excel
    table.button(1).action(function(e, dt, node, config) {
        e.preventDefault();
        window.location.href = '/export/excel/laporanlp';
    });
});
