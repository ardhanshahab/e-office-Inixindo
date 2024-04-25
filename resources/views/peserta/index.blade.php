@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' )
                    <a href="{{ route('peserta.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah peserta"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Data Peserta</a>
                @endif
            </div>
            <div class="card m-4" id="peserta">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Peserta') }}</h3>
                    <table class="table table-striped" id="pesertatable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">id</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Nomor Handphone</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Perusahaan/Instansi</th>
                            <th scope="col">Tanggal Lahir</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card m-4" id="pesertaall">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Peserta') }}</h3>
                    <table class="table table-striped" id="pesertaalltable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Nomor Handphone</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Perusahaan/Instansi</th>
                            <th scope="col">Tanggal Lahir</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<style>

</style>
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script>
    $(document).ready(function(){
        var idInstruktur = "{{ auth()->user()->id_instruktur }}";
        if(idInstruktur){
            $('#peserta').show();
            $('#pesertaall').hide();
        }else{
           $('#peserta').hide();
           $('#pesertaall').show();
        }
        $('#pesertaalltable').DataTable({
                "processing": true,
                "ajax": {
                    "url": "{{ route('getPesertaall') }}", // URL API untuk mengambil data
                    "type": "GET",
                },
                "columns": [
                    {"data": "id"},
                    {"data": "nama"},
                    {"data": "email"},
                    {
                        "data": null,
                        "render": function(data) {
                            return data.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                        }
                    },
                    {"data": "no_hp"},
                    {"data": "alamat"},
                    {"data": "perusahaan.nama_perusahaan"},
                    {
                        "data": "peserta.tanggal_lahir",
                        "render": function(data) {
                            return moment(data).format('DD MMMM YYYY');
                        }
                    },

                ],
            });
        $('#pesertatable').DataTable({
                "processing": true,
                "ajax": {
                    "url": "{{ route('getRegistrasiall') }}", // URL API untuk mengambil data
                    "type": "GET",
                },
                "columns": [
                    {"data": "id"},
                    {"data": "peserta.nama"},
                    {"data": "peserta.email"},
                    {
                        "data": "id_instruktur",
                        "visible": false
                    },
                    {
                        "data": null,
                        "render": function(data) {
                            return data.peserta.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                        }
                    },
                    {"data": "peserta.no_hp"},
                    {"data": "peserta.alamat"},
                    {"data": "peserta.perusahaan.nama_perusahaan"},
                    {
                        "data": "peserta.tanggal_lahir",
                        "render": function(data) {
                            return moment(data).format('DD MMMM YYYY');
                        }
                    },

                ],
                "initComplete": function() {
                            this.api().columns(3).search(idInstruktur).draw();
                        }
            });
    });
</script>
@endpush
@endsection
