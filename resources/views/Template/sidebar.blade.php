  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand ps-3 text-center" href="/dashboard"><img class=" text-center m-15" src="images/logobiu.png" alt="" style="width: 160px; height: auto;"></a>
        {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> --}}
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          {{-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li> --}}

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/iconusergreen4.png" alt="profile"/>
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
              {{-- <a class="dropdown-item" href="/logout">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a> --}}
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
            <a class="nav-link" href="{{ url('/dashboard') }}">
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
                <a class="nav-link" <?= ($title == 'Tambah Pengguna')? 'active' : '' ?> href="{{ url('/data-pengguna/create') }}">Tambah Pengguna</a>
            </li>
              <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/dropdowns.html">Program Studi</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html">Fakultas</a>
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
      <a class="nav-link" href="#">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Pemagangan</span>
      </a>
    </li>

    @if (Auth::user()->status_akun == 'TERDAFTAR')
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

          {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li> --}}

          {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Form elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">Charts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Icons</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="icon-ban menu-icon"></i>
              <span class="menu-title">Error pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> --}}
        
        </ul>
      </nav>

      

