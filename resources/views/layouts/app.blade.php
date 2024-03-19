<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>INIXOffice</title>
    <link rel="apple-touch-icon" sizes="180x180" href="https://inixindobdg.co.id/images/logoinix.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://inixindobdg.co.id/images/logoinix.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://inixindobdg.co.id/images/logoinix.png">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        body.dark-theme {
            background-color: #333;
            color: #fff;
        }

        body.light-theme {
            background-color: #fff;
            color: #333;
        }
        body.light-theme p {
            color: #333;
        }
        body.dark-theme p {
            color: #fff;
        }

        .link {
        color: black;
        background-color: transparent;
        text-decoration: none;
        }
        .link:hover {
        color: #182F51;
        background-color: transparent;
        text-decoration: none;
        }
        .link:active     {
        color: black;
        background-color: transparent;
        text-decoration: none;
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 10rem;
            padding: .5rem 0;
            margin: .125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: .25rem;
        }

        .dropdown-menu.show {
            display: block;
        }


    </style>
</head>
<body class="{{ Auth::user()->theme === 'dark' ? 'dark-theme' : '' }}">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm ">
            <div class="container-fluid">
                <!-- Tombol Home -->
                <ul class="navbar-nav me-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto ">
                    <li class="nav-item" style="margin-left: 50px">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="https://inixindobdg.co.id/images/logoinix.png" class="img-responsive" style="width: 40px;">
                            <span class="ms-2">INIXoffice</span>
                        </a>
                    </li>
                </ul>


                <!-- Tombol Logout -->
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <button class="btn nav-link dropdown-toggle" type="button" id="themeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-moon-o" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                            <li>
                                <button class="btn" onclick="setTheme('dark')">Dark Theme</button>
                            </li>
                            <li>
                                <button class="btn" onclick="setTheme('light')">Light Theme</button>
                            </li>

                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fa fa-power-off" aria-hidden="true"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>


        <main class="py-2" style="height: 100vh" id="bgsvg">
            @yield('content')
        </main>

    </div>
    @stack('js')
    <script>
        function setTheme(theme) {
            document.body.className = theme + '-theme';
            localStorage.setItem('theme', theme);
            setCookie('theme', theme, 60);

        }

        // Set theme from localStorage on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                setTheme(savedTheme);
            }
        });

    </script>
    <script src="https://kit.fontawesome.com/85b3409c34.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/theme.js') }}"></script>

</body>
</html>
