    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand ps-3 text-center" href="/dashboard"><img class=" text-center m-15" src="/images/logobiu.png" alt="" style="width: 160px; height: auto;"></a>
        {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> --}}
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="/images/iconusergreen4.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ route('change-password') }}">
                <i class="ti-settings text-primary"></i>
                Ubah Password
              </a>
              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti-power-off text-primary"></i>
                Logout
            </a>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="_method" value="POST">
            </form>            
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->

      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

    @if (Auth::user()->roles == 'ADMIN' || Auth::user()->roles == 'SUPER_ADMIN')
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#masterdata" aria-expanded="false" aria-controls="masterdata">
            <i class="icon-menu menu-icon"></i>
            <span class="menu-title">Master Data</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="masterdata">
            @if (Auth::user()->roles == 'ADMIN')
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                  <a class="nav-link" href="/data-pengguna">Pengguna</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/dropdowns.html">Pengajuan</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html">Pembimbing</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html">Mahasiswa Magang</a>
              </li>
          </ul>
          
            @elseif (Auth::user()->roles == 'SUPER_ADMIN')
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                  <a class="nav-link" <?= ($title == 'Data Pengguna')? 'active' : '' ?> href="{{ url('/data-pengguna') }}">Pengguna</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" <?= ($title == 'Data Program Studi')? 'active' : '' ?> href="{{ url('/data-programstudi') }}">Program Studi</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" <?= ($title == 'Data Fakultas')? 'active' : '' ?> href="{{ url('/data-fakultas') }}">Fakultas</a>
              </li>
          </ul>
            @endif
        </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
          <i class="icon-pie-graph menu-icon"></i>
          <span class="menu-title">Laporan</span>
          <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="laporan">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/buttons.html">Log Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/dropdowns.html">Jumlah Kehadiran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/typography.html">Laporan Akhir</a>
            </li>
        </ul>
    @endif

    @if (Auth::user()->roles == 'USER')
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-bell menu-icon"></i>
        <span class="menu-title">Pemberitahuan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" <?= ($title == 'Pemagangan')? 'active' : '' ?> href="{{ url('/pemagangan') }}">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Pemagangan</span>
      </a>
    </li>

    @if (Auth::user()->status_akun == 'DITERIMA')
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-book menu-icon"></i>
        <span class="menu-title">Log Book</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Formulir Bimbingan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-paper-stack menu-icon"></i>
        <span class="menu-title">Laporan Akhir</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
          <i class="icon-pie-graph menu-icon"></i>
          <span class="menu-title">Laporan</span>
          <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="laporan">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/buttons.html">Log Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/dropdowns.html">Bimbingan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/typography.html">Laporan Akhir</a>
            </li>
        </ul>
    @endif
@endif

@if (Auth::user()->roles == 'PEMBIMBING')

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-book menu-icon"></i>
        <span class="menu-title">Log Book Mahasiswa</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Formulir Bimbingan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-paper-stack menu-icon"></i>
        <span class="menu-title">Laporan Akhir</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
          <i class="icon-pie-graph menu-icon"></i>
          <span class="menu-title">Laporan</span>
          <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="laporan">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/buttons.html">Log Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/dropdowns.html">Bimbingan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/typography.html">Laporan Akhir</a>
            </li>
        </ul>
@endif        
        </ul>
      </nav>

      

