@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: ">
    <h5>Selamat Datang, {{ auth()->user()->name }}</h5>
@if (auth()->user()->role == 'HRD')
    <div class="row justify-content-between">
        <div class="container d-flex justify-content-around my-4">
            <div class="mx-1" style="color: #182F51">
                <h5 class="card-title text-center">Total Karyawan</h5>
                <h4 class="text-center">{{ $totalkaryawan }}</h4>
            </div>
            <div class="mx-1" style="color: #962D2D">
                <h5 class="card-title text-center">Karyawan Aktif</h5>
                <h4 class="text-center">{{ $karyawanaktif }}</h4>
            </div>
            <div class="mx-1" style="color: #A0C0E0">
                <h5 class="card-title text-center">Peserta Aktif</h5>
                <h4 class="text-center">100</h4>
            </div>
        </div>
@endif
@if (auth()->user()->role == 'Instruktur')
    <div class="row justify-content-between">
        <div class="container d-flex justify-content-around my-4">
            <div class="mx-1" style="color: #182F51">
                <h5 class="card-title text-center">Kelas anda minggu ini</h5>
                <h4 class="text-center">{{ $totalkaryawan }}</h4>
            </div>
            <div class="mx-1" style="color: #962D2D">
                <h5 class="card-title text-center">Running Class</h5>
                <h4 class="text-center">{{ $karyawanaktif }}</h4>
            </div>
            <div class="mx-1" style="color: #A0C0E0">
                <h5 class="card-title text-center">Jumlah Mengajar</h5>
                <h4 class="text-center">100</h4>
            </div>
            <div class="mx-1" style="color: #182F51">
                <h5 class="card-title text-center">Jumlah Peserta anda</h5>
                <h4 class="text-center">{{ $totalkaryawan }}</h4>
            </div>
        </div>
@endif

    <div class="row justify-content-between">
        {{-- karyawan --}}
        <div class="col-md-6 my-1">
            {{-- content --}}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <h5 class="text-center card-title">Karyawan</h5>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex">
                                    <div class="col-md-2">
                                        <i class="fa fa-address-card fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10" style="margin-left: 10px">
                                        {{-- <h5 class="card-title">Profil Saya</h5> --}}
                                        <a href="/profile/{{ auth()->user()->id }}" class="link stretched-link text-decoration-none"><h5 class="card-title">Profil Saya</h5></a>
                                        <p class="card-text">Profil saya sebagai karyawan INIXINDO Bandung.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex">
                                    <div class="col-md-2">
                                        <i class="fa fa-users fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10" style="margin-left: 10px">
                                        <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Data Karyawan</h5></a>
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- end karyawan --}}

        {{-- RKM --}}
        <div class="col-md-6 my-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <h5 class="text-center">Rencana Kelas Mingguan</h5>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex">
                                    <div class="col-md-2">
                                        <i class="fa fa-book fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10" style="margin-left: 10px">
                                        <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Rencana Kelas Mingguan</h5></a>
                                        <p class="card-text">Rencana kelas untuk minggu ini.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex">
                                    <div class="col-md-2">
                                        <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10" style="margin-left: 10px">
                                        <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Kalender</h5></a>
                                        <p class="card-text">Jadwal Rencana Kelas Mingguan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- end RKM --}}

        {{-- peserta --}}
        <div class="col-md-6 my-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <h5 class="text-center">Peserta</h5>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex">
                                    <div class="col-md-2">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10" style="margin-left: 10px">
                                        <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Data Peserta</h5></a>
                                        <p class="card-text">Data Peserta yang mengikuti kelas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex">
                                    <div class="col-md-2">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-10" style="margin-left: 10px">
                                        <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Histori Peserta</h5></a>
                                        <p class="card-text">Data peserta yang pernah mengikuti kelas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- end peserta --}}
    </div>
</div>


<style>
    @media screen and (max-width: 768px) {
        a {
            width: auto;
            max-width: 100%;
        }
        .card {
            overflow: scroll;
        }
    }


    .card {
        width: auto;
        box-shadow: 0 15px 25px rgba(129, 124, 124, 0.2);
        height: auto;
        border-radius: 5px;
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.13);
        padding: 10px;
        text-align: left;
    }
</style>
@endsection
