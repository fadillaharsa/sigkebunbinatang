<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.24/datatables.min.css"/>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet"> 

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.24/datatables.min.js"></script>

    <!-- Styles -->
  
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>


    <!-- Here Maps -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"type="text/javascript"
    charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript"  
    charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript"
    charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript"
    charset="utf-8"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    @stack('scriptTop')

</head>
<body>
    <div id="app">
    
            <nav class="navbar navbar-expand-lg navbar-dark bg-success border-bottom">
                <button class="btn btn-light text-success" id="menu-toggle"><i class="fas fa-bars"></i> Menu</button>
                <a class="navbar-brand ml-lg-3" href="#"> SIG KEBUN BINATANG BANDUNG</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <a type="button" class="btn btn-light text-success" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                 
                    @endguest
                </ul>
                </div>
            </nav>

            <div class="d-flex" id="wrapper">
                <!-- Sidebar -->
                <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                    <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action {{ Request::routeIs('dashboard') ? 'bg-gray' : 'bg-light'}}">Dashboard</a>
                    <a href="{{route('facility.index')}}" class="list-group-item list-group-item-action {{ Request::routeIs('facility*') ? 'bg-gray' : 'bg-light'}}">Fasilitas dan Kandang</a>
                    <a href="{{route('animal.index')}}" class="list-group-item list-group-item-action {{ Request::routeIs('animal*') ? 'bg-gray' : 'bg-light'}}">Satwa</a>
                    <a href="{{route('route.index')}}" class="list-group-item list-group-item-action {{ Request::routeIs('route*') ? 'bg-gray' : 'bg-light'}}">Rute</a>
                    <a href="{{route('review.index')}}" class="list-group-item list-group-item-action {{ Request::routeIs('review*') ? 'bg-gray' : 'bg-light'}}">Ulasan</a>
                    <a href="{{route('news.index')}}" class="list-group-item list-group-item-action {{ Request::routeIs('news*') ? 'bg-gray' : 'bg-light'}}">Berita</a>
                </div>
                </div>
                <div id="page-content-wrapper">
                    <div class="container-fluid py-5">
                        @yield('content')
                    </div>
                </div>
            </div>
 
    <!-- Scripts -->
    @stack('script')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/here.js') }}"></script>

    <script>
        $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        window.hereApiKey = "{{env('HERE_API_KEY')}}"
    </script>


</body>
</html>
