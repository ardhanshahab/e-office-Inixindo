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
                <div class="card-body table-responsive">
                    <div class="row">
                        <h3 class="text-center text-muted my-2">{{ __('My Profile') }}</h3>
                        {{-- foto --}}
                        <div class="row">
                            <div class="col-md-3"><p>Nama Lengkap</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><p>{{ $users->name }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Email</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><p>{{ $users->email }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Role</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><p>{{ $users->role }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Nomor Induk Pegawai</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><p>{{ $users->nip }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Alamat</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><p>{{ $users->alamat }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Jabatan</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><p>{{ $users->jabatan }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Divisi</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><p>{{ $users->divisi }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Tempat Tanggal Lahir</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><p>{{ $users->tempat_lahir }}, {{ \Carbon\Carbon::parse($users->tanggal_lahir)->formatLocalized('%e %B %Y') }}</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
