@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="card">
                <h5 class="card-title text-center mb-4">{{ __('Registrasi Karyawan Baru') }}</h5>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('Nama') }}</label>
                            <div class="col-md-6">
                                <input id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="nama_lengkap" autofocus>
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-start">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('role') is-invalid @enderror" name="role" aria-label="Default select example">
                                    <option selected>Pilih Role</option>
                                    <option value="Direktur Utama">Direktur Utama</option>
                                    <option value="Direktur">Direktur</option>
                                    <option value="Education Manager">Education Manager</option>
                                    <option value="Instruktur">Instruktur</option>
                                    <option value="Technical Support">Technical Support</option>
                                    <option value="General Manager">General Manager</option>
                                    <option value="SPV Sales">SPV Sales</option>
                                    <option value="Adm Sales">Admin Sales</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Tim Digital">Tim Digital</option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="Finance & Accounting">Finance & Accounting</option>
                                    <option value="HRD">HRD</option>
                                    <option value="Admin Holding">Admin Holding</option>
                                    <option value="Customer Care">Customer Care</option>
                                    <option value="Customer Service">Customer Service</option>
                                    <option value="Programmer">Programmer</option>
                                    <option value="Office Boy">Office Boy</option>

                                    {{-- <option value="3">Three</option> --}}
                                  </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-start">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-start">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-start">{{ __('status') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('status') is-invalid @enderror" name="status" aria-label="Default select example">
                                    <option selected>Pilih status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                    {{-- <option value="3">Three</option> --}}
                                  </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input id="karyawan_id" type="text" class="form-control @error('karyawan_id') is-invalid @enderror" name="karyawan_id" hidden value="{{ $countuser }}" required autocomplete="karyawan_id">


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
        body.light-theme #card {
            background-color: #fff; /* Warna latar belakang default saat tema terang */
            color: #000
        }

        body.dark-theme #card {
            background-color: #000; /* Warna latar belakang saat tema gelap */
            color: #fff; /* Warna teks untuk tema gelap */
        }
</style>
@endsection
