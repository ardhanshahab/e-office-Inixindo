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
                @if ( auth()->user()->jabatan == 'Customer Care' || auth()->user()->jabatan == 'Sales' || auth()->user()->jabatan == 'Customer Service')
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
                            <th scope="col">Nama Peserta</th>
                            <th scope="col">Perusahaan/Instansi</th>
                            <th scope="col">Materi Pelatihan</th>
                            <th scope="col">Periode Pelatihan</th>
                            <th scope="col">Instruktur</th>
                            <th scope="col">Sales</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
<script>
    $(document).ready(function(){
        var idInstruktur = "{{ auth()->user()->id_instruktur }}";
        var idSales = "{{ auth()->user()->id_sales }}";

        if(idInstruktur == 'AD'){
            var idInstruktur = "";
        }

        $('#registrasitable').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['excel', 'pdf'],
            "ajax": {
                "url": "{{ route('getRegistrasiall') }}", // URL API untuk mengambil data
                "type": "GET",
                "beforeSend": function () {
                    $('#loadingModal').modal('show'); // Tampilkan modal saat memulai proses
                },
                "complete": function () {
                    setTimeout(() => {
                        $('#loadingModal').modal('hide');
                    }, 1000);
                }
            },
            "columns": [
                {"data": "peserta.nama"},
                {"data": "peserta.perusahaan.nama_perusahaan"},

                {"data": "materi.nama_materi"},
                {
                    "data": null,
                    "render": function(data) {
                        moment.locale('id')
                        return moment(data.rkm.tanggal_awal).format('DD MMMM YYYY')+  ' s/d ' + moment(data.rkm.tanggal_akhir).format('DD MMMM YYYY');
                    }
                },
                {"data": "id_instruktur"},
                {"data": "id_sales"},

            ],
            "initComplete": function() {
                this.api().columns(4).search(idInstruktur).draw();
                this.api().columns(5).search(idSales).draw();
            }
        });
    });
</script>
@endpush
@endsection
