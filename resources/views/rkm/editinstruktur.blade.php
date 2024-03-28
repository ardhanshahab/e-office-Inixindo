@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="card">
                <h5 class="card-title text-center mb-4">{{ __('Tambah Instruktur') }}</h5>
                    <form method="POST" action="{{ route('updateInstruktur') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="rkm_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama RKM') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('rkm_key') is-invalid @enderror" name="rkm_key" value="{{ old('rkm_key' ) }}" required autocomplete="rkm_key">
                                    <option selected>Pilih RKM</option>
                                    @foreach ( $rkm as $rkm_key )
                                    <option value="{{ $rkm_key->id }}">{{ $rkm_key->id }} - {{ $rkm_key->materi->nama_materi }}</option>
                                    @endforeach
                                </select>
                                @error('rkm_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="instruktur_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Instruktur 1') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('instruktur_key') is-invalid @enderror" name="instruktur_key" value="{{ old('instruktur_key' ) }}" required autocomplete="instruktur_key">
                                    <option selected>Pilih Instruktur 1</option>
                                    @foreach ( $karyawan as $instruktur_key )
                                    <option value="{{ $instruktur_key->kode_karyawan }}">{{ $instruktur_key->kode_karyawan }} - {{ $instruktur_key->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('instruktur_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="instruktur2_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Instruktur 2') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('instruktur2_key') is-invalid @enderror" name="instruktur2_key" value="{{ old('instruktur2_key' ) }}" required autocomplete="instruktur2_key">
                                    <option selected>Pilih Instruktur 2</option>
                                    @foreach ( $karyawan as $instruktur2_key )
                                    <option value="{{ $instruktur2_key->kode_karyawan }}">{{ $instruktur2_key->kode_karyawan }} - {{ $instruktur2_key->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('instruktur2_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="instruktur_asisten" class="col-md-4 col-form-label text-md-start">{{ __('Nama Asisten Instruktur') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('instruktur_asisten') is-invalid @enderror" name="instruktur_asisten" value="{{ old('instruktur_asisten' ) }}" required autocomplete="instruktur_asisten">
                                    <option selected>Pilih Asisten Instruktur</option>
                                    @foreach ( $karyawan as $instruktur_asisten )
                                    <option value="{{ $instruktur_asisten->kode_karyawan }}">{{ $instruktur_asisten->kode_karyawan }} - {{ $instruktur_asisten->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('instruktur_asisten')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn click-primary">
                                    {{ __('Simpan') }}
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
