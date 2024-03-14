@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <div class="row">
                        <h3 class="text-center text-muted my-2">{{ __('My Profile') }}</h3>

                        <form action="{{ route('user.updatePassword', $users->id) }}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="col-md-3"><p>Nama Lengkap</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $users->name ) }}" required autocomplete="name" disabled>
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
                            <div class="col-md-8"><input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $users->email ) }}" required autocomplete="email" disabled>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Password Sebelumnya</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="expassword" type="password" class="form-control @error('expassword') is-invalid @enderror" name="expassword" required autocomplete="ex-password">
                                @error('expassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Password</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Confirm Password</p></div>
                            <div class="col-md-1"><p>:</p></div>
                            <div class="col-md-8"><input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
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
