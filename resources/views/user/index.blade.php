@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="" class="btn btn-md btn-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah User"><i class="fa fa-plus fa-fw"></i> Tambah User</a>
            <div class="card m-4">
                <div class="card-body table-responsive">
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
                            <th scope="col">Aksi</th>
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
                                <a href="" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus User"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a>
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
