<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>


    <!-- Here Maps -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    @stack('scriptTop')
    @laravelPWA
</head>
<body>
    <div id="app">    
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light" style="box-shadow: 0px 2px #cecece">
            <button class="navbar-toggler bg-success" style="height:45px;width:45px" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-white"><i class="fas fa-bars"></i></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" style="height:40px"></a>
            <span></span>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('tentang')}}">Tentang Kebun Binatang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tiket')}}">Beli Tiket Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('kontak')}}">Kontak Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('website')}}">Website Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guide')}}">Jasa Tour Guide</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container py-4 mb-5" style="max-width: 720px">
            @yield('content')
        </div>

        <nav class="navbar navbar-dark bg-success navbar-expand fixed-bottom p-0" style="box-shadow: 0px -2px #cecece">
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item {{ Request::routeIs('peta') ? 'bg-info' : 'bg-success'}}">        
                <a href="{{route('peta')}}" class="nav-link text-white">
                    <img src="{{ asset('assets/images/peta.png') }}" class="img-fluid" style="height:40px">
                    <br><small>Peta</small>
                </a>
                </li>
                <li class="nav-item {{ Request::routeIs('rute') ? 'bg-info' : 'bg-success'}}">        
                <a href="{{route('rute')}}" class="nav-link text-white">
                    <img src="{{ asset('assets/images/rute.png') }}" class="img-fluid" style="height:40px">
                    <br><small>Rute</small>
                </a>
                </li>
                <li class="nav-item {{ Request::routeIs('wahana') ? 'bg-info' : 'bg-success'}}">        
                <a href="{{route('wahana')}}" class="nav-link text-white">
                    <img src="{{ asset('assets/images/wahana.png') }}" class="img-fluid" style="height:40px">
                    <br><small>Wahana</small>
                </a>
                </li>
                <li class="nav-item {{ Request::routeIs('berita') ? 'bg-info' : 'bg-success'}}">        
                <a href="{{route('berita')}}" class="nav-link text-white">
                    <img src="{{ asset('assets/images/berita.png') }}" class="img-fluid" style="height:40px">
                    <br><small>Berita</small>
                </a>
                </li>
            </ul>
        </nav>

    </div>
 
    <!-- Scripts -->
    <script>
        window.appURL = "{{env('APP_URL')}}"
    </script>
    <script>
        let optionmap = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge:10000
        };
        function success(pos) {}
        function error(err) {
        }
            navigator.geolocation.watchPosition(position => {
                localCoord = position.coords;
                objAsalCoord = {
                    lat: localCoord.latitude,
                    lng: localCoord.longitude
                }
            },error,optionmap
            )
    </script>
    @stack('script')

</body>
</html>
