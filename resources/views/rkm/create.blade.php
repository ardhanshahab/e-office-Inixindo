@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="card">
                <h5 class="card-title text-center mb-4">{{ __('Rencana Kelas Mingguan') }}</h5>
                    <form method="POST" action="{{ route('rkm.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="sales_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Sales') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('sales_key') is-invalid @enderror" name="sales_key" value="{{ old('sales_key' ) }}" required autocomplete="sales_key">
                                    <option selected>Pilih Sales</option>
                                    @foreach ( $sales as $salesis )
                                    <option value="{{ $salesis->kode_karyawan }}">{{ $salesis->kode_karyawan }} - {{ $salesis->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('sales_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="materi_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Materi') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('materi_key') is-invalid @enderror" name="materi_key" value="{{ old('materi_key', ) }}" required autocomplete="materi_key">
                                    <option selected>Pilih Materi</option>
                                    @foreach ( $materi as $materis )
                                    <option value="{{ $materis->id }}">{{ $materis->nama_materi }}</option>
                                    @endforeach
                                </select>
                                @error('materi_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="perusahaan_key" class="col-md-4 col-form-label text-md-start">{{ __('Perusahaan / Instansi') }}</label>
                            <div class="col-md-6">
                                <select style="height: 30px" class="form-select @error('perusahaan_key') is-invalid @enderror" name="perusahaan_key" id="perusahaan_key">
                                </select>
                                @error('perusahaan_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="harga_jual" class="col-md-4 col-form-label text-md-start">{{ __('Harga Jual') }}</label>
                            <div class="col-md-6">
                                <input id="harga_jual" type="number" placeholder="Harga Jual" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual" value="{{ old('harga_jual') }}" autocomplete="harga_jual" autofocus>
                                @error('harga_jual')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pax" class="col-md-4 col-form-label text-md-start">{{ __('PAX') }}</label>
                            <div class="col-md-6">
                                <input id="pax" type="number" placeholder="PAX" class="form-control @error('pax') is-invalid @enderror" name="pax" value="{{ old('pax') }}" autocomplete="pax" autofocus>
                                @error('pax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_awal" class="col-md-4 col-form-label text-md-start">{{ __('Tanggal Awal') }}</label>
                            <div class="col-md-6">
                                <input id="tanggal_awal" type="date" placeholder="tanggal_awal" class="form-control @error('tanggal_awal') is-invalid @enderror" name="tanggal_awal" value="{{ old('tanggal_awal') }}" autocomplete="tanggal_awal" autofocus>
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
                                <input id="tanggal_akhir" type="date" placeholder="tanggal_akhir" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" autocomplete="tanggal_akhir" autofocus>
                                @error('tanggal_akhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="metode_kelas" class="col-md-4 col-form-label text-md-start">{{ __('Metode Kelas') }}</label>
                            <div class="col-md-6">
                                <input id="metode_kelas" type="text" placeholder="Masukan Metode Kelas" class="form-control @error('metode_kelas') is-invalid @enderror" name="metode_kelas" value="{{ old('metode_kelas') }}" autocomplete="metode_kelas" autofocus>
                                @error('metode_kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="event" class="col-md-4 col-form-label text-md-start">{{ __('Event') }}</label>
                            <div class="col-md-6">
                                <input id="event" type="text" placeholder="Masukan Event" class="form-control @error('event') is-invalid @enderror" name="event" value="{{ old('event') }}" autocomplete="event" autofocus>
                                @error('event')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ruang" class="col-md-4 col-form-label text-md-start">{{ __('Ruang') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('ruang') is-invalid @enderror" name="ruang" value="{{ old('ruang', ) }}" required autocomplete="ruang">
                                    <option selected>Pilih Ruang</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="ADOC">ADOC</option>
                                </select>
                                @error('ruang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <label for="instruktur_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Instruktur') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('instruktur_key') is-invalid @enderror" name="instruktur_key" value="{{ old('instruktur_key', ) }}" required autocomplete="instruktur_key">
                                    <option selected>Pilih Instruktur</option>
                                    @foreach ( $instruktur as $instrukturs )
                                    <option value="{{ $instrukturs->kode_karyawan }}">{{ $instrukturs->kode_karyawan }} - {{ $instrukturs->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('instruktur_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-start">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('status') is-invalid @enderror" name="status" value="{{ old('status', ) }}" required autocomplete="status">
                                    <option selected>Pilih Status</option>
                                    <option value="0">Merah</option>
                                    <option value="1">Biru</option>
                                    <option value="2">Hitam</option>
                                </select>
                                @error('status')
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
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
            $(document).ready(function() {
              $('#perusahaan_key').select2({
                placeholder: "Pilih Perusahaan",
                allowClear: true,
                ajax: {
                    url: '{{route('getPerusahaan')}}',
                    processResults: function({data}){
                        console.log(data)
                        return{
                            results: $.map(data, function(item){
                                return {
                                    id: item.id,
                                    text: item.nama_perusahaan
                                }
                            })
                        }
                    }
                    // dataType: 'json'
                  },

              });
            });
    </script>
@endsection
