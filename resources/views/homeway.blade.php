@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: ">
    <div class="row justify-content-center">
        <div class="row">
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
                                        <h3 class="card-title my-1">{{ __('Rencana Kelas Mingguan') }}</h3>
                                        <p class="card-title my-1">Periode <strong>{{ \Carbon\Carbon::parse($weekRange['start'])->translatedFormat('l, d F Y') }}  - {{ \Carbon\Carbon::parse($weekRange['end'])->translatedFormat('l, d F Y') }}</strong> </p>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    let selectedYear = {{ $now->year }};
    let selectedMonth = {{ $now->month - 1 }};

    function changeYear(year) {
        selectedYear = year;
        document.getElementById('dropdownMenuButton').innerText = year;
        updateContent();
    }

    function handleTabClick(month) {
        console.log(month);
        var result = month.split('-');

        localStorage.setItem('selectedMonth', result[0]);
        localStorage.setItem('selectedYear', result[1]);
        updateContent();
    }

    function updateContent() {
        var selectedMonth = localStorage.getItem('selectedMonth');
        var selectedYear = localStorage.getItem('selectedYear');
        console.log('Bulan yang dipilih:', selectedMonth);
        console.log('Tahun yang dipilih:', selectedYear);
        $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/datarkm/' + selectedYear + '/' + selectedMonth,
                dataType: 'json',
                success: function(data) {
                    // Update the table with the new data
                    console.log(data);
                    $('#tabel tbody').empty();
                    $.each(data.data, function(index, value) {
                        var sales = value.sales.map(function(sale) {
                            return sale.kode_karyawan;
                        }).join(', ');

                        var instruktur = value.instruktur.map(function(inst) {
                            return inst.kode_karyawan;
                        }).join(', ');

                        var perusahaan = value.perusahaan.map(function(perus) {
                            return perus.nama_perusahaan;
                        }).join(', ');

                        $('#tabel tbody').append('<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + value.materi.nama_materi + '</td>' +
                            '<td>' + perusahaan + '</td>' +
                            '<td>' + sales + '</td>' +
                            '<td>' + instruktur + '</td>' +
                            '<td>' + value.metode_kelas + '</td>' +
                            '<td>' + value.event + '</td>' +
                            '<td>' + value.ruang + '</td>' +
                            '<td>' + value.total_pax + '</td>' +
                            '</tr>');
                    });

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
    }

</script>
@endpush
@endsection
