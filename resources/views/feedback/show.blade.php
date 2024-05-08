
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="/feedback" class="btn click-primary my-2"><img src="{{ asset('icon/arrow-left.svg') }}" class="img-responsive" width="20px"> Back</a>
                    <h5 class="card-title">Detail Feedbacks</h5>
                    {{-- {{ $post }} --}}
                        @foreach($post as $group)
                        <div class="row">
                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Nama Materi</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $group['data'][0]['nama_materi'] }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Tanggal Pelaksanaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ \Carbon\Carbon::parse($group['data'][0]['tanggal_awal'])->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($group['data'][0]['tanggal_akhir'])->translatedFormat('d F Y') }}</p>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Instruktur</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $group['data'][0]['instruktur_key'] }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Instruktur 2</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $group['data'][0]['instruktur_key2'] }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Asisten</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $group['data'][0]['asisten_key'] }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $group['nama_perusahaan'] }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Sales</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $group['data'][0]['sales_key'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-striped table-auto table-responsive">
                                            <thead>
                                                <th>Peserta</th>
                                                <th>Materi</th>
                                                <th>Pelayanan</th>
                                                <th>Fasilitas</th>
                                                <th>Instruktur</th>
                                                <th>Instruktur2</th>
                                                <th>Asisten</th>
                                                <th>Umum 1</th>
                                                <th>Umum 2</th>
                                            </thead>
                                            <tbody>
                                                @foreach($group['data'] as $feedback)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $feedback['materi'] }}</td>
                                                            <td>{{ $feedback['pelayanan'] }}</td>
                                                            <td>{{ $feedback['fasilitas'] }}</td>
                                                            <td>{{ $feedback['instruktur'] }}</td>
                                                            <td>{{ $feedback['instruktur2'] }}</td>
                                                            <td>{{ $feedback['asisten'] }}</td>
                                                            <td>{{ $feedback['umum1'] }}</td>
                                                            <td>{{ $feedback['umum2'] }}</td>
                                                        </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
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

    .table-auto {
        table-layout: auto;
        /* width: auto; */
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
