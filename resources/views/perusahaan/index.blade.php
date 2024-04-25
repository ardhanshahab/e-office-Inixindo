@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <a href="{{ url()->previous() }}" class="btn click-primary my-2"><img src="{{ asset('icon/arrow-left.svg') }}" class="img-responsive" width="20px"> Back</a> --}}
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' )
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
                            {{-- @if ( auth()->user()->jabatan == 'Office Manager' || auth()->user()->jabatan == 'Education Manager' || auth()->user()->jabatan == 'SPV Sales') --}}
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

</style>
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<script>
    $(document).ready(function(){
        $('#perusahaantable').DataTable({
            "processing": true,
            "ajax": {
                "url": "{{ route('getPerusahaanall') }}", // URL API untuk mengambil data
                "type": "GET",
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
                    var allowedRoles = ['Office Manager', 'Education Manager', 'SPV Sales', 'HRD'];
                    var userRole = '{{ auth()->user()->jabatan }}';

                    if (allowedRoles.includes(userRole)) {
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
                    } else {
                        actions += '<div class="dropdown">';
                        actions += '<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>';
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

