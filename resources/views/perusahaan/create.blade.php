@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="card">
                    <a href="{{ url()->previous() }}" class="btn click-primary my-2"><img src="{{ asset('icon/arrow-left.svg') }}" class="img-responsive" width="20px"> Back</a>
                <h5 class="card-title text-center mb-4">{{ __('Perusahaan Baru') }}</h5>
                    <form method="POST" action="{{ route('perusahaan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama_perusahaan" class="col-md-4 col-form-label text-md-start">{{ __('Nama Perusahaan') }}</label>
                            <div class="col-md-6">
                                <input id="nama_perusahaan" type="text" placeholder="Masukan Nama Perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" autocomplete="nama_perusahaan" autofocus>
                                @error('nama_perusahaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kategori_perusahaan" class="col-md-4 col-form-label text-md-start">{{ __('Kategori Perusahaan') }}</label>
                            <div class="col-md-6">
                                <input id="kategori_perusahaan" type="text" placeholder="Masukan Kategori Perusahaan" class="form-control @error('kategori_perusahaan') is-invalid @enderror" name="kategori_perusahaan" value="{{ old('kategori_perusahaan') }}" autocomplete="kategori_perusahaan" autofocus>
                                @error('kategori_perusahaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lokasi" class="col-md-4 col-form-label text-md-start">{{ __('Lokasi') }}</label>
                            <div class="col-md-6">
                                <input id="lokasi" type="text" placeholder="Masukan Lokasi Perusahaan" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi') }}" autocomplete="lokasi" autofocus>
                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sales_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Sales') }}</label>
                            <div class="col-md-6">
                                @if (auth()->user()->jabatan == 'SPV Sales')
                                <select class="form-select @error('sales_key') is-invalid @enderror" name="sales_key" required autocomplete="sales_key">
                                    <option value="">Pilih Sales</option>
                                    @foreach ($sales as $salesis)
                                       <option value="{{ $salesis->kode_karyawan }}">{{ $salesis->kode_karyawan }} - {{ $salesis->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @else
                                <select disabled class="form-select @error('sales_key') is-invalid @enderror" name="sales_key" required autocomplete="sales_key">
                                    <option value="{{ auth()->user()->id_sales }}" >{{ auth()->user()->id_sales }}</option>
                                </select>
                                @endif
                                <input type="hidden" name="sales_key" value="{{auth()->user()->id_sales}}"/>
                                @error('sales_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-start">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <input id="status" type="text" placeholder="Masukan Status" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" autocomplete="status" autofocus>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="npwp" class="col-md-4 col-form-label text-md-start">{{ __('NPWP') }}</label>
                            <div class="col-md-6">
                                <input id="npwp" type="text" placeholder="Masukan NPWP" class="form-control @error('npwp') is-invalid @enderror" name="npwp" value="{{ old('npwp') }}" autocomplete="npwp" autofocus>
                                @error('npwp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label text-md-start">{{ __('Alamat') }}</label>
                            <div class="col-md-6">
                                <input id="alamat" type="text" placeholder="Masukan Alamat Perusahaan" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" autocomplete="alamat" autofocus>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cp" class="col-md-4 col-form-label text-md-start">{{ __('CP') }}</label>
                            <div class="col-md-6">
                                <input id="cp" type="text" placeholder="Masukan CP Perusahaan" class="form-control @error('cp') is-invalid @enderror" name="cp" value="{{ old('cp') }}" autocomplete="cp" autofocus>
                                @error('cp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="no_telp" class="col-md-4 col-form-label text-md-start">{{ __('Nomor Telepon') }}</label>
                            <div class="col-md-6">
                                <input id="no_telp" type="text" placeholder="Masukan Nomor Telepon Perusahaan" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" autocomplete="no_telp" autofocus>
                                @error('no_telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="foto_npwp" class="col-md-4 col-form-label text-md-start">{{ __('Foto NPWP') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('foto_npwp') is-invalid @enderror" name="foto_npwp">
                                @error('foto_npwp')
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
