@extends('Template.main')

@section('css')
<link rel="stylesheet" href="/css/datatables/bootstrap.min.css">
<link rel="stylesheet" href="/css/datatables/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="/css/datatables/dataTables.bootstrap5.min.css">
<style>
    /* Ganti ukuran font pada kalender */
    #calendar {
        font-size: 12px; /* Ganti dengan ukuran font yang diinginkan */
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

<div>
    <h2 class="font-weight-bold">Halo, <span class="text-primary">{{ Auth::user()->name }} !</span></h2>
    <h5 class="breadcrumb-item active">
        Selamat datang di website sistem informasi kerja praktik mahasiswa
        <span class="text-primary">Universitas Bina Insani!</span>
    </h5>
    <div class="div-with-margin mb-3">
        <!-- Konten elemen div -->
    </div>
</div>

@if (Auth::user()->roles == 'ADMIN' || Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'PEMBIMBING')
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card position-relative">
      <div class="card-body">
        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                  <div class="ml-xl-4 mt-3">
                  <p class="card-title">Informasi Kerja Praktik</p>
                    <h2 class="text-primary">Universitas</h2>
                    <h3 class="font-weight-500 mb-xl-4 text-primary">Bina Insani</h3>
                    <p class="mb-2 mb-xl-0">Pemagangan yang diberlakukan Universitas Bina Insani yaitu Magang Reguler, MAGENTA (Magang Gerenasi Bertalenta) dan MSIB (Magang Studi Independen Bersertifikat).</p>
                  </div>  
                  </div>
                <div class="col-md-12 col-xl-9">
                  <div class="row">
                    <div class="col-md-6 border-right">
                      <div class="table-responsive mb-3 mb-md-0 mt-3">
                        <table class="table table-borderless report-table">

                          <tr>
                            <td class="text-muted">MSIB</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $MSIBCount*100 }}%" aria-valuenow="{{ $MSIBCount }}" aria-valuemin="0" aria-valuemax="{{ $diterimaCount }}"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">{{ $MSIBCount }}</h5></td>
                          </tr>

                          <tr>
                            <td class="text-muted">MAGENTA</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $MAGENTACount*100 }}%" aria-valuenow="{{ $MAGENTACount }}" aria-valuemin="0" aria-valuemax="{{ $diterimaCount }}"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">{{ $MAGENTACount }}</h5></td>
                          </tr>

                          <tr>
                            <td class="text-muted">Magang Reguler</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">

                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $MagangregulerCount*100 }}%" aria-valuenow="{{ $MagangregulerCount }}" aria-valuemin="0" aria-valuemax="{{ $diterimaCount }}"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">{{ $MagangregulerCount }}</h5></td>
                          </tr>

                          <tr>
                            <td class="text-muted">Belum Magang</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $BelumMagangCount*100 }}%" aria-valuenow="{{ $BelumMagangCount }}" aria-valuemin="0" aria-valuemax="{{ $diterimaCount }}"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">{{ $BelumMagangCount }}</h5></td>
                          </tr>

                          <tr>
                            <td colspan="3">
                              <hr style="border-top: 1px solid #ccc;">
                            </td>
                          </tr>

                          <tr>
                            <td class="text-muted">Status Diterima</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $diterimaCount*100 }}%" aria-valuenow="{{ $diterimaCount }}" aria-valuemin="0" aria-valuemax="{{ $mahasiswaCount }}"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">{{ $diterimaCount }}</h5></td>
                          </tr>

                          <tr>
                            <td class="text-muted">Status Masih Proses</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $terdaftarCount*100 }}%" aria-valuenow="{{ $terdaftarCount }}" aria-valuemin="0" aria-valuemax="{{  $mahasiswaCount  }}"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">{{ $terdaftarCount }}</h5></td>
                          </tr>

                        </table>
                      </div>
                    </div>
                    <div class="col-md-6 mt-3">
                      <canvas id="north-america-chart"></canvas>
                      <div id="north-america-legend"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title">Informasi Status Mahasiswa</p>
        <p class="font-weight-500">Jumlah total data ini merupakan data yang diambil berdasarkan seluruh data terinput dalam website ini.</p>
        <div class="d-flex flex-wrap mb-5">
          <div class="mr-5 mt-3">
            <p class="text-muted">Jumlah Mahasiswa</p>
            <h3 class="text-primary fs-30 font-weight-medium">{{ $mahasiswaCount }} Orang</h3>
          </div>
          <div class="mr-5 mt-3">
            <p class="text-muted">Status Diterima</p>
            <h3 class="text-primary fs-30 font-weight-medium">{{ $diterimaCount }} Orang</h3>
          </div> 
          <div class="mr-5 mt-3">
            <p class="text-muted">Status Ditolak</p>
            <h3 class="text-primary fs-30 font-weight-medium">{{ $tidakditerimaCount }} Orang</h3>
          </div>
          <div class="mr-5 mt-3">
            <p class="text-muted">Status Terdaftar</p>
            <h3 class="text-primary fs-30 font-weight-medium">{{ $terdaftarCount }} Orang</h3>
          </div>
          
        </div>
        {{-- <canvas id="order-chart"></canvas> --}}
      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
       <div class="d-flex justify-content-between">
        <p class="card-title">Bar Chart Pemagangan</p>
       </div>
        <p class="font-weight-500">Jumlah total data ini merupakan data yang diambil berdasarkan mahasiswa per-Fakultas yang sudah aktif dalam pemagangan.</p>
        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
        
        <!-- Display Informatika Data -->
        <div style="display: none;">
          <h3>Informatika Data:</h3>
          <ul>
            @foreach($informatikaData as $data)
            <li>{{ $data }}</li>
            @endforeach
          </ul>
        </div>

        <!-- Hide Bisnis Data -->
        <div style="display: none;">
          <h3>Bisnis Data:</h3>
          <ul>
            @foreach($bisnisData as $data)
            <li>{{ $data }}</li>
            @endforeach
          </ul>
        </div>
        
        <div>
          <label for="selectGroup">Pilih Fakultas:</label>
          <select id="selectGroup">
            <option value="informatika" selected>Informatika</option>
            <option value="bisnis">Bisnis</option>
          </select>
        </div>
        <canvas id="sales-chart" width="800" height="400"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body overflow-auto">
            <p class="card-title">Tabel Data Pemagangan Aktif</p>
              <div class="row">
                  <div class="col-12">
                      <table id="example" class="display expandable-table" style="width:100%">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Nama Mahasiswa</th>
                                  <th>NPM</th>
                                  <th>Program Studi</th>
                                  <th>Kelas</th>
                                  <th>IPK</th>
                                  <th>Program Magang</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($pemaganganaktif as $p)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $p->nama }}</td>
                                      <td>{{ $p->npm }}</td>
                                      <td>{{ $p->programmagang }}</td>
                                      <td>{{ $p->kelas }}</td>
                                      <td>{{ $p->ipk }}</td>
                                      <td>{{ $p->programmagang }}</td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endif


