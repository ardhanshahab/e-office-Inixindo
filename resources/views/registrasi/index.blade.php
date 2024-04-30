@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
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
        {{-- <a href="{{ url()->previous() }}" class="btn click-primary my-2"><img src="{{ asset('icon/arrow-left.svg') }}" class="img-responsive" width="20px"> Back</a> --}}
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'Customer Care' || auth()->user()->jabatan == 'Sales')
                    <a href="{{ route('registrasi.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah registrasi"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Registrasi Peserta</a>
                @endif
            </div>
            {{-- {{ $post }} --}}
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Registrasi') }}</h3>
                    <table class="table table-striped" id="registrasitable">
                        <thead>
                          <tr>
                            <th scope="col">Materi Pelatihan</th>
                            <th scope="col">Tanggal Pelatihan</th>
                            <th scope="col">Instruktur</th>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Nama Peserta</th>
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
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
{{-- <script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script> --}}
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script>
    $(document).ready(function(){
        var idInstruktur = "{{ auth()->user()->id_instruktur }}";

        $('#registrasitable').DataTable({

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
                {"data": "materi.nama_materi"},
                {
                    "data": "rkm.tanggal_awal",
                    "render": function(data) {
                        return moment(data).format('DD MMMM YYYY');
                    }
                },
                {"data": "id_instruktur"},
                // {
                //     "data": null,
                //     "render": function (data, type, row, meta) {
                //         return meta.row + 1; // Nomor urut dimulai dari 1, bukan dari 0
                //     }
                // },
                {"data": "peserta.nama"},
                {"data": "peserta.email"},
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
                this.api().columns(2).search(idInstruktur).draw();
            }
        });
    });
</script>
@endpush
@endsection
