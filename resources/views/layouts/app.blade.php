<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>INIXCOFFEE</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icon/logoinix.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icon/logoinix.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icon/logoinix.png')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            overflow: hidden;
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
            background-image: url('/css/background inix office-02.svg');
            background-size: cover;
            background-attachment:scroll;
            height: 100vh;
            overflow-y: scroll;
        }

        #logoinix {
            width: 400px;
        }

        .alert-custom {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050; /* Memastikan alert berada di atas elemen lain */
            width: 100%; /* Atau sesuaikan dengan lebar yang diinginkan */
        }



        @media (max-width: 576px) {
            body{
                overflow-y: auto;
            }
        #bgsvg{
            background-image: url('/css/background inix office-02.svg') repeat-y;
            overflow-y: scroll;

        }
        .navbar-nav {
            flex-direction: row;
            padding-top: 10px;
        }

        #auth{
            display: none;
        }

        .nav-item {
            text-align: center;
            width: 100%;
            margin: 5px 0;
        }

        .navbar-brand {
            text-align: center;
            width: 100%;
            margin: 5px 0;
        }

        .navbar-brand img {
            margin-right: 0;
        }

        #logoinix {
            width: 300px;
        }
    }
        @media (min-width: 577px) and (max-width: 991px) {
        #bgsvg {
            background-image: url('/css/background inix office-02.svg') repeat-y;
        }

        .navbar-nav {
            flex-direction: column;
            padding-top: 10px;
        }

        #auth {
            display: none;
        }

        .nav-item {
            text-align: center;
            width: 100%;
            margin: 5px 0;
        }

        .navbar-brand {
            text-align: center;
            width: 100%;
            margin: 5px 0;
        }

        .navbar-brand img {
            margin-right: 0;
        }

        #logoinix {
            width: 300px;
        }
    }

    </style>
</head>
<body>
    <div id="app">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-0 alert-custom" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-0 alert-custom" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                <div class="col-md-4 col-sm-4 col-xs-4 d-flex justify-content-start" id="navbarkiri">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Home">
                                <img src="{{ asset('icon/home.svg') }}" class="img-responsive" width="30px">
                            </a>
                        </li>
                        <li class="nav-item order-0 order-md-1" style="margin-left: 10px" id="auth">
                            <h6 class="nav-link mt-1" style="text-transform: capitalize; color:#fff; margin:0px; padding:8px;">
                                Selamat Datang {{ auth()->user()->username }}, Anda Login Sebagai {{ auth()->user()->jabatan }}
                            </h6>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 d-flex justify-content-center"  id="navbartengah">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item text-left">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('icon/logo_e-officew.svg') }}" class="img-responsive" id="logoinix">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 d-flex justify-content-end" id="navbarkanan">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="{{ route('logout') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"
                                onclick="event.preventDefault(); if(confirm('Apakah Anda Yakin?')) { document.getElementById('logout-form').submit(); }">
                                <img src="{{ asset('icon/power.svg') }}" class="img-responsive" width="30px">
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-2" style="height: 90vh" id="bgsvg">
            @yield('content')
        </main>

    </div>
    @stack('js')
    <script>
        // $(document).ready(function() {

        //     localStorage.setItem('jabatan', '{{ auth()->user()->jabatan }}');
        //     localStorage.setItem('id_instruktur', '{{ auth()->user()->kode_karyawan }}');
        //     var jabatan = localStorage.getItem('jabatan');
        //     // var divisi = localStorage.getItem('divisi');
        //     // console.log(jabatan);
        // });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>
</html>
