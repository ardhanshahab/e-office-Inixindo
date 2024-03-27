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
                    <table class="table table-striped" id="userTable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Divisi</th>
                            @if ( auth()->user()->jabatan == 'HRD' )
                            <th scope="col">Aksi</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ( $users as $user )
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            @if (!$user->karyawan->nip)
                                <td>-</td>
                            @else
                            <td>{{ $user->karyawan->nip }}</td>
                            @endif
                            <td>{{ $user->karyawan->nama_lengkap }}</td>
                            <td>{{ $user->karyawan->jabatan }}</td>
                            <td>{{ $user->karyawan->divisi }}</td>
                            <td>
                                <div class="d-flex">
                                    @if ( auth()->user()->jabatan == 'HRD' )
                                    <a href="/karyawan/{{$user->id}}/edit" class="btn click-warning-icon mx-1" data-toggle="tooltip" data-placement="top" title="Edit User"><img src="{{ asset('icon/edit.svg') }}" class="img-responsive" width="30px"></a>
                                    <a href="/profile/{{$user->id}}" class="btn click-secondary-icon mx-1" data-toggle="tooltip" data-placement="top" title="Detail User"><img src="{{ asset('icon/clipboard.svg') }}" class="img-responsive" width="30px"></a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn click-danger-icon mx-1" data-toggle="tooltip" data-placement="top" title="Hapus User"><img src="{{ asset('icon/trash.svg') }}" class="" width="30px"></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                          </tr>
                          @endforeach --}}
                        </tbody>
                      </table>
                      <div class="d-flex">
                        {{-- {{ $users->links() }} --}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

</style>
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready( function () {
            $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/datarkm',
                dataType: 'json',
                success: function(data, val) {
                    console.log(data);
                }
            });
                $('#tableTest').DataTable({
                    rowGroup: true,
                    processing: true,
                    autoWidth: true,
                    responsive: true,
                    searching: true,
                    sort: true,
                    ajax: {
                        url: "{{ route('datarkm') }}",
                        dataSrc: 'data'
                    },
                    columns: [
                        { data: 'id', title:  'No'},
                        {   data: 'materi_concat',
                            title: 'Materi',
                        },
                        // { data: 'sales.nama_lengkap', title: 'Sales' },
                        { data: 'instruktur_key', title: 'Instruktur' },
                        // { data: 'perusahaan.nama_perusahaan', title: 'Perusahaan' }
                    ],
                    rowGroup: {
                        dataSrc: 'materi_concat'
                    }
                });
        });
    </script>
@endpush
@endsection
