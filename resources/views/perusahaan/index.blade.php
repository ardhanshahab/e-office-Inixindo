@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' )
                    <a href="{{ route('perusahaan.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah Perusahaan"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Data Perusahaan</a>
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
                            {{-- <th scope="col">Kategori Perusahaan</th>
                            <th scope="col">Lokasi</th> --}}
                            <th scope="col">Sales</th>
                            {{-- <th scope="col">Status</th>
                            <th scope="col">NPWP</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">CP</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Foto NPWP</th> --}}
                            @if ( auth()->user()->jabatan == 'Office Manager' || auth()->user()->jabatan == 'Education Manager' || auth()->user()->jabatan == 'SPV Sales')
                            <th scope="col">Aksi</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $perusahaans as $perusahaan )
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $perusahaan->nama_perusahaan }}</td>
                            {{-- <td>{{ $perusahaan->kategori_perusahaan }}</td>
                            <td>{{ $perusahaan->lokasi }}</td> --}}
                            @if (!$perusahaan->karyawan_key)
                            <td>Tidak Ada Sales</td>
                            @else
                            <td>{{ $perusahaan->karyawan->kode_karyawan }}</td>
                            @endif
                            {{-- <td>{{ $perusahaan->status }}</td>
                            <td>{{ $perusahaan->npwp }}</td>
                            <td>{{ $perusahaan->alamat }}</td>
                            <td>{{ $perusahaan->cp }}</td>
                            <td>{{ $perusahaan->no_telp }}</td>
                            @if (!$perusahaan->foto_npwp)
                            <td> <a href="#" class="btn click-primary">Lihat Foto</a> </td>
                            @else
                            <td>Tidak Ada</td>
                            @endif --}}
                            @if ( auth()->user()->jabatan == 'Office Manager' || auth()->user()->jabatan == 'Education Manager' || auth()->user()->jabatan == 'SPV Sales')
                            <td>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('perusahaan.edit', $perusahaan->id) }}" data-toggle="tooltip" data-placement="top" title="Edit perusahaan">
                                            <img src="{{ asset('icon/edit-warning.svg') }}" class=""> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('perusahaan.show', $perusahaan->id) }}" data-toggle="tooltip" data-placement="top" title="Detail perusahaan">
                                            <img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Detail
                                        </a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('perusahaan.destroy', $perusahaan->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" data-toggle="tooltip" data-placement="top" title="Hapus perusahaan">
                                                <img src="{{ asset('icon/trash-danger.svg') }}" class=""> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            @endif
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

