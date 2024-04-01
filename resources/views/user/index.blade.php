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
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Divisi</th>
                            @if ( auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'General Manager' )
                            <th scope="col">Aksi</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $user )
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            @if ($user->karyawan->nip == null)
                            <p>-</p>
                            @else
                            <td>{{ $user->karyawan->nip }}</td>
                            @endif
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->karyawan->nama_lengkap }}</td>
                            <td>{{ $user->karyawan->jabatan }}</td>
                            <td>{{ $user->karyawan->divisi }}</td>
                            @if ( auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'General Manager' )
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="/karyawan/{{$user->id}}/edit" data-toggle="tooltip" data-placement="top" title="Edit User">
                                            <i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="/profile/{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Detail User">
                                            <i class="fa fa-clipboard fa-fw" aria-hidden="true"></i> Detail
                                        </a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" data-toggle="tooltip" data-placement="top" title="Hapus User">
                                                <i class="fa fa-trash fa-fw" aria-hidden="true"></i> Hapus
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
                      <div class="d-flex justify-content-center">
                        {{ $users->links() }}
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
