@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <div class="row">
                        <h3 class="text-center text-muted my-2">{{ __('My Profile') }}</h3>
                        {{-- foto --}}
                        <form action="{{ route('user.update', $users->id) }}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="col-md-3"><p>Nama Lengkap</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $users->name ) }}" required autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Email</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $users->email ) }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Role</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role', $users->role ) }}" required autocomplete="role">
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Nomor Induk Pegawai</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip', $users->nip ) }}" required autocomplete="nip">
                                @error('nip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Alamat</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat', $users->alamat ) }}" required autocomplete="alamat">
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Jabatan</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan', $users->jabatan ) }}" required autocomplete="jabatan">
                            @error('jabatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Divisi</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="divisi" type="text" class="form-control @error('divisi') is-invalid @enderror" name="divisi" value="{{ old('divisi', $users->divisi ) }}" required autocomplete="divisi">
                            @error('divisi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Tempat Lahir</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir', $users->tempat_lahir ) }}" required autocomplete="tempat_lahir">
                            @error('tempat_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Tanggal Lahir</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir', $users->tanggal_lahir ) }}" required autocomplete="tanggal_lahir">
                                @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end my-3">
                            <button type="submit" class="btn btn-md btn-primary mx-4">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
