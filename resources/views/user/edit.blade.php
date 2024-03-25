@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7 col-sm-7 col-xs-7">
            @if ( auth()->user()->jabatan == "HRD" )
            <div class="d-flex flex-row-reverse">
                <a href="/user/{{ $users->id }}/password" class="btn click-warning"><img src="{{ asset('icon/lock.svg') }}" class="mr-1" width="25px">
                    <span>Ganti Password</span></a>
            </div>
            @endif
            <div class="card m-4" id="card">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center">{{ __('Profil Saya') }}</h3>
                    <div class="row">
                        {{-- foto --}}
                        <form action="{{ route('karyawan.update', $users->id) }}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Nama Lengkap</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7"><input id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap', $users->nama_lengkap ) }}" required autocomplete="nama_lengkap">
                                @error('nama_lengkap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Nomor Induk Pegawai</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="nip" type="text" placeholder="Masukan Nomor Induk Pegawai Anda" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip', $users->nip ) }}" required autocomplete="nip">
                                @error('nip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Jabatan</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <select class="form-select @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan', $users->jabatan ) }}" required autocomplete="jabatan">
                                    <option selected>Pilih Jabatan</option>
                                    <option value="Komisaris">Komisaris</option>
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
                                    {{-- <option value="Admin Holding">Admin Holding</option> --}}
                                    <option value="Customer Care">Customer Care</option>
                                    <option value="Customer Service">Customer Service</option>
                                    <option value="Programmer">Programmer</option>
                                    <option value="Driver">Driver</option>
                                    <option value="Office Boy">Office Boy</option>
                                </select>
                                @error('jabatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Divisi</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <select class="form-select @error('divisi') is-invalid @enderror" name="divisi" value="{{ old('divisi', $users->divisi ) }}" required autocomplete="divisi">
                                    <option selected>Pilih Divisi</option>
                                    <option value="Direksi">Direksi</option>
                                    <option value="Education">Education</option>
                                    <option value="Sales & Marketing">Sales & Marketing</option>
                                    <option value="Office">Office</option>
                                    </select>
                                @error('divisi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Rekening Maybank</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="rekening_maybank" placeholder="Masukan Rekening Maybank Anda" type="text" class="form-control @error('rekening_maybank') is-invalid @enderror" name="rekening_maybank" value="{{ old('rekening_maybank', $users->rekening_maybank ) }}" autocomplete="rekening_maybank">
                            @error('rekening_maybank')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Rekening BCA</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="rekening_bca" placeholder="Masukan Rekening BCA Anda" type="text" class="form-control @error('rekening_bca') is-invalid @enderror" name="rekening_bca" value="{{ old('rekening_bca', $users->rekening_bca ) }}" autocomplete="rekening_bca">
                            @error('rekening_bca')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Nomor Handphone</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="notelp" placeholder="Masukan Nomor HP Anda" type="text" class="form-control @error('notelp') is-invalid @enderror" name="notelp" value="{{ old('notelp', $users->notelp ) }}" autocomplete="notelp">
                            @error('notelp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Status Kerja</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <select class="form-select @error('status_aktif') is-invalid @enderror" name="status_aktif" value="{{ old('status_aktif', $users->status_aktif ) }}" required autocomplete="status_aktif">
                                    <option selected>Pilih status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                    {{-- <option value="3">Three</option> --}}
                                  </select>
                                @error('status_aktif')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Awal Probation</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="awal_probation" type="date" class="form-control @error('awal_probation') is-invalid @enderror" name="awal_probation" value="{{ old('awal_probation', $users->awal_probation ) }}"  autocomplete="awal_probation">
                                @error('awal_probation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Akhir Probation</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="akhir_probation" type="date" class="form-control @error('akhir_probation') is-invalid @enderror" name="akhir_probation" value="{{ old('akhir_probation', $users->akhir_probation ) }}"  autocomplete="akhir_probation">
                                @error('akhir_probation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Awal Kontrak</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="awal_kontrak" type="date" class="form-control @error('awal_kontrak') is-invalid @enderror" name="awal_kontrak" value="{{ old('awal_kontrak', $users->awal_kontrak ) }}"  autocomplete="awal_kontrak">
                                @error('awal_kontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Akhir Kontrak</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="akhir_kontrak" type="date" class="form-control @error('akhir_kontrak') is-invalid @enderror" name="akhir_kontrak" value="{{ old('akhir_kontrak', $users->akhir_kontrak ) }}"  autocomplete="akhir_kontrak">
                                @error('akhir_kontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Awal Tetap</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="awal_tetap" type="date" class="form-control @error('awal_tetap') is-invalid @enderror" name="awal_tetap" value="{{ old('awal_tetap', $users->awal_tetap ) }}"  autocomplete="awal_tetap">
                                @error('awal_tetap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Akhir Tetap</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="akhir_tetap" type="date" class="form-control @error('akhir_tetap') is-invalid @enderror" name="akhir_tetap" value="{{ old('akhir_tetap', $users->akhir_tetap ) }}"  autocomplete="akhir_tetap">
                                @error('akhir_tetap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><p>Keterangan</p></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <input id="keterangan" placeholder="Keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan', $users->keterangan ) }}" autocomplete="keterangan">
                                @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn click-primary">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @media screen and (max-width: 768px) {
        .card {
            padding: 15px;
            max-width: 100%;
        }

        .card-body .row {
            margin-bottom: 10px;
        }

        /* .col-xs-4, */
        .col-xs-1 {
            display: none;
        }

        .col-xs-7 {
            width: 100%;
            text-align: left;
        }
    }

</style>
@endsection
