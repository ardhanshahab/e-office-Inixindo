@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @if ( auth()->user()->jabatan == 'HRD' )
                    <a href="{{ route('rkm.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah User"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Rencana Kelas Mingguan</a>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    @foreach($rkmsByWeek as $index => $rkms)
                        <div class="card m-4">
                            <div class="card-body table-responsive">
                                <h3 class="card-title my-1">{{ __('Rencana Kelas Mingguan') }}</h3>
                                <p class="card-title my-1">Periode Minggu ke-{{ $index + 1 }} <strong> {{ $rkms['weekRange']['start'] }} - {{ $rkms['weekRange']['end'] }}</strong> </p>
                                <table class="table table-striped" id="tabel">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Materi</th>
                                            {{-- <th scope="col">Tanggal Awal</th>
                                            <th scope="col">Tanggal Akhir</th> --}}
                                            <th scope="col">Perusahaan</th>
                                            <th scope="col">Kode Sales</th>
                                            <th scope="col">Instruktur</th>
                                            <th scope="col">Metode Kelas</th>
                                            <th scope="col">Event</th>
                                            <th scope="col">Ruang</th>
                                            <th scope="col">Pax</th>
                                            {{-- <th scope="col">Status</th> --}}
                                            @if (auth()->user()->jabatan == 'HRD')
                                                <th scope="col">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rkms['rkms'] as $rkm)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $rkm->materi->nama_materi }}</td>
                                                {{-- <td>{{ $rkm->tanggal_awal }}</td>
                                                <td>{{ p $rkm->tanggal_akhir }}</td> --}}
                                                <td>{{ $rkm->perusahaan->nama_perusahaan }}</td>
                                                <td>{{ $rkm->sales_key }}</td>
                                                <td>{{ $rkm->instruktur_key }}</td>
                                                <td>{{ $rkm->metode_kelas }}</td>
                                                <td>{{ $rkm->event }}</td>
                                                <td>{{ $rkm->ruang }}</td>
                                                <td>{{ $rkm->pax }}</td>
                                                {{-- <td>{{ $rkm->status }}</td> --}}
                                                <td>
                                                    <div class="d-flex">
                                                        @if (auth()->user()->jabatan == 'HRD')
                                                            <a href="{{ route('rkm.edit', $rkm->id) }}" class="btn click-warning-icon mx-1" data-toggle="tooltip" data-placement="top" title="Edit User"><img src="{{ asset('icon/edit.svg') }}" class="img-responsive" width="30px"></a>
                                                            <a href="{{ route('rkm.show', $rkm->id) }}" class="btn click-secondary-icon mx-1" data-toggle="tooltip" data-placement="top" title="Detail User"><img src="{{ asset('icon/clipboard.svg') }}" class="img-responsive" width="30px"></a>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('rkm.destroy', $rkm->id) }}" method="POST">
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
                                    {{-- {{ $rkms->links() }} --}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
<style>

</style>
@push('js')
    <script>
        var weekRanges = {!! $json !!};
        console.log(weekRanges);
    </script>
@endpush
@endsection
{{--
<table class="table table-striped" id="tabel">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Materi</th>
        <th scope="col">Tanggal Awal</th>
        <th scope="col">Tanggal Akhir</th>
        <th scope="col">Perusahaan</th>
        <th scope="col">Kode Sales</th>
        <th scope="col">Instruktur</th>
        <th scope="col">Metode Kelas</th>
        <th scope="col">Event</th>
        <th scope="col">Ruang</th>
        <th scope="col">Pax</th>
        <th scope="col">Status</th>
        @if ( auth()->user()->jabatan == 'HRD' )
        <th scope="col">Aksi</th>
        @endif
      </tr>
    </thead>
    <tbody>
@foreach ( $rkms as $rkm )
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $rkm->materi->nama_materi }}</td>
        <td>{{ $rkm->tanggal_awal }}</td>
        <td>{{ $rkm->tanggal_akhir }}</td>
        <td>{{ $rkm->perusahaan->nama_perusahaan }}</td>
        <td>{{ $rkm->sales_key }}</td>
        <td>{{ $rkm->instruktur_key }}</td>
        <td>{{ $rkm->metode_kelas }}</td>
        <td>{{ $rkm->event }}</td>
        <td>{{ $rkm->ruang }}</td>
        <td>{{ $rkm->pax }}</td>
        <td>{{ $rkm->status }}</td>
        <td>
            <div class="d-flex">
                @if ( auth()->user()->jabatan == 'HRD' )
                <a href="{{ route('rkm.edit', $rkm->id) }}" class="btn click-warning-icon mx-1" data-toggle="tooltip" data-placement="top" title="Edit User"><img src="{{ asset('icon/edit.svg') }}" class="img-responsive" width="30px"></a>
                <a href="{{ route('rkm.show', $rkm->id) }}" class="btn click-secondary-icon mx-1" data-toggle="tooltip" data-placement="top" title="Detail User"><img src="{{ asset('icon/clipboard.svg') }}" class="img-responsive" width="30px"></a>
                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('rkm.destroy', $rkm->id) }}" method="POST">
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
  @foreach(json_decode($json) as $week)
                    <div class="card m-4">
                        <div class="card-body table-responsive">
                            <h3 class="card-title my-1">{{ __('Rencana Kelas Mingguan') }}</h3>
                            <p class="card-title my-1">Periode {{ $week->start }} - {{ $week->end }}</p>
  --}}
