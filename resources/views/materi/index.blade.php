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
                @if ( auth()->user()->jabatan == 'GM' || auth()->user()->jabatan == 'Accounting' || auth()->user()->jabatan == 'Accounting' || auth()->user()->jabatan == 'Education Manager'|| auth()->user()->jabatan == 'SPV Sales' || auth()->user()->jabatan == 'Adm Sales')
                    <a href="{{ route('materi.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah User"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Data Materi</a>
                @endif
            </div>
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Materi') }}</h3>
                    <table class="table table-striped" id="materitable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Materi</th>
                                <th scope="col">Kode Materi</th>
                                <th scope="col">Kategori Materi</th>
                                <th scope="col">Vendor</th>
                                    <th scope="col">Aksi</th>
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
    function showAlert() {
            alert("Silabus tidak ada");
        }
    $(document).ready(function(){
        $('#materitable').DataTable({
            "dom": 'Bfrtip',
            "buttons": ['excel', 'pdf'],
            "ajax": {
                "url": "{{ route('getMateri') }}", // URL API untuk mengambil data
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
                {"data": "id"},
                {"data": "nama_materi"},
                {"data": "kode_materi"},
                {"data": "kategori_materi"},
                {"data": "vendor"},
                {
                    "data": null,
                    "render": function(data, type, row) {
                        var actions = "";
                        var allowedRoles = ['Accounting', 'Education Manager', 'SPV Sales', 'HRD', 'GM', 'Adm Sales'];
                        var userRole = '{{ auth()->user()->jabatan }}';
                        if (userRole === 'HRD' || userRole === 'Direktur Utama' || userRole === 'Direktur' ) {
                            actions += '<div class="dropdown">';
                            actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
                            actions += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                            if (row.silabus === null) {
                                actions += '<a onclick="showAlert()" class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Lihat Silabus"><img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Lihat Silabus</a>';
                            } else {
                                actions += '<a class="dropdown-item" href="{{ url('/storage') }}/' + row.silabus + '" data-toggle="tooltip" data-placement="top" title="Lihat Silabus"><img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Lihat Silabus</a>';
                            }
                            actions += '</div>';
                            actions += '</div>';
                        }else if (allowedRoles.includes(userRole)) {
                            actions += '<div class="dropdown">';
                            actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
                            actions += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                            actions += '<a class="dropdown-item" href="{{ url('/materi') }}/' + row.id + '/edit" data-toggle="tooltip" data-placement="top" title="Edit Peserta"><img src="{{ asset('icon/edit-warning.svg') }}" class=""> Edit</a>';
                            if( data.silabus === null){
                                actions += '<a onclick="showAlert()" class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Lihat Silabus"><img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Lihat Silabus</a>';
                            }else{
                                actions += '<a class="dropdown-item" href="{{ url('/storage') }}/' + row.silabus + '" data-toggle="tooltip" data-placement="top" title="Lihat Silabus"><img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Lihat Silabus</a>';
                            }
                            actions += '<form onsubmit="return confirm(\'Apakah Anda Yakin ?\');" action="{{ url('/materi') }}/' + row.id + '" method="POST">';
                            actions += '@csrf';
                            actions += '@method('DELETE')';
                            actions += '<button type="submit" class="dropdown-item"><img src="{{ asset('icon/trash-danger.svg') }}" class=""> Hapus</button>';
                            actions += '</form>';
                            actions += '</div>';
                            actions += '</div>';
                        } else {
                            actions += '<div class="dropdown">';
                            actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
                            actions += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                            if( row.silabus === null){
                                actions += '<a disabled class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Lihat Silabus"><img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Lihat Silabus</a>';
                            }else{
                                actions += '<a class="dropdown-item" href="{{ url('/storage') }}/' + row.silabus + '" data-toggle="tooltip" data-placement="top" title="Lihat Silabus"><img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Lihat Silabus</a>';
                            }
                            actions += '</div>';
                            actions += '</div>';
                        }

                        return actions;
                    }
                }
            ]
        });
    });
</script>
@endpush
@endsection