{{-- user --}}
 @if (Auth::user()->roles == 'USER')
 <div class="row">

    <!-- Kolom pertama -->
    <div class="col-md-5">
        <!-- Card Light2 Green -->
        <div class="card card-light2-green mt-4">
           <div class="card-body">
               <h4 class="mb-4">Durasi Magang</h4>
               @if (Auth::user()->status_akun == 'DITERIMA')
               <h5 class="fs-29 mb-4">{{ $dateRange }}</h5>
               <p>Waktu magangmu mulai {{ $dateRangedetail }}</p>
               @else
               <h5 class="fs-29 mb-4">-</h5>
               <p>Waktu magangmu mulai -</p>
               @endif
           </div>
       </div>

       <!-- Card Green -->
       <div class="card card-green mt-4">
           <div class="card-body">
               <h4 class="mb-4">Jumlah Log Book Terinput</h4>
               <p class="fs-30 mb-4">{{ $logbookCount}} Hari</p>
               <p>Isi selalu log book mu setiap hari kerja ya!</p>
           </div>
       </div>

       <!-- Card Light Green -->
       <div class="card card-light-green mt-4">
           <div class="card-body">
               <h4 class="mb-4">Jumlah Bimbingan Terinput</h4>
               <p class="fs-30 mb-4">{{ $bimbinganCount}} Pertemuan</p>
               <p>Isi terus bimbingan mu ketika selesai melakukan bimbingan!</p>
           </div>
       </div>
   </div>

    <!-- Kolom kedua -->
    <div class="col-md-7 mt-4">
        <!-- Card Status Pengajuan Magang -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="card-title">Status Pengajuan Magang Kamu</p>
                <h2 class="text-primary mb-4">{{ Auth::user()->status_akun }}</h2>
                @if (Auth::user()->status_akun == 'TERDAFTAR')
                <p class="mb-2 mb-md-0"><strong>Silahkan untuk ajukan status dan menunggu konfirmasi dari bagian pendidikan ya.</strong></p>
                @endif

                @if (Auth::user()->status_akun == 'DITERIMA')
                <p class="mb-2 mb-md-0"><strong>Silahkan untuk mengisi logbook dan form bimbingan secara berkala.</strong></p>
                @endif

                @if (Auth::user()->status_akun == 'TIDAK DITERIMA')
                <p class="mb-2 mb-md-0"><strong>Silahkan ajukan status kembali dan perhatikan syarat yang kurang!</strong></p>
                @endif
                <!-- Tampilkan jumlah logbook di bawah status pengajuan -->
            </div>
        </div>
    
        <!-- Tambahkan kalender di sini -->
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection


@section('script')
<script src="dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      });
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id', // Tentukan bahasa Indonesia sebagai lokal
            events: '/get_events', // URL untuk mengambil data acara dari server
        });
        
        // Mengganti warna tanda "Next Month" menjadi biru
        calendar.on('datesRender', function (info) {
            var nextButton = calendarEl.querySelector('.fc-next-button');
            if (nextButton) {
                var icon = nextButton.querySelector('.fc-icon');
                if (icon) {
                    icon.style.color = 'green';
                }
            }
        });
        
        calendar.render();
    });
