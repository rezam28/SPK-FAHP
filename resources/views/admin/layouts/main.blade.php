<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    @yield('css')
</head>
<body>
    <div class="main-content container">
        <!--navbar-->
        <!-- Image and text -->
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
                            <span class="icon"><i class="fa fa-calculator" aria-hidden="true"></i></span>
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
                            <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <span class="title">Kriteria</span>
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