@extends('layouts.app')

@section('content')
<div class="container-fluid">
       <!-- Modal Spinner -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="spinnerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="loader"></div>
                    <div clas="loader-txt">
                        <p>Mohon Tunggu..</p>
                    </div>
            </div>
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'Sales' || auth()->user()->jabatan == 'Adm Sales' || auth()->user()->jabatan == 'SPV Sales' || auth()->user()->jabatan == 'GM' || auth()->user()->jabatan == 'Accounting' || auth()->user()->jabatan == 'Accounting' || auth()->user()->jabatan == 'Education Manager')
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
    .loader {
    position: relative;
    text-align: center;
    margin: 15px auto 35px auto;
    z-index: 9999;
    display: block;
    width: 80px;
    height: 80px;
    border: 10px solid rgba(0, 0, 0, .3);
    border-radius: 50%;
    border-top-color: #000;
    animation: spin 1s ease-in-out infinite;
    -webkit-animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
    to {
        -webkit-transform: rotate(360deg);
    }
    }

    @-webkit-keyframes spin {
    to {
        -webkit-transform: rotate(360deg);
    }
    }
    .modal-content {
    border-radius: 0px;
    box-shadow: 0 0 20px 8px rgba(0, 0, 0, 0.7);
    }

    .modal-backdrop.show {
    opacity: 0.75;
    }

    .loader-txt {
    p {
        font-size: 13px;
        color: #666;
        small {
        font-size: 11.5px;
        color: #999;
        }
    }
    }
</style>
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script>
    $(document).ready(function(){
        var idInstruktur = "{{ auth()->user()->id_instruktur }}";
        if(idInstruktur == 'AD'){
            var idInstruktur = "";
        }
        var idSales = "{{ auth()->user()->id_sales }}";
        // console.log(idSales);
        if(idInstruktur || idSales){
            $('#peserta').show();
            $('#pesertaall').hide();
        }else{
           $('#peserta').hide();
           $('#pesertaall').show();
        }
        $('#pesertaalltable').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['excel', 'pdf'],
                "ajax": {
                    "url": "{{ route('getPesertaall') }}", // URL API untuk mengambil data
                    "type": "GET",
                    "beforeSend": function () {
                        $('#loadingModal').modal('show'); // Tampilkan modal saat memulai proses
                    },
                    "complete": function () {
                        $('#loadingModal').modal('hide'); // Sembunyikan modal saat proses selesai
                    }
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
            "dom": 'Bfrtip',
            "buttons": ['excel', 'pdf'],
                "ajax": {
                    "url": "{{ route('getRegistrasiall') }}", // URL API untuk mengambil data
                    "type": "GET",
                    "beforeSend": function () {
                        $('#loadingModal').modal('show'); // Tampilkan modal saat memulai proses
                    },
                    "complete": function () {
                        $('#loadingModal').modal('hide'); // Sembunyikan modal saat proses selesai
                    }
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
                        "data": "id_sales",
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
                            this.api().columns(4).search(idSales).draw();
                        }
            });
    });
</script>
@endpush
@endsection
