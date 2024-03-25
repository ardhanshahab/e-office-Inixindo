@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' )
                    <a href="{{ route('perusahaan.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah User"><img src="{{ asset('icon/user-plus.svg') }}" class="" width="30px"> Data Perusahaan</a>
                @endif
            </div>
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Perusahaan') }}</h3>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Perusahaan</th>
                            <th scope="col">Kategori Perusahaan</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Sales</th>
                            <th scope="col">Status</th>
                            <th scope="col">NPWP</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">CP</th>
                            <th scope="col">Nomor Telepon</th>
                            {{-- <th scope="col">Foto NPWP</th> --}}
                            @if ( auth()->user()->jabatan == 'HRD' )
                            <th scope="col">Aksi</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $perusahaans as $perusahaan )
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $perusahaan->nama_perusahaan }}</td>
                            <td>{{ $perusahaan->kategori_perusahaan }}</td>
                            <td>{{ $perusahaan->lokasi }}</td>
                            @if (!$perusahaan->karyawan_key)
                            <td>Tidak Ada Sales</td>
                            @else
                            <td>{{ $perusahaan->karyawan->nama_lengkap }}</td>
                            @endif
                            <td>{{ $perusahaan->status }}</td>
                            <td>{{ $perusahaan->npwp }}</td>
                            <td>{{ $perusahaan->alamat }}</td>
                            <td>{{ $perusahaan->cp }}</td>
                            <td>{{ $perusahaan->no_telp }}</td>
                            <td>
                                <div class="d-flex">
                                    @if ( auth()->user()->jabatan == 'HRD' )
                                    <a href="/karyawan/{{$perusahaan->id}}/edit" class="btn click-warning-icon mx-1" data-toggle="tooltip" data-placement="top" title="Edit User"><img src="{{ asset('icon/edit.svg') }}" class="img-responsive" width="30px"></a>
                                    <a href="/profile/{{$perusahaan->id}}" class="btn click-secondary-icon mx-1" data-toggle="tooltip" data-placement="top" title="Detail User"><img src="{{ asset('icon/clipboard.svg') }}" class="img-responsive" width="30px"></a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('user.destroy', $perusahaan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn click-danger-icon mx-1" data-toggle="tooltip" data-placement="top" title="Hapus User"><img src="{{ asset('icon/trash.svg') }}" class="" width="30px"></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex">
                        {{ $perusahaans->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

</style>
@push('js')
    <script>

    </script>
@endpush
@endsection

