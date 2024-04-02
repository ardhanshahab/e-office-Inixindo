@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="card">
                <h5 class="card-title text-center mb-4">{{ __('Tambah Instruktur') }}</h5>
                    <form method="POST" action="{{ route('updateInstruktur', $rkm->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="rkm_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama RKM') }}</label>
                            <div class="col-md-6">
                                <input id="rkm_key" type="text" class="form-control @error('rkm_key') is-invalid @enderror" name="rkm_key" value="{{ $rkm->materi->nama_materi }}" disabled autocomplete="rkm_key" autofocus>
                                @error('rkm_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_awal" class="col-md-4 col-form-label text-md-start">{{ __('Tanggal Awal') }}</label>
                            <div class="col-md-6">
                                <input id="tanggal_awal" type="date" placeholder="tanggal_awal" class="form-control @error('tanggal_awal') is-invalid @enderror" name="tanggal_awal" disabled value="{{ old('tanggal_awal', $rkm->tanggal_awal) }}" autocomplete="tanggal_awal" autofocus>
                                @error('tanggal_awal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_akhir" class="col-md-4 col-form-label text-md-start">{{ __('Tanggal Akhir') }}</label>
                            <div class="col-md-6">
                                <input id="tanggal_akhir" type="date" placeholder="tanggal_akhir" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir"  disabled value="{{ old('tanggal_akhir', $rkm->tanggal_akhir) }}" autocomplete="tanggal_akhir" autofocus>
                                @error('tanggal_akhir')
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
                            <label for="instruktur_key2" class="col-md-4 col-form-label text-md-start">{{ __('Nama Instruktur 2') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('instruktur_key2') is-invalid @enderror" name="instruktur_key2" value="" required autocomplete="instruktur_key2">
                                    <option selected>Pilih Instruktur 2</option>
                                    @foreach ( $karyawan as $instruktur_key2 )
                                    <option value="{{ $instruktur_key2->kode_karyawan }}">{{ $instruktur_key2->kode_karyawan }} - {{ $instruktur_key2->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('instruktur_key2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="asisten_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Asisten Instruktur') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('asisten_key') is-invalid @enderror" name="asisten_key" value="" required autocomplete="asisten_key">
                                    <option selected>Pilih Asisten Instruktur</option>
                                    @foreach ( $karyawan as $asisten_key )
                                    <option value="{{ $asisten_key->kode_karyawan }}">{{ $asisten_key->kode_karyawan }} - {{ $asisten_key->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('asisten_key')
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
