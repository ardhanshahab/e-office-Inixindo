@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ( auth()->user()->role == 'Admin' )
            <a href="/register" class="btn btn-md btn-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah User"><i class="fa fa-plus fa-fw"></i> Tambah User</a>
            @endif
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Karyawan') }}</h3>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Pegawai</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Role</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Tempat Lahir</th>
                            <th scope="col">Tanggal Lahir</th>
                            @if ( auth()->user()->role == 'Admin' )
                            <th scope="col">Aksi</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $users as $user )
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->nip }}</td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->jabatan }}</td>
                            <td>{{ $user->divisi }}</td>
                            <td>{{ $user->tempat_lahir }}</td>
                            <td>{{ $user->tanggal_lahir }}</td>
                            <td>
                                <div class="d-flex">
                                    @if ( auth()->user()->role == 'Admin' )
                                    <a href="/user/{{$user->id}}/edit" class="btn btn-warning mx-1" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-1" data-toggle="tooltip" data-placement="top" title="Hapus User"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex">
                        {{ $users->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
