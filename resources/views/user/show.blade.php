@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex flex-row-reverse">
                <a href="/user/{{ auth()->user()->id }}/edit" class="btn btn-md btn-primary mx-1"><i class="fa fa-pencil-square-o fa-fw"></i> Edit Profile</a>
                <a href="/user/{{ auth()->user()->id }}/password" class="btn btn-md btn-warning mx-1"><i class="fa fa-lock fa-fw"></i> Ganti Password</a>
            </div>
            <div class="card m-4">
                <div class="card-body">
                    <h3 class="text-center text-muted my-2">{{ __('My Profile') }}</h3>
                    {{-- foto --}}
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Nama Lengkap</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->name }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Email</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->email }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Role</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->role }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Nomor Induk Pegawai</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->nip }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Alamat</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->alamat }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Jabatan</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->jabatan }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Divisi</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->divisi }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Tempat Tanggal Lahir</p></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $users->tempat_lahir }}, {{ \Carbon\Carbon::parse($users->tanggal_lahir)->formatLocalized('%e %B %Y') }}</p></div>
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
</style>
@endsection
