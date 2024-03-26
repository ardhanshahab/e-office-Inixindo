@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' )
                    <a href="{{ route('materi.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah User"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Data Materi</a>
                @endif
            </div>
            <div class="card m-4">
                <div class="card-body table-responsive">
                    <h3 class="card-title text-center my-1">{{ __('Data Materi') }}</h3>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Materi</th>
                            <th scope="col">Kategori Materi</th>
                            <th scope="col">Vendor</th>
                            @if ( auth()->user()->jabatan == 'HRD' )
                            <th scope="col">Aksi</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $materis as $materi )
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $materi->nama_materi }}</td>
                            <td>{{ $materi->kategori_materi }}</td>
                            <td>{{ $materi->vendor }}</td>
                            <td>
                                <div class="d-flex">
                                    @if ( auth()->user()->jabatan == 'HRD' )
                                    <a href="{{ route('materi.edit', $materi->id) }}" class="btn click-warning-icon mx-1" data-toggle="tooltip" data-placement="top" title="Edit User"><img src="{{ asset('icon/edit.svg') }}" class="img-responsive" width="30px"></a>
                                    <a href="{{ route('materi.show', $materi->id) }}" class="btn click-secondary-icon mx-1" data-toggle="tooltip" data-placement="top" title="Detail User"><img src="{{ asset('icon/clipboard.svg') }}" class="img-responsive" width="30px"></a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('materi.destroy', $materi->id) }}" method="POST">
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
                        {{ $materis->links() }}
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

