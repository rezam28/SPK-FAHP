<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('css')
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-content container">
        <!--navbar-->
        <nav class="navbar">
            <a class="logo navbar-brand" href="{{route('ad_home')}}">
                <img src="{{('../img/untag.png')}}" width="30" height="30" class="title" alt="" loading="lazy">
                Sistem Pendukung Kepustusan
            </a>
            @if (\Session::has('login'))
                <a href="{{route('logout')}}" class="logout">Logout</a>
            @endif
            <div class="toggle" onclick="ToggleMenu()"></div>
        </nav>
        <!--Sidebar-->
        <div class="navigation" id="navigation">
            @guest
            <nav>
                <ul>
                    <li>
                        <a href="{{route('ad_home')}}">
                            <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('ad_alternatif')}}">
                            <span class="icon"><i class="fa fa-calculator" aria-hidden="true"></i></span>
                            <span class="title">Alternatif</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('ad_kriteria')}}">
                            <span class="icon"><i class="fa fa-book" aria-hidden="true"></i></span>
                            <span class="title">Kriteria</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{route('ad_kriteria')}}">
                            <span class="icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                            <span class="title">Nilai Bobot</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="#" id="nilai-btn">
                            <span class="icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                            <span class="title">Nilai Bobot</span>
                            <span class="ikon"><i class="fa fa-caret-down"></i></span>
                        </a>
                        <ul id="nilai-show">
                            <li>
                                <a href="{{route('ad_pk')}}">
                                    <span class="icon"><i class="fa fa-play" aria-hidden="true"></i></span>
                                    <span class="title">Nilai Kriteria</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('ad_pa')}}">
                                    <span class="icon"><i class="fa fa-play" aria-hidden="true"></i></span>
                                    <span class="title">Nilai Alternatif</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('ad_peta')}}">
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
    <div class="popup">
        @yield('popup')
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
        $('#nilai-btn').click(function(){
            $('#nilai-show').toggleClass("show");
        });
    </script>
    @yield('javascript')
</body>
</html>