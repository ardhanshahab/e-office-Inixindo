@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' )
                    <a href="{{ route('registrasi.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah registrasi"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Registrasi Peserta</a>
                @endif
            </div>
            {{-- {{ $post }} --}}
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Registrasi') }}</h3>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Pelatihan</th>
                            <th scope="col">Materi Pelatihan</th>
                            <th scope="col">Tanggal Pelatihan</th>
                            <th scope="col">Nama Peserta</th>
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
                            @foreach ( $post as $registrasi )
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $registrasi->id }}</td>
                            <td>{{ $registrasi->rkm->materi->nama_materi }}</td>
                            <td>{{ $registrasi->rkm->tanggal_awal }} - {{ $registrasi->rkm->tanggal_akhir }}</td>
                            <td>{{ $registrasi->peserta->nama }}</td>
                            <td>{{ $registrasi->peserta->email }}</td>
                            @if ($registrasi->peserta->jenis_kelamin == 'L')
                            <td>Laki-laki</td>
                            @else
                            <td>Perempuan</td>
                            @endif
                            <td>{{ $registrasi->peserta->no_hp }}</td>
                            <td>{{ $registrasi->peserta->alamat }}</td>
                            <td>{{ $registrasi->peserta->perusahaan->nama_perusahaan }}</td>
                            @if ($registrasi->peserta->tanggal_lahir == null)
                            <td>Tidak Ada Data</td>
                            @else
                            <td>{{ $registrasi->peserta->tanggal_lahir }}</td>
                            @endif
                            {{-- <td>{{ $registrasi->tanggal_lahir }}</td> --}}
                            @if ( auth()->user()->jabatan == 'HRD' )
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('registrasi.edit', $registrasi->id) }}" data-toggle="tooltip" data-placement="top" title="Edit registrasi">
                                            <img src="{{ asset('icon/edit-warning.svg') }}" class=""> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('registrasi.show', $registrasi->id) }}" data-toggle="tooltip" data-placement="top" title="Detail registrasi">
                                            <img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Detail
                                        </a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('registrasi.destroy', $registrasi->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" data-toggle="tooltip" data-placement="top" title="Hapus registrasi">
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
                        {{-- {{ $post->links() }} --}}
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

