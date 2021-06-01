<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIG Kebun Binatang Bandung</title>

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    @laravelPWA
</head>
<body>
    <div id="app">
    
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light" style="box-shadow: 0px 2px #cecece">
            <button class="navbar-toggler bg-success" style="height:45px;width:45px" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-white"><i class="fas fa-bars"></i></span>
            </button>
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" style="height:40px"></a>
            <span></span>
            
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
                <li class="nav-item active">
                <a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Tentang Kebun Binatang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Beli Tiket Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kontak Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Website Utama</a>
                </li>
            </ul>
            </div>
        </nav>

        <div class="container pt-4" style="max-width: 720px">
                <div class="mb-3 text-center">
                    <H1><b>LAYANAN LOKASI ANDA BELUM AKTIF</b></H1>
                </div>
                <div class="alert alert-danger text-center" role="alert">
                    <img src="{{ asset('assets/images/allow.png') }}" class="img-fluid mb-2" style="max-width: 200px">
                    <br>
                    Untuk dapat menggunakan aplikasi ini, pastikan <b>GPS Anda aktif</b>. Dan pilih <b>"Allow"</b> ketika ada notifikasi penggunaan Layanan Lokasi.
                </div>
                <div class="alert alert-danger" role="alert">
                    <h3 class="text-center"><b>Terlanjur Menekan Tombol "Block"?</b></h3>
                    <ol class="pl-3">
                        <li>Di tablet atau ponsel Android, buka aplikasi Chrome <img src="//lh3.googleusercontent.com/uSRJIFR8eDSfkfjB4tuohW_Lojbukra5FzyRMzLEz-wRjAKm_9v6NNS2MS49JxrhQ37L=w36-h36" width="18" height="18" alt="Chrome" title="Chrome">.</li>
                        <li>Di sebelah kanan kolom URL, tap Lainnya <img src="//lh3.googleusercontent.com/oLoRPrHJd7m46sWijX6zBWnEnfslP62AxJSwt5Nj0bNbpaYHz2pyscExleiofsH2kQ=w36-h36" width="18" height="18" alt="Lainnya" title="Lainnya"> <img src="//lh3.googleusercontent.com/SaY5lqCwN7kppnS546l9ys-E2sZftTTIHjBrdV-WsGPIhGjaxcEXjfgdIfW_UNG7Sw0=w26-h36" width="13" height="18" alt="lalu" title="lalu"> <strong>Setelan</strong>.</li>
                        <li>Tap <strong>Setelan situs</strong> <img src="//lh3.googleusercontent.com/SaY5lqCwN7kppnS546l9ys-E2sZftTTIHjBrdV-WsGPIhGjaxcEXjfgdIfW_UNG7Sw0=w26-h36" width="13" height="18" alt="lalu" title="lalu"> <strong>Lokasi</strong>.</li>
                        <li>Aktifkan <strong>Lokasi</strong> untuk situs ini.</li>
                      </ol>
                </div>
                
                <H1 class="text-center"><b>PILIH FITUR:</b></H1>
                <div class="row mb-2">
                    <div class="col-6 pr-1">
                        <a href="{{route('peta')}}" class="card nav-link text-white bg-success text-center mx-auto d-block">
                            <img src="{{ asset('assets/images/peta.png') }}" class="img-fluid" style="height:40px">
                            <br><b>Peta</b>
                            <br><small>Denah, Informasi, dan Petunjuk Jalan</small>
                        </a>
                    </div>
                    <div class="col-6 pl-1">
                        <a href="{{route('rute')}}" class="card nav-link text-white bg-success text-center mx-auto d-block">
                            <img src="{{ asset('assets/images/rute.png') }}" class="img-fluid" style="height:40px">
                            <br><b>Rute</b>
                            <br><small>Tour Guide Mengitari Kebun Binatang</small>
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 pr-1">
                        <a href="{{route('wahana')}}" class="card nav-link text-white bg-success text-center mx-auto d-block">
                            <img src="{{ asset('assets/images/wahana.png') }}" class="img-fluid" style="height:40px">
                            <br><b>Wahana</b>
                            <br><small>Fasilitas Feeding, Tunggangan, Foto Satwa</small>
                        </a>
                    </div>
                    <div class="col-6 pl-1">
                        <a href="{{route('berita')}}" class="card nav-link text-white bg-success text-center mx-auto d-block">
                            <img src="{{ asset('assets/images/berita.png') }}" class="img-fluid" style="height:40px">
                            <br><b>Berita</b>
                            <br><small>Berita Terbaru Kebun Binatang</small>
                        </a>
                    </div>
                </div>
        </div>

    </div>
 

</body>
<script>
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };
    function success(pos) {
    }
    function error(err) {
    }
    navigator.geolocation.getCurrentPosition(success, error, options);
</script>

</html>