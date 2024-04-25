@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        {{-- <a href="{{ url()->previous() }}" class="btn click-primary my-2"><img src="{{ asset('icon/arrow-left.svg') }}" class="img-responsive" width="20px"> Back</a> --}}
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'Education Manager')
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
                            <th scope="col">No</th>
                            <th scope="col">Materi Pelatihan</th>
                            <th scope="col">Tanggal Pelatihan</th>
                            <th scope="col">Instruktur</th>
                            <th scope="col">Nama Peserta</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Nomor Handphone</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Perusahaan/Instansi</th>
                            <th scope="col">Tanggal Lahir</th>
                            {{-- @if ( auth()->user()->jabatan == 'HRD' ) --}}
                            {{-- <th scope="col">Aksi</th> --}}
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
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script>
    $(document).ready(function(){
        var idInstruktur = "{{ auth()->user()->id_instruktur }}";

        $('#registrasitable').DataTable({
            "processing": true,
            "ajax": {
                "url": "{{ route('getRegistrasiall') }}", // URL API untuk mengambil data
                "type": "GET",
            },
            "columns": [
                {"data": "id"},
                {"data": "materi.nama_materi"},
                {
                    "data": "rkm.tanggal_awal",
                    "render": function(data) {
                        return moment(data).format('DD MMMM YYYY');
                    }
                },
                {"data": "id_instruktur"},
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
            this.api().columns(3).search(idInstruktur).draw();
        }
        });
    });
</script>
@endpush
@endsection
