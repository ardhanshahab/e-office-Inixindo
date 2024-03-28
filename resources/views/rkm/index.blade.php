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
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <li class="nav-item dropdown">
                                <a id="dropdownMenuButton" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ $now->year }}</a>
                                <ul class="dropdown-menu">
                                    @foreach($years as $year)
                                        <li><a class="dropdown-item" href="#" onclick="changeYear('{{ $year }}')">{{ $year }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @foreach($months as $index => $month)
                                <button class="nav-link{{ $index === $now->month - 1 ? ' active' : '' }}" id="nav-month-{{ $index }}" data-bs-toggle="tab" data-bs-target="#nav-tabContent-{{ $index }}" type="button" role="tab" aria-controls="nav-tabContent-{{ $index }}" aria-selected="{{ $index === $now->month - 1 ? 'true' : 'false' }}">{{ $month }}</button>
                            @endforeach
                        </div>
                    </nav>
                    @foreach($months as $index => $month)
                        <div class="tab-pane fade{{ $index === $now->month - 1 ? ' show active' : '' }}" id="nav-tabContent-{{ $index }}" role="tabpanel" aria-labelledby="nav-month-{{ $index }}">
                            @php
                                $selectedMonth = $index + 1; // Bulan dimulai dari 1, sedangkan index dimulai dari 0
                                $selectedYear = $now->year; // Tahun yang sedang dipilih
                            @endphp
                            @foreach($rkmsByWeek as $rkms)
                                @php
                                    // Parsing tanggal awal minggu ke dalam format bulan dan tahun
                                    $weekStart = \Carbon\Carbon::parse($rkms['weekRange']['start']);
                                    $weekMonth = $weekStart->month;
                                    $weekYear = $weekStart->year;
                                @endphp
                                @if ($weekMonth === $selectedMonth && $weekYear === $selectedYear)
                                    <div class="card m-4">
                                        <div class="card-body table-responsive">
                                            <h3 class="card-title my-1">{{ __('Rencana Kelas Mingguan') }}</h3>
                                            <p class="card-title my-1">Periode Minggu ke- <strong>{{ \Carbon\Carbon::parse($rkms['weekRange']['start'])->translatedFormat('l, d F Y') }}  - {{ \Carbon\Carbon::parse($rkms['weekRange']['end'])->translatedFormat('l, d F Y') }}</strong> </p>
                                            <table class="table table-striped" id="tabel">
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
                                                    @foreach($rkms['rkms'] as $rkm)
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td>{{ $rkm->materi->nama_materi }}</td>
                                                            <td>
                                                                @foreach($rkm->perusahaan as $perusahaan)
                                                                    {{ $perusahaan->nama_perusahaan }}{{ !$loop->last ? ', ' : '' }}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach($rkm->sales as $sales)
                                                                    {{ $sales->kode_karyawan }}{{ !$loop->last ? ', ' : '' }}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach($rkm->instruktur as $instruktur)
                                                                    {{ $instruktur->kode_karyawan }}{{ !$loop->last ? ', ' : '' }}
                                                                @endforeach
                                                            </td>
                                                            <td>{{ $rkm->metode_kelas }}</td>
                                                            <td>{{ $rkm->event }}</td>
                                                            <td>{{ $rkm->ruang }}</td>
                                                            <td>{{ $rkm->total_pax }}</td>
                                                            {{-- <td>
                                                                <div class="d-flex">
                                                                    @if (auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'Instruktur' || auth()->user()->jabatan == 'General Manager' || auth()->user()->jabatan == 'Education Manager')
                                                                        <a href="{{ route('rkm.edit', $rkm->id) }}" class="btn click-warning-icon mx-1" data-toggle="tooltip" data-placement="top" title="Edit User"><img src="{{ asset('icon/edit.svg') }}" class="img-responsive" width="30px"></a>
                                                                        <a href="{{ route('rkm.show', $rkm->id) }}" class="btn click-secondary-icon mx-1" data-toggle="tooltip" data-placement="top" title="Detail User"><img src="{{ asset('icon/clipboard.svg') }}" class="img-responsive" width="30px"></a>
                                                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('rkm.destroy', $rkm->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn click-danger-icon mx-1" data-toggle="tooltip" data-placement="top" title="Hapus User"><img src="{{ asset('icon/trash.svg') }}" class="" width="30px"></button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
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
        function changeYear(year) {
            document.getElementById('dropdownMenuButton').innerText = year;
        }
    </script>
@endpush
@endsection


