<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>INIXOffice</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icon/logoinix.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icon/logoinix.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icon/logoinix.png')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css"> --}}

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
        .card {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: auto;
            height: auto;
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.45);
            box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(2px);
            }

        .card img {
            height: 60%;
        }

        .circle {
            background: #ffffff;
            border-radius: 60%;
            color: #fff;
            height: 8.7em;
            position: relative;
            width: 8.7em;
        }

        .circle-content {
            hyphens: auto;
            margin: 0.75em;
            text-align: center;
        }
        .click-primary {
            border-radius: 5px;
            padding:       5px 10px;
            color:         #ffffff;
            display:       inline-block;
            font:          normal bold 14px/1 "Open Sans", sans-serif;
            text-align:    center;
            background:    #182f51;
            transition:    color 0.1s linear, background-color 0.2s linear;
        }

        .click-primary:hover {
            background:         #A5C7EF;
            color:              #ffffff;
            transition:    color 0.1s linear, background-color 0.2s linear;
        }


        .click-warning {
            background:    #f8be00;
            border-radius: 5px;
            padding:       5px 10px;
            color:         #000000;
            display:       inline-block;
            font:          normal bold 18px/1 "Open Sans", sans-serif;
            text-align:    center;
            transition:    color 0.1s linear, background-color 0.2s linear; /* Transisi warna teks selama 0.1 detik dan warna latar belakang selama 0.2 detik dengan perpindahan linear */
        }

        .click-warning:hover {
            background:         #A5C7EF; /* Warna merah saat tombol dihover */
            transition:    color 0.1s linear, background-color 0.2s linear; /* Transisi warna teks selama 0.1 detik dan warna latar belakang selama 0.2 detik dengan perpindahan linear */
        }

        .click-warning-icon {
            background:    #f8be00;
            border-radius: 1000px;
            width:         45px;
            height:        45px;
            color:         #ffffff;
            display:       flex;
            justify-content: center; /* Posisikan ikon secara horizontal di tengah */
            align-items:   center; /* Posisikan ikon secara vertikal di tengah */
            text-align:    center;
            text-decoration: none; /* Hilangkan dekorasi hyperlink */
        }

        .click-warning-icon i {
            line-height:   45px; /* Sesuaikan tinggi ikon dengan tinggi tombol */
        }
        .click-danger-icon {
            background:    #983A3A;
            border-radius: 1000px;
            width:         45px;
            height:        45px;
            color:         #ffffff;
            display:       flex;
            justify-content: center; /* Posisikan ikon secara horizontal di tengah */
            align-items:   center; /* Posisikan ikon secara vertikal di tengah */
            text-align:    center;
            text-decoration: none; /* Hilangkan dekorasi hyperlink */
        }

        .click-danger-icon i {
            line-height:   45px; /* Sesuaikan tinggi ikon dengan tinggi tombol */
        }

        .click-secondary-icon {
            background:    #355C7C;
            border-radius: 5px;
            padding:       10px 20px;
            color:         #ffffff;
            display:       inline-block;
            font:          normal bold 12px/1 "Open Sans", sans-serif;
            text-align:    center;
            justify-content: center; /* Posisikan ikon secara horizontal di tengah */
            align-items:   center; /* Posisikan ikon secara vertikal di tengah */
            text-decoration: none; /* Hilangkan dekorasi hyperlink */
        }
        .click-secondary-icon i {
            line-height: 45px; /* Sesuaikan tinggi ikon dengan tinggi tombol */
        }
        .click-secondary {
            background:    #355C7C;
            border-radius: 5px;
            padding:       5px 10px;
            color:         #ffffff;
            display:       inline-block;
            font:          normal bold 18px/1 "Open Sans", sans-serif;
            text-align:    center;
            transition:    color 0.1s linear, background-color 0.2s linear; /* Transisi warna teks selama 0.1 detik dan warna latar belakang selama 0.2 detik dengan perpindahan linear */
        }


        .click-secondary:hover {
            color:         #A5C7EF; /* Warna merah saat tombol dihover */
            transition:    color 0.1s linear, background-color 0.2s linear; /* Transisi warna teks selama 0.1 detik dan warna latar belakang selama 0.2 detik dengan perpindahan linear */
        }

        #bgsvg{
            /* background:
            url(https://source.unsplash.com/E8Ufcyxz514/2400x1823)
            center / cover no-repeat fixed;
             */
            /* background-image: linear-gradient(to right top, #182f51, #1f416e, #26538c, #2b66ab, #307acc, #5579d1, #7377d3, #8e74d3, #a85cad, #b04983, #a93d5c, #983a3a); */
            background-image: url('/css/background inix office-02.svg');
            background-position: center;
            background-size: cover;
            background-repeat:no-repeat;


        }

    </style>
</head>
<body class="{{ Auth::user()->theme === 'dark' ? 'dark-theme' : '' }}">
    <div id="app">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                <!-- Tombol Home -->
                <ul class="navbar-nav me-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}"><img src="{{ asset('icon/home.svg') }}" class="img-responsive" width="30px"></a>
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
                {{-- <ul class="navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <button class="btn nav-link dropdown-toggle" type="button" id="themeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('icon/moon.svg') }}" class="img-responsive" width="30px">
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
                </ul> --}}
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <img src="{{ asset('icon/power.svg') }}" class="img-responsive" width="30px">
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
        $(document).ready(function() {

            localStorage.setItem('jabatan', '{{ auth()->user()->jabatan }}');
            // localStorage.setItem('divisi', '{{ auth()->user()->divisi }}');
            var jabatan = localStorage.getItem('jabatan');
            // var divisi = localStorage.getItem('divisi');
            // console.log(jabatan);
        });

    </script>
    {{-- <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>
</html>
