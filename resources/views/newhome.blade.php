@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: ">
    <h5 style="text-transform: capitalize; color:#000;">Selamat Datang, {{ auth()->user()->username }}</h5>
@if (auth()->user()->jabatan == 'HRD')
    <div class="row justify-content-between">
        <div class="container d-flex justify-content-around my-4">
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Total Karyawan</h5>
                <h4 class="text-center">{{ $totalkaryawan }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Karyawan Aktif</h5>
                <h4 class="text-center">{{ $karyawanaktif }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Peserta Aktif</h5>
                <h4 class="text-center">100</h4>
            </div>
        </div>
    </div>
@endif
@if (auth()->user()->jabatan == 'Instruktur')
    <div class="row justify-content-between">
        <div class="container d-flex justify-content-around my-4">
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Kelas anda minggu ini</h5>
                <h4 class="text-center">{{ $totalkaryawan }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Running Class</h5>
                <h4 class="text-center">{{ $karyawanaktif }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Jumlah Mengajar</h5>
                <h4 class="text-center">100</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Jumlah Peserta anda</h5>
                <h4 class="text-center">{{ $totalkaryawan }}</h4>
            </div>
        </div>
    </div>
@endif

    <div class="row justify-content-between">
        <div class="col-md-6">
            <div class="row">
                {{-- karyawan --}}
                <div class="col-md-12 my-1">
                    {{-- content --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <h5 class="text-center card-title">Karyawan</h5>
                                <div class="col-sm-6 my-1">
                                    <div class="card" id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/credit-card.svg') }}" class="img-responsive" width="30px">
                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                {{-- <h5 class="card-title">Profil Saya</h5> --}}
                                                <a href="/profile/{{ auth()->user()->id }}" class="link stretched-link text-decoration-none"><h5 class="card-title">Profil Saya</h5></a>
                                                <p class="card-text">Profil saya sebagai karyawan INIXINDO Bandung.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 my-1">
                                    <div class="card shadow-sm"  id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/users.svg') }}" class="img-responsive" width="30px">

                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Data Karyawan</h5></a>
                                                <p class="card-text">Data lengkap semua karyawan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- end karyawan --}}
                {{-- peserta --}}
                <div class="col-md-12 my-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <h5 class="text-center">Peserta</h5>
                                <div class="col-sm-6">
                                    <div class="card" id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/table.svg') }}" class="img-responsive" width="30px">
                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Data Peserta</h5></a>
                                                <p class="card-text">Data Peserta yang mengikuti kelas.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="card" id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/user-check.svg') }}" class="img-responsive" width="30px">
                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px" id="">
                                                <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Registrasi</h5></a>
                                                <p class="card-text">Registrasi peserta kelas.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 mt-2">
                                    <div class="card" id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/activity.svg') }}" class="img-responsive" width="30px">

                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                <a href="/perusahaan" class="link stretched-link text-decoration-none"><h5 class="card-title">Perusahaan</h5></a>
                                                <p class="card-text">Data Perusahaan.</p>
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
        <div class="col-md-6">
            <div class="row">
                {{-- RKM --}}
                    <div class="col-md-12 my-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <h5 class="text-center">Rencana Kelas Mingguan</h5>
                                    <div class="col-sm-6">
                                        <div class="card" id="card-hover">
                                            <div class="card-body d-flex">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('icon/book-open.svg') }}" class="img-responsive" width="30px">
                                                </div>
                                                <div class="col-md-10" style="margin-left: 10px">
                                                    <a href="/rkm" class="link stretched-link text-decoration-none"><h5 class="card-title">Rencana Kelas Mingguan</h5></a>
                                                    <p class="card-text">Rencana kelas untuk minggu ini.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-6">
                                        <div class="card" id="card-hover">
                                            <div class="card-body d-flex">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('icon/calendar.svg') }}" class="img-responsive" width="30px">

                                                </div>
                                                <div class="col-md-10" style="margin-left: 10px">
                                                    <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Kalender</h5></a>
                                                    <p class="card-text">Jadwal Rencana Kelas Mingguan.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="col-sm-6">
                                        <div class="card" id="card-hover">
                                            <div class="card-body d-flex">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('icon/calendar.svg') }}" class="img-responsive" width="30px">

                                                </div>
                                                <div class="col-md-10" style="margin-left: 10px">
                                                    <a href="/materi" class="link stretched-link text-decoration-none"><h5 class="card-title">Materi</h5></a>
                                                    <p class="card-text">Data Materi.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- end RKM --}}
            </div>
        </div>
    </div>
</div>


<style>
    @media screen and (max-width: 768px) {
        a {
            width: auto;
            max-width: 100%;
        }

    }
    body.dark-theme #hero1 {
            color: #ffffff
        }

    body.light-theme #hero1 {
            color: #000000
        }


</style>
@endsection
