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
            {{-- <a href="{{ url()->previous() }}" class="btn click-primary my-2"><img src="{{ asset('icon/arrow-left.svg') }}" class="img-responsive" width="20px"> Back</a> --}}
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'Sales' || auth()->user()->jabatan == 'Adm Sales' || auth()->user()->jabatan == 'SPV Sales' || auth()->user()->jabatan == 'GM' || auth()->user()->jabatan == 'Accounting' || auth()->user()->jabatan == 'Accounting')
                    <a href="{{ route('perusahaan.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah Perusahaan"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Data Perusahaan</a>
                @endif
            </div>
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Perusahaan') }}</h3>
                    <table class="table table-striped" id="perusahaantable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Perusahaan</th>
                            <th scope="col">Sales</th>
                            {{-- @if ( auth()->user()->jabatan == 'Accounting' || auth()->user()->jabatan == 'Education Manager' || auth()->user()->jabatan == 'SPV Sales') --}}
                            <th scope="col">Aksi</th>
                            {{-- @endif --}}
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
<script>
    $(document).ready(function(){
        $('#perusahaantable').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
            "ajax": {
                "url": "{{ route('getPerusahaanall') }}", // URL API untuk mengambil data
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
                {"data": "nama_perusahaan"},
                {
                    "data": null,
                    "render": function (data, type, row) {
                        // Tampilkan kode karyawan jika karyawan tidak null, atau teks 'Tidak Ada Sales' jika null
                        return data.karyawan && data.karyawan.kode_karyawan ? data.karyawan.kode_karyawan : 'Tidak Ada Sales';
                    }
                },

                {
                "data": null,
                "render": function(data, type, row) {
                    var actions = "";
                        actions += '<div class="dropdown">';
                        actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
                        actions += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                        actions += '<a class="dropdown-item" href="{{ url('/perusahaan') }}/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Detail User"><img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Detail</a>';
                        actions += '<form onsubmit="return confirm(\'Apakah Anda Yakin ?\');" action="{{ url('/perusahaan') }}/' + row.id + '" method="POST">';
                        actions += '@csrf';
                        actions += '@method('DELETE')';
                        actions += '<button type="submit" class="dropdown-item"><img src="{{ asset('icon/trash-danger.svg') }}" class=""> Hapus</button>';
                        actions += '</form>';
                        actions += '</div>';
                        actions += '</div>';
                    return actions;
                }
            }
            ]
        });
    });
</script>
@endpush
@endsection

