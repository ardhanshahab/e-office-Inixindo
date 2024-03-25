@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="card">
                <h5 class="card-title text-center mb-4">{{ __('Registrasi Karyawan Baru') }}</h5>
                    <form method="POST" action="{{ route('user.regist') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama_lengkap" class="col-md-4 col-form-label text-md-start">{{ __('Nama') }}</label>
                            <div class="col-md-6">
                                <input id="nama_lengkap" type="text" placeholder="Masukan Nama Lengkap Anda" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="nama_lengkap" autofocus>
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jabatan" class="col-md-4 col-form-label text-md-start">{{ __('jabatan') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('jabatan') is-invalid @enderror" name="jabatan" aria-label="Default select example">
                                    <option selected>Pilih jabatan</option>
                                    <option value="Direktur Utama">Direktur Utama</option>
                                    <option value="Direktur">Direktur</option>
                                    <option value="Education Manager">Education Manager</option>
                                    <option value="Instruktur">Instruktur</option>
                                    <option value="Technical Support">Technical Support</option>
                                    <option value="General Manager">General Manager</option>
                                    <option value="SPV Sales">SPV Sales</option>
                                    <option value="Admin Sales">Admin Sales</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Tim Digital">Tim Digital</option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="Finance & Accounting">Finance & Accounting</option>
                                    <option value="HRD">HRD</option>
                                    <option value="Admin Holding">Admin Holding</option>
                                    <option value="Customer Care">Customer Care</option>
                                    <option value="Programmer">Programmer</option>
                                    <option value="Office Boy">Office Boy</option>

                                    {{-- <option value="3">Three</option> --}}
                                  </select>
                                @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-start">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" placeholder="Masukan Username Anda" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
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
                                <input id="password" type="password" placeholder="Masukan Kata Sandi Anda" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
                                <input id="password-confirm" placeholder="Masukan Kata Sandi Anda Sekali Lagi" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status_akun" class="col-md-4 col-form-label text-md-start">{{ __('Status_akun Akun') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('status_akun') is-invalid @enderror" name="status_akun" aria-label="Default select example">
                                    <option selected>Pilih Status Akun</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                    {{-- <option value="3">Three</option> --}}
                                  </select>
                                @error('status_akun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input id="karyawan_id" type="text" hidden   class="form-control @error('karyawan_id') is-invalid @enderror" name="karyawan_id"  value="{{ $countuser }}" required autocomplete="karyawan_id">


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn click-primary">
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

</style>
@endsection
