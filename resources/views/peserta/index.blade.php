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
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Peserta') }}</h3>
                    <table class="table table-striped" id="pesertatable">
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
                            @if ( auth()->user()->jabatan == 'HRD' )
                            <th scope="col">Aksi</th>
                            @endif
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

        });
    });
</script>
@endpush
@endsection

{{-- @foreach ( $post as $peserta )
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $peserta->nama }}</td>
                            <td>{{ $peserta->email }}</td>
                            @if ($peserta->jenis_kelamin == 'L')
                            <td>Laki-laki</td>
                            @else
                            <td>Perempuan</td>
                            @endif
                            <td>{{ $peserta->no_hp }}</td>
                            <td>{{ $peserta->alamat }}</td>
                            <td>{{ $peserta->perusahaan->nama_perusahaan }}</td>
                            <td>{{ $peserta->tanggal_lahir }}</td>
                            @if ( auth()->user()->jabatan == 'HRD' )
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('peserta.edit', $peserta->id) }}" data-toggle="tooltip" data-placement="top" title="Edit peserta">
                                            <img src="{{ asset('icon/edit-warning.svg') }}" class=""> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('peserta.show', $peserta->id) }}" data-toggle="tooltip" data-placement="top" title="Detail peserta">
                                            <img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Detail
                                        </a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('peserta.destroy', $peserta->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" data-toggle="tooltip" data-placement="top" title="Hapus peserta">
                                                <img src="{{ asset('icon/trash-danger.svg') }}" class=""> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            @endif
                          </tr>
                          @endforeach --}}
