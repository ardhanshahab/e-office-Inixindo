@extends('layouts.layout')

@section('content')
    <div class="container mt-4">
        <div class="row align-self-center justify-content-center" style="margin-top: 100px">
            <div class="col-md-6">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="d-flex justify-content-center mt-4">
                            <img src="https://inixindobdg.co.id/images/logoinix.png" class="mx-2" style="width:50px;">
                            <h1 class="text-center mx-2">INIXINDO BANDUNG</h1>
                        </div>
                        <h5 class="text-center">"Continous Learning, Keep Up to date" </h5>
                    </div>
                </div>
                {{-- <hr> --}}
            </div>
        </div>
        <div class="row align-self-center justify-content-center my-4">
            <div class="col-md-6">
                <div class="card my-4">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-center" style="background: transparant">
                            <div>
                                {{-- <h5 class="text-center">{{ __('Login') }}</h5> --}}
                            </div>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="username"
                                    class="col-md-2 col-form-label text-md-end">{{ __('') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="username"><img src="{{ asset('icon/a.svg') }}" class="" width="25px"></span>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                        name="username"
                                        required autocomplete="username"
                                        aria-label="Username" aria-describedby="username">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-2 col-form-label text-md-end">{{ __('') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="password"><img src="{{ asset('icon/lock.svg') }}" class="" width="25px"></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row mb-3 align-items-center">
                                <div class="col-md-10 offset-md-4">
                                    <button type="submit" class="btn click-primary" style="max-width: 320px">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    </style>
@endsection