</script>

<script>
  // Fungsi untuk membuat Chart fakultas informatika
  function createSalesChartForInformatika() {
    var SalesChartCanvas = $("#sales-chart").get(0).getContext("2d");
    SalesChart = new Chart(SalesChartCanvas, {
      type: 'bar',
      data: {
        labels: ["Informatika"],
        datasets: [
          // Data dataset untuk Informatika
          {
            label: 'TI',
            data: [{{ $informatikaData[0] }}],
            backgroundColor: '#00923F'
          },
          {
            label: 'SI',
            data: [{{ $informatikaData[1] }}],
            backgroundColor: '#009272'
          },
          {
            label: 'MI',
            data: [{{ $informatikaData[2] }}],
            backgroundColor: '#006b92'
          },
          {
            label: 'RPL',
            data: [{{ $informatikaData[3] }}],
            backgroundColor: '#002e92'
          }
        ],
      },

    });
    document.getElementById('sales-legend').innerHTML = SalesChart.generateLegend();
  }

  // Fungsi untuk membuat Chart fakultas bisnis
  function createSalesChartForBisnis() {
    var SalesChartCanvas = $("#sales-chart").get(0).getContext("2d");
    SalesChart = new Chart(SalesChartCanvas, {
      type: 'bar',
      data: {
        labels: ["Bisnis"],
        datasets: [
          // Data dataset untuk Bisnis
          {
            label: 'AKS1',
            data: [{{ $bisnisData[0] }}],
            backgroundColor: '#00923F'
          },
          {
            label: 'MAS1',
            data: [{{ $bisnisData[1] }}],
            backgroundColor: '#009272'
          },
          {
            label: 'AKD3',
            data: [{{ $bisnisData[2] }}],
            backgroundColor: '#006b92'
          },
          {
            label: 'MAD3',
            data: [{{ $bisnisData[3] }}],
            backgroundColor: '#002e92'
          },
          {
            label: 'AP',
            data: [{{ $bisnisData[4] }}],
            backgroundColor: '#7a0092'
          }
        ],
      },
      options: {
        // Pengaturan lainnya sesuai kebutuhan
      }
    });
    document.getElementById('sales-legend').innerHTML = SalesChart.generateLegend();
  }

  document.getElementById('selectGroup').addEventListener('change', function() {
    var selectedJurusan = this.value;
    
    // Hapus chart yang sudah ada (jika ada)
    if (typeof SalesChart !== 'undefined') {
      SalesChart.destroy();
    }

    // Buat chart baru sesuai dengan pilihan jurusan
    if (selectedJurusan === 'informatika') {
      createSalesChartForInformatika();
    } else if (selectedJurusan === 'bisnis') {
      createSalesChartForBisnis();
    }
  });

  // Panggil fungsi untuk membuat Chart fakultas informatika saat halaman dimuat
  createSalesChartForInformatika();
</script>

<script>
  var MSIBCount = @json($MSIBCount);
  var MAGENTACount = @json($MAGENTACount);
  var MagangregulerCount = @json($MagangregulerCount);
  var BelumMagangCount = @json($BelumMagangCount);

    if ($("#north-america-chart").length) {
      var areaData = {
        labels: ["MSIB", "MAGENTA", "Reguler", "Belum Magang"],
        datasets: [{
            data: [MSIBCount, MAGENTACount, MagangregulerCount, BelumMagangCount],
            backgroundColor: [
               "#00923F","#FFC100", "#248AFD", "#FF4747",
            ],
            borderColor: "rgba(0,0,0,0)"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 78,
        elements: {
          arc: {
              borderWidth: 4
          }
        },      
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        legendCallback: function(chart) { 
          var text = [];
          text.push('<div class="report-chart">');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0">MSIB</p></div>');
            text.push('<p class="mb-0">88333</p>');
            text.push('</div>');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0"MAGENTA</p></div>');
            text.push('<p class="mb-0">66093</p>');
            text.push('</div>');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[2] + '"></div><p class="mb-0">Reguler</p></div>');
            text.push('<p class="mb-0">39836</p>');
            text.push('</div>');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[3] + '"></div><p class="mb-0">Belum Magang</p></div>');
            text.push('<p class="mb-0">39836</p>');
            text.push('</div>');
          text.push('</div>');
          return text.join("");
        },
      }
      var northAmericaChartPlugins = {
        beforeDraw: function(chart) {
          var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;
      
          ctx.restore();
          var fontSize = 3.125;
          ctx.font = "500 " + fontSize + "em sans-serif";
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#13381B";
      
          var text = "90",
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2;
      
          ctx.fillText(text, textX, textY);
          ctx.save();
        }
      }
      var northAmericaChartCanvas = $("#north-america-chart").get(0).getContext("2d");
      var northAmericaChart = new Chart(northAmericaChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: northAmericaChartPlugins
      });
      document.getElementById('north-america-legend').innerHTML = northAmericaChart.generateLegend();
    }
</script>

@endsection