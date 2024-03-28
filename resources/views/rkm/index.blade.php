@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: ">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-12 d-flex my-2">
                @if ( auth()->user()->jabatan == 'GM' || auth()->user()->jabatan == 'sales' || auth()->user()->jabatan == 'SPV Sales' || auth()->user()->jabatan == 'Sales' || auth()->user()->jabatan == 'Admin Sales' || auth()->user()->jabatan == 'Finance & Accounting' )
                <a class="btn click-primary mx-1" href="{{ route('rkm.create') }}">Tambah RKM</a>
                <a class="btn click-primary mx-1" href="{{ route('rkmEdit') }}">Edit RKM </a>
                @endif
                @if ( auth()->user()->jabatan == 'Education Manager')
                <a class="btn click-primary mx-1" href="{{ route('editInstruktur') }}">Tambah/Edit Instruktur RKM </a>
                @endif
            </div>
            <div class="col-md-3">
                <nav>
                    <div class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
                        @foreach($monthRanges as $index => $monthRange)
                            <button onclick="handleTabClick('{{ $monthRange['month'] }}')" class="nav-link{{ $index === 0 ? ' active' : '' }}" id="nav-tab-{{ $index }}" data-bs-toggle="tab" data-bs-target="#nav-tabContent-{{ $index }}" type="button" role="tab" aria-controls="nav-tabContent-{{ $index }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $monthRange['month'] }}
                            </button>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-md-9" id="content">
                <div class="tab-content" id="myTabContent">
                    @foreach ($monthRanges as $index => $monthRange)
                        <div class="tab-pane fade{{ $index === 0 ? ' show active' : '' }}" id="nav-tabContent-{{ $index }}" role="tabpanel" aria-labelledby="nav-tab-{{ $index }}">
                            @foreach ($monthRange['weeks'] as $weekRange)
                                <div class="card m-4">
                                    <div class="card-body table-responsive">
                                        <input type="hidden" id="monthRangesData" value="{{ json_encode($monthRanges) }}">
                                        <h3 class="card-title my-1">{{ __('Rencana Kelas Mingguan') }}</h3>
                                        <p class="card-title my-1">Periode <strong>{{ \Carbon\Carbon::parse($weekRange['start'])->translatedFormat('l, d F Y') }}  - {{ \Carbon\Carbon::parse($weekRange['end'])->translatedFormat('l, d F Y') }}</strong> </p>
                                        @foreach ($rkmsByWeek as $rkms)
                                            @if ($rkms['weekRange'] ==  $weekRange )
                                                @foreach ($rkms['rkms'] as $rkmsData)

                                                    <table class="table table-responsive table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Materi</th>
                                                                <th scope="col">Perusahaan</th>
                                                                <th scope="col">Kode Sales</th>
                                                                <th scope="col">Instruktur</th>
                                                                <th scope="col">Metode Kelas</th>
                                                                <th scope="col">Event</th>
                                                                <th scope="col">Ruang</th>
                                                                <th scope="col">Pax</th>
                                                                @if (auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'Instruktur' || auth()->user()->jabatan == 'Education Manager')
                                                                    <th scope="col">Aksi</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $rkmsData->materi->nama_materi }}</td>
                                                            <td>
                                                            @foreach ($rkmsData['perusahaan'] as $perusahaan )
                                                            {{ $perusahaan->nama_perusahaan }},
                                                            @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach ($rkmsData['sales'] as $sales )
                                                                {{ $sales->kode_karyawan }},
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @if (!$rkmsData->instruktur_key)
                                                                    <p>Belum Ditentukan</p>
                                                                    @else
                                                                    {{ $rkmsData->instruktur_key }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $rkmsData->metode_kelas }}</td>
                                                            <td>{{ $rkmsData->event }}</td>
                                                            <td>{{ $rkmsData->ruang }}</td>
                                                            <td>{{ $rkmsData->total_pax }}</td>
                                                            <td>
                                                            <a href="/rkm/{{$rkmsData->materi_key}}" class="btn click-secondary-icon mx-1" data-toggle="tooltip" data-placement="top" title="Detail RKM"><img src="{{ asset('icon/clipboard.svg') }}" class="img-responsive" width="30px"></a>
                                                            </td>
                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<style>
    #content{
        overflow-y:hidden;
    }
    #myTabContent{
        max-height: 100vh;
        overflow-y:scroll;
    }
    .nav-tabs {
        flex-direction: column;
        max-height: 100vh; /* Atur ketinggian maksimum untuk scroll */
        overflow-y: auto; /* Aktifkan overflow vertical */
    }

    .nav-link {
        text-align: left; /* Atur teks tab ke kiri */
    }

    .tab-content {
        overflow: auto; /* Aktifkan overflow vertical */
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }
</style>

@push('js')

</script>
@endpush
@endsection
