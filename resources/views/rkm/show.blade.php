
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
                            <div class="row">
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
                                <div class="col-md-4 col-sm-4 col-xs-4"><p>Nama Instruktur</p></div>
                                <div class="col-md-1 col-sm-1 col-xs-1"><p>:</p></div>
                                <div class="col-md-7 col-sm-7 col-xs-7"><p>{{ $post->instruktur->nama_lengkap }}</p></div>
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
                        <div class="col-md-7">
                            <table class="table table-striped text-center" id="tabel">
                                <thead>
                                    <tr>
                                        <th scope="col">Senin</th>
                                        <th scope="col">Selasa</th>
                                        <th scope="col">Rabu</th>
                                        <th scope="col">Kamis</th>
                                        <th scope="col">Jumat</th>
                                        <th scope="col" style="background: red">Sabtu</th>
                                        <th scope="col" style="background: red">Minggu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php
                                            $startDate = new DateTime($post->tanggal_awal);
                                            $endDate = new DateTime($post->tanggal_akhir);
                                            $diff = $endDate->diff($startDate)->days;
                                            $currentDate = clone $startDate;
                                        @endphp

                                        @for($i = 0; $i <= $diff; $i++)
                                            @if($currentDate->format('N') >= 6) {{-- Sabtu dan Minggu --}}
                                                <td style="background-color: red;">v</td>
                                            @else
                                                <td>v</td>
                                            @endif
                                            @php
                                                $currentDate->modify('+1 day');
                                            @endphp
                                        @endfor
                                    </tr>
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
                                                        <input type="text" hidden name="rkm_key" value="{{ $post->id }}">
                                                        <input type="text" hidden name="karyawan_key" value="{{ auth()->user()->karyawan_id }}">
                                                        <textarea class="form-control" name="content" placeholder="Tulis komentar Anda..."></textarea>
                                                        <button class="btn click-primary" type="submit">Kirim</button>
                                                    </form>
                                                </div>
                                                <div class="row my-2">
                                                <h3>Komentar</h3>
                                                    @foreach($comments as $comment)
                                                    <p><{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d F Y \J\a\m H:i:s') }}>{{ $comment->karyawan->nama_lengkap }} : {{ $comment->content }}</p>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                    </div>
                    {{-- <div>{{ $post }}</div> --}}
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
