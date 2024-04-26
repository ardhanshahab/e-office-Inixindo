@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' )
                    <a href="/user/register" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah User"><img src="{{ asset('icon/user-plus.svg') }}" class="" width="30px"> Tambah User</a>
                @endif
            </div>
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Karyawan') }}</h3>
                    <table class="table table-striped" id="usertable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Divisi</th>
                            {{-- <th scope="col">Divisi</th> --}}
                            {{-- @if ( auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'General Manager' ) --}}
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
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<script>
    $(document).ready(function(){
        $('#usertable').DataTable({
            "processing": true,
            "ajax": {
                "url": "{{ route('getUserall') }}", // URL API untuk mengambil data
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
                {"data": "karyawan.nip"},
                {"data": "username"},
                {"data": "karyawan.nama_lengkap"},
                {"data": "karyawan.jabatan"},
                {"data": "karyawan.divisi"},
                // {"data": "karyawan.divisi"},
                {
                "data": null,
                "render": function(data, type, row) {
                    var actions = "";
                    var allowedRoles = ['Office Manager', 'Education Manager', 'SPV Sales', 'HRD'];
                    var userRole = '{{ auth()->user()->jabatan }}';

                    if (allowedRoles.includes(userRole)) {
                        actions += '<div class="dropdown">';
                        actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
                        actions += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                        actions += '<a class="dropdown-item" href="{{ url('/profile') }}/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Detail User"><img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Detail</a>';
                        actions += '<form onsubmit="return confirm(\'Apakah Anda Yakin ?\');" action="{{ url('/user') }}/' + row.id + '" method="POST">';
                        actions += '@csrf';
                        actions += '<input type="hidden" name="_method" value="DELETE">';
                        actions += '<button type="submit" class="dropdown-item"><img src="{{ asset('icon/trash-danger.svg') }}" class=""> Hapus</button>';
                        actions += '</form>';
                        actions += '</div>';
                        actions += '</div>';
                    } else {
                        actions += '<div class="dropdown">';
                        actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
                        actions += '</div>';
                    }

                    return actions;
                }
            }
            ],
            "createdRow": function(row, data, dataIndex) {
        $("td", row).each(function() {
            if ($(this).html() === "" || $(this).html() === null || $(this).html() === "null") {
                $(this).html("-");
            }
        });
    }
        });
    });
</script>
@endpush
@endsection
