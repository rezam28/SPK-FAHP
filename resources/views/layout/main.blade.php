<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/69e0e324fb.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    @yield('css')
</head>
<body>
    <div class="main-content container">
        <!--navbar-->
        <!-- Image and text -->
        <nav class="navbar">
            <a class="logo navbar-brand" href="/">
                <img src="{{('../img/logo.png')}}" width="30" height="30" class="title" alt="" loading="lazy">
                SPK - LAHAN
            </a>
            {{-- @if (\Session::has('login'))
                <a href="{{route('logout')}}" class="logout">Logout</a>
            @endif --}}
            <div class="toggle" onclick="ToggleMenu()"></div>
        </nav>
        <!--Sidebar-->
        <div class="navigation" id="navigation">
            @guest
            <nav>
                <ul>
                    <li>
                        <a href="{{route('alternatif')}}">
                            <span class="icon"><i class="fas fa-address-book fa-lg"></i></span>
                            <span class="title">Alternatif</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('kriteria')}}">
                            <span class="icon"><i class="fa fa-book" aria-hidden="true"></i></span>
                            <span class="title">Kriteria</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('daerah')}}">
                            <span class="icon"><i class="far fa-flag fa-lg"></i></span>
                            <span class="title">Daerah</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('hasil')}}">
                            <span class="icon"><i class="fa fa-calculator" aria-hidden="true"></i></span>
                            <span class="title">Hasil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('peta')}}">
                            <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <span class="title">Peta</span>
                        </a>
                    </li>
                </ul>
            </nav>
            @endguest
        </div>
        
        <div class="content">
            @yield('content')
        </div>
    </div>
    
    
    <script type="text/javascript">
        function ToggleMenu(){
            // document.getElementById("navigation").classList.toggle('active');
            let navigation = document.querySelector('.navigation');
            let toggle = document.querySelector('.toggle');
            let content = document.querySelector('.content');
            navigation.classList.toggle('active');
            toggle.classList.toggle('active');
            content.classList.toggle('active');
        }
    </script>
    @yield('javascript')
</body>
</html>