<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand ps-3 text-center" href="/dashboard">
      <img class="text-center m-15" src="/images/logobiu.png" alt="" style="width: 160px; height: auto;">
    </a>
    {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> --}}
  </div>

  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>

    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="user">
          {{ Auth::user()->name }}
          <img src="/images/iconusergreen4.png" alt="profile"/>
        </a>

        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="user">
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
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
