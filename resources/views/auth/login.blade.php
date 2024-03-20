@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row align-self-center justify-content-center" style="margin-top: 50px">
            <div class="col-md-6">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="circle">
                            <img src="https://inixindobdg.co.id/images/logoinix.png" class="circle-content"
                                style="width:100px">
                        </div>
                        <h1 class="text-center text-white">INIXINDO BANDUNG</h1>
                        <h5 class="text-center text-white">Keep Learning, Stay Uptodate </h5>
                    </div>
                </div>
                {{-- <hr> --}}
            </div>
        </div>
        <div class="row align-self-center justify-content-center my-4">
            <div class="col-md-6">
                <div class="card my-4 ">
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
                                        <span class="input-group-text" id="username">@</span>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                        name="username"
                                        required autocomplete="username"
                                        aria-label="Username" aria-describedby="username">
                                    </div>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-2 col-form-label text-md-end">{{ __('') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="username"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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

                            <div class="row mb-0">
                                <div class="col-md-10 offset-md-1" style="">
                                    <button type="submit" class="btn btn-primary" style="width: 320px">
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
        .background {
            /* background-color: green;  */
            /* height: 150px;  */
            /* padding: 10px;  */
        }

        .card {
            margin-right: auto;
            margin-left: auto;
            width: auto;
            box-shadow: 0 15px 25px rgba(129, 124, 124, 0.2);
            height: auto;
            border-radius: 5px;
            backdrop-filter: blur(10px);
            background-color: #ffffff;
            padding: 10px;
            text-align: center;
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
            /* margin-bottom: 10px; */
            width: 8.7em;
        }

        .circle-content {
            hyphens: auto;
            margin: 0.75em;
            text-align: center;
        }
    </style>
@endsection
