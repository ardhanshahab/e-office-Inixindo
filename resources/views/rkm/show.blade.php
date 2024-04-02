
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Rencana Kelas Mingguan</h5>
                    <div class="row">
                        <div class="col-md-5">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @php
                                    $posts = $rkm->first()->id; // Mengambil ID dari objek pertama dalam array $rkm
                                    $materi_key = $rkm->first()->materi_key; // Mengambil ID dari objek pertama dalam array $rkm
                                    // echo $postId;
                                    // $posts = $postId;
                                @endphp
                                @foreach ($rkm as $post)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="kelas-tab-{{ $post->id }}" data-bs-toggle="tab" data-bs-target="#kelas{{ $post->id }}" type="button" role="tab" aria-controls="home" aria-selected="true">Kelas {{ $loop->iteration }}</button>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach ($rkm as $post)
                                <div class="tab-pane fade" id="kelas{{ $post->id }}" role="tabpanel" aria-labelledby="kelas-tab-{{ $post->id }}">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-8"><p><h5>Kelas {{ $loop->iteration }}</h5></p></div>
                                        @if ( auth()->user()->jabatan == 'Education Manager')
                                        <div class="col-md-4 col-sm-4 col-xs-4"><a class="btn click-primary mx-1" href="{{ route('editInstruktur', $post->id) }}">Tambah/Edit Instruktur RKM </a></div>
                                        @else
                                        <div class="col-md-4 col-sm-4 col-xs-4"><a class="btn click-primary mx-1" href="{{ route('rkm.edit', $post->id) }}">Edit RKM</a></div>
                                        @endif
                                        {{-- <h5>ID Kelas {{ $post->id }}</h5> --}}
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>ID Kelas</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->id }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Materi</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->materi->nama_materi }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Tanggal Awal</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ \Carbon\Carbon::parse($post->tanggal_awal)->translatedFormat('l, d F Y') }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Tanggal Akhir</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ \Carbon\Carbon::parse($post->tanggal_akhir)->translatedFormat('l, d F Y') }}</p></div>
                                        @php
                                            $awal = explode("-",$post->tanggal_awal);
                                            $akhir = explode("-",$post->tanggal_akhir);
                                            $sama = $akhir[2] - $awal[2];
                                            $hari = $sama + 1;
                                        @endphp
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Total Hari</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $hari }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Perusahaan</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->perusahaan->nama_perusahaan }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Nama Sales</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->sales->nama_lengkap }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Instruktur 1</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->instruktur_key }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Instruktur 2</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->instruktur_key2}}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Asisten</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->asisten_key }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Metode Kelas</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->metode_kelas }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Ruang</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p> {{ $post->ruang }}</p></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><p>Pax</p></div>
                                        <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                        <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->pax }}</p></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-7">
                            @php
                            $startsAt = \Carbon\Carbon::parse(request('starts_at', $id->tanggal_awal))->startOfDay();
                            $endsAt = \Carbon\Carbon::parse(request('ends_at', $id->tanggal_akhir))->startOfDay();
                            $hariAwal = $startsAt->isoFormat('dddd');
                            $hariAkhir = $endsAt->isoFormat('dddd');
                            $range = [];
                            for ($date = $startsAt->copy(); $date->lte($endsAt); $date->addDay()) {
                                $range[] = $date->copy();
                            }
                            $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                            // dd($range);
                            // echo $range;
                            @endphp

                            <table class="table text-center" id="tabel">
                                <thead>
                                    <tr>
                                        @foreach($daysOfWeek as $day)
                                                <th>{{ $day }}</th>
                                        @endforeach
                                        <th style="background-color: rgba(255, 0, 0, 0.5);">Sabtu</th>
                                        <th style="background-color: rgba(255, 0, 0, 0.5);">Minggu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if ($hariAwal == 'Selasa' && $hariAkhir == 'Rabu')
                                        <th></th>
                                        @foreach($range as $date)
                                            <th>v</th>
                                        @endforeach
                                        <th></th>
                                        <th></th>
                                        @elseif ($hariAwal == 'Rabu')
                                        <th></th>
                                        <th></th>
                                        @foreach($range as $date)
                                            <th>v</th>
                                        @endforeach
                                        <th></th>
                                        <th></th>
                                        @elseif ($hariAwal == 'Kamis')
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        @foreach($range as $date)
                                            <th>v</th>
                                        @endforeach
                                        <th></th>
                                        <th></th>
                                        @elseif ($hariAwal == 'Jumat')
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        @foreach($range as $date)
                                            <th>v</th>
                                        @endforeach
                                        <th></th>
                                        <th></th>
                                        @else
                                        @foreach($range as $date)
                                            <th>v</th>
                                        @endforeach
                                        <th></th>
                                        <th></th>
                                        @endif

                                    </tr>
                                    {{-- <tr>
                                        @foreach($range as $date)
                                            <th>v</th>
                                        @endforeach
                                    </tr> --}}
                                </tbody>
                            </table>



                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <form method="POST" action="{{ route('comment.store') }}">
                                                        @csrf
                                                        <input type="text" hidden name="rkm_key" value="{{ $posts }}">
                                                        <input type="text" hidden name="karyawan_key" value="{{ auth()->user()->karyawan_id }}">
                                                        <input type="text" hidden name="materi_key" value="{{ $materi_key }}">
                                                        <textarea class="form-control" name="content" placeholder="Tulis komentar Anda..."></textarea>
                                                        <button class="btn click-primary" type="submit">Kirim</button>
                                                    </form>
                                                </div>
                                                <div class="row my-2">
                                                <h3>Komentar</h3>
                                                    @foreach($comments as $comment)
                                                    <p>{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d F Y \J\a\m H:i:s') }} | {{ $comment->karyawan->nama_lengkap }} : {{ $comment->content }}</p>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @media screen and (max-width: 768px) {
        .card {
            padding: 15px;
            max-width: 100%;
        }

        .card-body  .row {
            margin-bottom: 10px;
        }

        /* .col-xs-4, */
        .col-xs-1 {
            display: none;
        }

        .col-xs-7 {
            width: 100%;
            text-align: left;
        }
    }

        .cardname {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .click-secondary-icon {
            background:    #355C7C;
            border-radius: 1000px;
            width:         45px;
            height:        45px;
            color:         #ffffff;
            display:       flex;
            justify-content: center;
            align-items:   center;
            text-align:    center;
            text-decoration: none;
        }
        .click-secondary-icon i {
            line-height: 45px;
        }

        .click-secondary {
            background:    #355C7C;
            border-radius: 1000px;
            padding:       10px 25px;
            color:         #ffffff;
            display:       inline-block;
            font:          normal bold 18px/1 "Open Sans", sans-serif;
            text-align:    center;
            transition:    color 0.1s linear, background-color 0.2s linear;
        }

        .click-secondary:hover {
            color:         #A5C7EF;
            transition:    color 0.1s linear, background-color 0.2s linear;
        }
        .click-warning {
            background:    #f8be00;
            border-radius: 1000px;
            padding:       10px 20px;
            color:         #000000;
            display:       inline-block;
            font:          normal bold 18px/1 "Open Sans", sans-serif;
            text-align:    center;
            transition:    color 0.1s linear, background-color 0.2s linear; /
        }

        .click-warning:hover {
            background:         #A5C7EF;
            transition:    color 0.1s linear, background-color 0.2s linear;
        }
        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: auto;
            height: auto;
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.45);
            box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(2px);
            }
            .checkmark {
        display: block;
        width: 25px;
        height: 25px;
        border: 1px solid #ccc;
        border-radius: 50%;
        position: relative;
        margin: 0 auto;
    }

    .checkmark:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #22bb33;
        display: none;
    }

    tr.selected .checkmark:after {
        display: block;
    }

</style>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var tableBody = document.getElementById('table-body');
        var startDate = new Date('{{ $post->tanggal_awal }}');
        var endDate = new Date('{{ $post->tanggal_akhir }}');
        var days = (endDate.getTime() - startDate.getTime()) / (1000 * 3600 * 24);

        for (var i = 0; i <= days; i++) {
            var row = document.createElement('tr');

            var cell = document.createElement('td');
            var checkbox = document.createElement('input');
            checkbox.setAttribute('type', 'checkbox');
            checkbox.setAttribute('name', 'day[]');
            checkbox.setAttribute('value', i + 1);
            cell.appendChild(checkbox);
            row.appendChild(cell);

            tableBody.appendChild(row);
        }
    });
</script> --}}




@endsection
