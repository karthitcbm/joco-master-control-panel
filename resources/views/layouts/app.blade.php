@section('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JOCO Master Control</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;1,100&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css?v=220320101432"> -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <h1>JOCO</h1> <div class="logo-text">Master Control Panel</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- @guest 
                @else
                <div class="menu-container"> 
                @if (Auth::user()->role === 'CMS')
                <cms-menu-list />
                @elseif (Auth::user()->role === 'FMS')
                <fms-menu-list />
                @endif
                </div>
                @endguest -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->role === 'CMS')
                                        <a class="dropdown-item" href="">Consumer Management</a>
                                        <a class="dropdown-item" href="">Consumer Stats</a>
                                        <a class="dropdown-item" href="">Ticketing Platform</a>
                                    @elseif (Auth::user()->role === 'FMS')
                                        <a class="dropdown-item" href="">Vehicle Assignment Control</a>
                                        <a class="dropdown-item" href="">Inventory & Quality Control</a>
                                        <a class="dropdown-item" href="">Ticketing Platform</a>
                                    @endif 
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
        
            @yield('content')
        </main>
    </div>
</body>
</html>

<style>
    .theme--light.v-application{
        background: none;
    }
    h1 {
        font-weight: 800;
        font-size: 32px;
        /* font-family: 'PoppinsBold'; */
        text-align: center;
        letter-spacing: 0.250em;
        color: #FF8500;
        display: inline;
    }
    .logo-text {
        display: inline;
        vertical-align: text-bottom;
        font-size: 1.25rem;
        font-weight: bold;
    }
</style>
