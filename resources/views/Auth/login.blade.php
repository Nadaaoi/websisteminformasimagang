<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/images/Logobiu.svg" />

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    
 <style>
  .header {
    display: flex;
    align-items: center;
    margin-top: 10px;
  }

  .support-text {
    margin-right: 10px;
  }

  .kampusmerdeka-logo,
  .magenta-logo {
    margin-right: 10px;
    height: auto;
    animation: logoAnimation 3s infinite alternate; /* Menambahkan animasi ke gambar */
    animation-timing-function: ease-in-out; /* Mengubah pola timing animasi */
  }

  .kampusmerdeka-logo {
    width: 70px;
  }

  .magenta-logo {
    width: 120px;
    float: left;
  }

  .logo-container {
    display: flex;
    justify-content: center;
    margin-top: 10px;
  }

  .img-floating {
    float: none;
  }

  @keyframes logoAnimation {
    0% {
      transform: translateY(0);
      opacity: 1;
    }
    50% {
      transform: translateY(5px); /* Posisi floating */
      opacity: 0.7; /* Opacity berkurang saat naik */
    }
    100% {
      transform: translateY(0);
      opacity: 1;
    }
  }
</style>

    <title>Login Sistem Informasi Kerja Praktik Mahasiswa Universitas Bina Insani</title>
  </head>
  <body>
  
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

{{-- <div class="header">
  <div class="support-text">Support by:</div>
  <img src="images/magenta.png" alt="Magenta Logo" class="magenta-logo">
  <img src="images/kampusmerdeka.png" alt="Kampus Merdeka Logo" class="kampusmerdeka-logo">
</div> --}}

<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-6 order-md-2">
        <img src="images/logobiu.png" alt="Image" class="img-fluid">
        <div class="logo-container">
          <div class="header clearfix">
            <div class="support-text">Support by:</div>
            <img src="images/magenta.png" alt="Magenta Logo" class="magenta-logo">
            <img src="images/kampusmerdeka.png" alt="Kampus Merdeka Logo" class="kampusmerdeka-logo">
          </div>
        </div>
      </div>
      <div class="col-md-6 contents">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="mb-4">
              <h3 style="color: #00923F">Yuk<strong> Masuk! </strong></h3>
              <p class="mb-4" style="color: #01632b"><strong>Sistem Informasi Kerja Praktik Mahasiswa Universitas Bina Insani.</strong></p>
            </div>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>              
              
              {{-- <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div> --}}

              <input type="submit" value="Log In" class="btn text-white btn-block btn-primary btn-click-animation">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  
  <footer class="fixed-bottom d-flex align-items-center text-white text-center" style="margin-top: 6rem; height: 40px; background-color: #00923f">
    <div class="container p-2" style="font-size:smaller">
      <p class="m-auto"><span class="">&copy;  Universitas Bina Insani {{ date('Y') }}</span></p>
      
    </div>
  </footer>

  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>