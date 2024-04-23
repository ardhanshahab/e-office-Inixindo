@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        {{-- <a href="{{ url()->previous() }}" class="btn click-primary my-2"><img src="{{ asset('icon/arrow-left.svg') }}" class="img-responsive" width="20px"> Back</a> --}}
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
                            @if ( auth()->user()->jabatan == 'Office Manager' || auth()->user()->jabatan == 'Education Manager' || auth()->user()->jabatan == 'SPV Sales')
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
                                @if ( auth()->user()->jabatan == 'Office Manager' || auth()->user()->jabatan == 'Education Manager' || auth()->user()->jabatan == 'SPV Sales')
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('materi.edit', $materi->id) }}"><img src="{{ asset('icon/edit-warning.svg') }}" class=""> Edit</a>
                                        {{-- <a class="dropdown-item" href="{{ route('materi.show', $materi->id) }}"> <img src="{{ asset('icon/clipboard-primary.svg') }}" class=""> Detail</a> --}}
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('materi.destroy', $materi->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"><img src="{{ asset('icon/trash-danger.svg') }}" class=""> Hapus</button>
                                        </form>
                                        @endif
                                    </div>
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

