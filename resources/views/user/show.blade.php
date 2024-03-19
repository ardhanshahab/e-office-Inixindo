{{-- profil saya --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        {{-- {{ $users }} --}}

        <div class="col-md-8">
            <div class="d-flex flex-row-reverse">
                <a href="/user/{{ $users->id }}/edit" class="btn btn-md btn-primary mx-1"><i class="fa fa-pencil-square-o fa-fw"></i> Edit Profile</a>
            @if ( auth()->user()->role != "HRD" )
                <a href="/user/{{ $users->id }}/password" class="btn btn-md btn-warning mx-1"><i class="fa fa-lock fa-fw"></i> Ganti Password</a>
            @endif
            </div>
            <div class="card m-4 light">
                <div class="card-header" style="background: #A0C0E0">
                    <h3 class="text-center my-1">{{ __('Profil Saya') }}</h3>
                </div>
                @if (Auth::user()->theme === 'dark')
                    <div id="card" class="card-body bg-dark">
                @else
                    <div id="card" class="card-body bg-light">
                @endif
                    {{-- foto --}}
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Nama Lengkap</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->nama_lengkap }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Username</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->username }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Role</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->role }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Nomor Induk Pegawai</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->nip }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Jabatan</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->jabatan }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Divisi</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->divisi }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Rekening Maybank</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->rekening_maybank }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Rekening Bca</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->rekening_bca }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Status</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                            @if ($users->karyawan->status_aktif == '1')
                               <p>Aktif</p>
                            @else
                                <p>Tidak Aktif</p>
                            @endif
                        </div>
                    </div>
                    @if ($users->karyawan->awal_probation)
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Awal Probation</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->awal_probation }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Akhir Probation</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->akhir_probation }}</p></div>
                    </div>
                    @endif
                    @if ($users->karyawan->awal_kontrak)
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Awal Kontrak</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->awal_kontrak }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Akhir Kontrak</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->akhir_kontrak }}</p></div>
                    </div>
                    @endif
                    @if ($users->karyawan->awal_tetap)
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Awal Tetap</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->awal_tetap }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Akhir Tetap</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->karyawan->akhir_tetap }}</p></div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Atur tata letak kolom untuk layar kecil */
    @media screen and (max-width: 768px) {
        .card {
            padding: 15px;
            max-width: 100%;
        }

        .card-body .row {
            margin-bottom: 10px;
        }

        /* .col-xs-4, */
        .col-xs-1 {
            display: none;
        }

        .col-xs-7 {
            width: 100%;
            text-align: left;
        }
    }
        /* Tema gelap */
        .dark-theme .card-body {
            color: #fff;
        }

        /* Tema terang */
        .light-theme .card-body {
            color: #000;
        }

</style>
@push('js')
    <script>

    </script>
@endpush
@endsection
