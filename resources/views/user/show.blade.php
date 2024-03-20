{{-- profil saya --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex flex-row-reverse">
                <a href="/karyawan/{{ $users->id }}/edit" class="btn btn-md btn-primary mx-1"><i class="fa fa-pencil-square-o fa-fw"></i> Edit Profile</a>
            @if ( auth()->user()->role != "HRD" )
                <a href="/user/{{ $users->id }}/password" class="btn btn-md btn-warning mx-1"><i class="fa fa-lock fa-fw"></i> Ganti Password</a>
            @endif
            </div>

            <div class="card-group m-1">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card m-2 align-self-center">
                            <div class="card-body text-center" id="card">
                                <img src="{{ asset('storage/posts/'.$users->karyawan->foto) }}" class="rounded" style="width:100px;height:100px;">
                                <div class="m-4 row align-items-center text-center">
                                    <p>{{ $users->karyawan->nama_lengkap }}</p>
                                    <p>{{ $users->karyawan->jabatan }}</p>
                                    <a href="/gantifoto/{{ $users->id }}" class="btn btn-md btn-success"><i class="fa fa-picture-o fa-fw"></i> Ganti Foto Profil</a>
                                </div>
                            </div>
                        </div>
                        <div class="card m-2">
                            <div class="card-body" id="card">
                                <h5 class="card-title">Posisi</h5>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-5"><p>Nomor Induk Pegawai</p></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $users->karyawan->nip }}</p></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-5"><p>Jabatan</p></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $users->karyawan->jabatan }}</p></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-5"><p>Divisi</p></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $users->karyawan->divisi }}</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm" id="card">
                        <div class="card-body " id="card">
                            <div class="card my-1">
                                <div class="card-body" id="card">
                                    <h5 class="card-title">Personal Detail</h5>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5 col-xs-5"><p>Nama Lengkap</p></div>
                                            <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $users->karyawan->nama_lengkap }}</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5 col-xs-5"><p>Username</p></div>
                                            <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $users->username }}</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5 col-xs-5"><p>Role</p></div>
                                            <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $users->role }}</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5 col-xs-5"><p>Status</p></div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                @if ($users->karyawan->status_aktif == '1')
                                                   <p>Aktif</p>
                                                @else
                                                    <p>Tidak Aktif</p>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card my-1">
                                <div class="card-body" id="card">
                                    <h5 class="card-title">Rekening</h5>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5"><p>Maybank</p></div>
                                        <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $users->karyawan->rekening_maybank }}</p></div>
                                    </div>
                                    @if ($users->karyawan->rekening_bca)
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5"><p>BCA</p></div>
                                        <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $users->karyawan->rekening_bca }}</p></div>
                                    </div>
                                    @endif


                                </div>
                            </div>
                            <div class="card my-1">
                                <div class="card-body" id="card">
                                    @if ($users->karyawan->awal_probation)
                                    <h5 class="card-title">Probation</h5>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5"><p>Mulai Tanggal</p></div>
                                        <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ \Carbon\Carbon::parse($users->karyawan->awal_probation)->translatedFormat('d F Y') }}</p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5"><p>Sampai Tanggal</p></div>
                                        <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ \Carbon\Carbon::parse($users->karyawan->akhir_probation)->translatedFormat('d F Y') }}</p></div>
                                    </div>
                                    @endif
                                    @if ($users->karyawan->awal_kontrak)
                                    <h5 class="card-title">Kontrak</h5>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5"><p>Mulai Tanggal</p></div>
                                        <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ \Carbon\Carbon::parse($users->karyawan->awal_kontrak)->translatedFormat('d F Y') }}</p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5"><p>Sampai Tanggal</p></div>
                                        <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ \Carbon\Carbon::parse($users->karyawan->akhir_kontrak)->translatedFormat('d F Y') }}</p></div>
                                    </div>
                                    @endif
                                    @if ($users->karyawan->awal_tetap)
                                    <h5 class="card-title">Tetap</h5>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5"><p>Mulai Tanggal</p></div>
                                        <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ \Carbon\Carbon::parse($users->karyawan->awal_tetap)->translatedFormat('d F Y') }}</p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5"><p>Sampai Tanggal</p></div>
                                        @if ($users->karyawan->akhir_tetap)
                                        <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ \Carbon\Carbon::parse($users->karyawan->akhir_tetap)->translatedFormat('d F Y') }}</p></div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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

        .card-body  .row {
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
        body.light-theme #card {
            background-color: #fff; /* Warna latar belakang default saat tema terang */
            color: #000
        }

        body.dark-theme #card {
            background-color: #000; /* Warna latar belakang saat tema gelap */
            color: #fff; /* Warna teks untuk tema gelap */
        }

</style>
@push('js')
    <script>

    </script>
@endpush
@endsection
