@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="card">
                <h5 class="card-title text-center mb-4">{{ __('Edit Rencana Kelas Mingguan') }}</h5>
                    <form method="POST" action="{{ route('rkm.update', $post->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="sales_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Sales') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('sales_key') is-invalid @enderror" name="sales_key" required autocomplete="sales_key">
                                    <option>Pilih Sales</option>
                                    @foreach ($sales as $salesis)
                                        <option value="{{ $salesis->kode_karyawan }}" @if ($post->sales->kode_karyawan == $salesis->kode_karyawan) selected @endif>
                                            {{ $salesis->kode_karyawan }} - {{ $salesis->nama_lengkap }}
                                        </option>
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
                                <select class="form-select @error('materi_key') is-invalid @enderror" name="materi_key" value="{{ $post->materi_key }}" required autocomplete="materi_key">
                                    <option selected>Pilih Materi</option>
                                    @foreach ( $materi as $materis )
                                    <option value="{{ $materis->id }}"@if ($post->materi_key == $materis->id) selected @endif>{{ $materis->nama_materi }}</option>
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
                            <label for="perusahaan_key" class="col-md-4 col-form-label text-md-start">{{ __('Nama Perusahaan') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('perusahaan_key') is-invalid @enderror" name="perusahaan_key" value="{{ old('perusahaan_key',$post->perusahaan_key ) }}" required autocomplete="perusahaan_key">
                                    <option selected>Pilih Perusahaan</option>
                                    @foreach ( $perusahaan as $perusahaans )
                                    <option value="{{ $perusahaans->id }}" @if ($post->perusahaan_key == $perusahaans->id) selected @endif >{{ $perusahaans->nama_perusahaan }}</option>
                                    @endforeach
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
                                <input id="harga_jual" type="number" placeholder="Harga Jual" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual" value="{{ old('harga_jual', $post->harga_jual) }}" autocomplete="harga_jual" autofocus>
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
                                <input id="pax" type="text" placeholder="PAX" class="form-control @error('pax') is-invalid @enderror" name="pax" value="{{ old('pax', $post->pax) }}" autocomplete="pax" autofocus>
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
                                <input id="tanggal_awal" type="date" placeholder="tanggal_awal" class="form-control @error('tanggal_awal') is-invalid @enderror" name="tanggal_awal" value="{{ old('tanggal_awal', $post->tanggal_awal) }}" autocomplete="tanggal_awal" autofocus>
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
                                <input id="tanggal_akhir" type="date" placeholder="tanggal_akhir" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" value="{{ old('tanggal_akhir', $post->tanggal_akhir) }}" autocomplete="tanggal_akhir" autofocus>
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
                                <input id="metode_kelas" type="text" placeholder="Masukan Metode Kelas" class="form-control @error('metode_kelas') is-invalid @enderror" name="metode_kelas" value="{{ old('metode_kelas', $post->metode_kelas) }}" autocomplete="metode_kelas" autofocus>
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
                                <input id="event" type="text" placeholder="Masukan Event" class="form-control @error('event') is-invalid @enderror" name="event" value="{{ old('event', $post->event) }}" autocomplete="event" autofocus>
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
                                <select class="form-select @error('ruang') is-invalid @enderror" name="ruang" required autocomplete="ruang">
                                    <option>Pilih Ruang</option>
                                    <option value="1" @if ($post->ruang == "1") selected @endif>1</option>
                                    <option value="2" @if ($post->ruang == "2") selected @endif>2</option>
                                    <option value="3" @if ($post->ruang == "3") selected @endif>3</option>
                                    <option value="4" @if ($post->ruang == "4") selected @endif>4</option>
                                    <option value="ADOC" @if ($post->ruang == "ADOC") selected @endif>ADOC</option>
                                </select>
                                @error('ruang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-start">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <select class="form-select @error('status') is-invalid @enderror" name="status" required autocomplete="status">
                                    <option {{ $post->status == null ? 'selected' : '' }} >Pilih Status</option>
                                    <option value="0" {{ $post->status == "0" ? 'selected' : '' }}>Merah</option>
                                    <option value="1" {{ $post->status == "1" ? 'selected' : '' }}>Biru</option>
                                    <option value="2" {{ $post->status == "2" ? 'selected' : '' }}>Hitam</option>
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
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const rkmKeySelect = document.querySelector('select[name="rkm_key"]');
    //     const salesSelect = document.querySelector('select[name="sales_key"]');
    //     const materiSelect = document.querySelector('select[name="materi_key"]');
    //     const perusahaanSelect = document.querySelector('select[name="perusahaan_key"]');
    //     const paxInput = document.querySelector('input[name="pax"]');
    //     const tanggalAwalInput = document.querySelector('input[name="tanggal_awal"]');
    //     const tanggalAkhirInput = document.querySelector('input[name="tanggal_akhir"]');
    //     const metodeKelasInput = document.querySelector('input[name="metode_kelas"]');
    //     const eventInput = document.querySelector('input[name="event"]');
    //     const ruangSelect = document.querySelector('select[name="ruang"]');
    //     // const instrukturSelect = document.querySelector('select[name="instruktur_key"]');
    //     const statusSelect = document.querySelector('select[name="status"]');

    //     rkmKeySelect.addEventListener('change', function() {
    //         const selectedRkmKey = this.value;
    //         if (selectedRkmKey === 'Pilih RKM') {
    //             resetFields();
    //             return;
    //         }

    //         // Lakukan request AJAX untuk mendapatkan data RKM berdasarkan rkm_key yang dipilih
    //         fetch(`/rkm/${selectedRkmKey}/edit`)
    //             .then(response => response.json())
    //             .then(data => {
    //                 // Mengisi nilai pada input lainnya berdasarkan data yang diterima
    //                 salesSelect.value = data.sales_key;
    //                 materiSelect.value = data.materi_key;
    //                 perusahaanSelect.value = data.perusahaan_key;
    //                 paxInput.value = data.pax;
    //                 tanggalAwalInput.value = data.tanggal_awal;
    //                 tanggalAkhirInput.value = data.tanggal_akhir;
    //                 metodeKelasInput.value = data.metode_kelas;
    //                 eventInput.value = data.event;
    //                 ruangSelect.value = data.ruang;
    //                 // instrukturSelect.value = data.instruktur_key;
    //                 statusSelect.value = data.status;
    //             })
    //             .catch(error => console.error('Error:', error));
    //     });

    //     // Fungsi untuk mereset nilai pada input lainnya ketika rkm_key dipilih kembali ke "Pilih RKM"
    //     function resetFields() {
    //         salesSelect.value = 'Pilih Sales';
    //         materiSelect.value = 'Pilih Materi';
    //         perusahaanSelect.value = 'Pilih Perusahaan';
    //         paxInput.value = '';
    //         tanggalAwalInput.value = '';
    //         tanggalAkhirInput.value = '';
    //         metodeKelasInput.value = '';
    //         eventInput.value = '';
    //         ruangSelect.value = 'Pilih Ruang';
    //         // instrukturSelect.value = 'Pilih Instruktur';
    //         statusSelect.value = 'Pilih Status';
    //     }
    // });
</script>
@endpush


@endsection
