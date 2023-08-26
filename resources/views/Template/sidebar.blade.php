<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" <?= ($title == 'Dashboard')? 'active' : '' ?> href="{{ url('/dashboard') }}">
        <i class="icon-content-left menu-icon"></i>
          <span class="menu-title">Dashboard</span>
      </a>
    </li>

    @if (Auth::user()->roles == 'ADMIN' || Auth::user()->roles == 'SUPER_ADMIN')
    {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#masterdata" aria-expanded="false" aria-controls="masterdata">
            <i class="icon-menu menu-icon"></i>
            <span class="menu-title">Master Data</span>
            <i class="menu-arrow"></i>
        </a> --}}
        @if (Auth::user()->roles == 'ADMIN')

        <li class="nav-item {{ Request::is('data-pengguna-admin*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/data-pengguna-admin') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Pengguna</span>
          </a>
        </li>
      
      <li class="nav-item {{ Request::is('daftar-pendaftar*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/daftar-pendaftar') }}">
            <i class="icon-folder menu-icon"></i>
            <span class="menu-title">Pengajuan Status</span>
        </a>
      </li>
          
      @elseif (Auth::user()->roles == 'SUPER_ADMIN')

      <li class="nav-item {{ Request::is('data-pengguna*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/data-pengguna') }}">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">Pengguna</span>
        </a>
      </li>

      <li class="nav-item {{ Request::is('data-fakultas*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/data-fakultas') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Data Fakultas</span>
        </a>
      </li>

      <li class="nav-item {{ Request::is('data-programstudi*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/data-programstudi') }}">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Data Program Studi</span>
        </a>
      </li>
    @endif
    {{-- </div>
    </li> --}}

    <li class="nav-item {{ Request::is('pesertamagang*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/pesertamagang') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Mahasiswa Magang</span>
      </a>
    </li>

    <li class="nav-item {{ Request::is('laporanbimbingan*') ? 'active' : '' }}||{{ Request::is('laporanlogbook*') ? 'active' : '' }}||{{ Request::is('laporanlp*') ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
          <i class="icon-pie-graph menu-icon"></i>
          <span class="menu-title">Laporan</span>
          <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="laporan">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item {{ Request::is('laporanbimbingan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/laporanbimbingan') }}">Lap. Bimbingan</a>
            </li>
            <li class="nav-item {{ Request::is('laporanlogbook*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/laporanlogbook') }}">Lap. Kegiatan</a>
            </li>
            <li class="nav-item {{ Request::is('laporanlp*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/laporanlp') }}">Lap. Akhir</a>
            </li>
        </ul>
        @endif

    @if (Auth::user()->roles == 'USER')
    <li class="nav-item {{ Request::is('pemberitahuan*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/pemberitahuan') }}">
        <i class="icon-bell menu-icon" ></i>
        <span class="menu-title">Pemberitahuan</span>
      </a>
    </li>

    @if (Auth::user()->status_akun != 'DITERIMA')
    <li class="nav-item {{ Request::is('pemagangan*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/pemagangan') }}">
        <i class="icon-paper-clip menu-icon"></i>
        <span class="menu-title">Pemagangan</span>
      </a>
    </li>
    @endif

    @if (Auth::user()->status_akun == 'DITERIMA')
    <li class="nav-item {{ Request::is('pesertamagang*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/pesertamagang') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Mahasiswa Magang</span>
      </a>
    </li>

    <li class="nav-item {{ Request::is('logbook*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/logbook') }}">
        <i class="icon-book menu-icon"></i>
        <span class="menu-title">Log Book</span>
      </a>
    </li>

    <li class="nav-item {{ Request::is('bimbingan*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/bimbingan') }}">
        <i class="icon-stack menu-icon"></i>
        <span class="menu-title">Bimbingan</span>
      </a>
    </li>

    <li class="nav-item {{ Request::is('laporanakhir*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/laporanakhir') }}">
        <i class="icon-paper-stack menu-icon"></i>
        <span class="menu-title">Laporan Akhir</span>
      </a>
    </li>
        </ul>
    @endif
@endif

@if (Auth::user()->roles == 'PEMBIMBING')

<li class="nav-item {{ Request::is('pesertamagang*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('/pesertamagang') }}">
    <i class="icon-paper menu-icon"></i>
    <span class="menu-title">Mahasiswa Magang</span>
  </a>
</li>
    
<li class="nav-item {{ Request::is('laporanlogbookpembimbing*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('/laporanlogbookpembimbing') }}">
    <i class="icon-book menu-icon"></i>
    <span class="menu-title">Log Book Mahasiswa</span>
  </a>
</li>

<li class="nav-item {{ Request::is('laporanbimbinganpembimbing*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('/laporanbimbinganpembimbing') }}">
    <i class="icon-stack menu-icon"></i>
    <span class="menu-title">Formulir Bimbingan</span>
  </a>
</li>

<li class="nav-item {{ Request::is('laporanlppembimbing*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('/laporanlppembimbing') }}">
    <i class="icon-paper-stack menu-icon"></i>
    <span class="menu-title">Laporan Akhir</span>
  </a>
</li>
</ul>
@endif        
</ul>
</nav>
      

