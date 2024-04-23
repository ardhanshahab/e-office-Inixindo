@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="btn click-primary my-2"><img src="{{ asset('icon/arrow-left.svg') }}" class="img-responsive" width="20px"> Back</a>
                        <div class="row">
                            <div class="col-md-5">
                                <h5 class="card-title">Detail Perusahaan</h5>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>ID Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->id }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Nama Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->nama_perusahaan }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Kategori Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->kategori_perusahaan }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Lokasi Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->lokasi }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Nama Sales</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->karyawan->nama_lengkap }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Status</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->status }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>NPWP Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->npwp }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Alamat Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->alamat }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>CP Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->cp }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Nomor Telepon Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <p>{{ $post->no_telp }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <p>Foto NPWP Perusahaan</p>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <p>:</p>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        @if (!$post->foto_npwp)
                                        <p>Tidak Ada</p>
                                        @else
                                        <a href="#" class="btn click-primary">Lihat Foto</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">List Peserta</h5>
                                        <table class="table table-striped">
                                            <thead>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Peserta</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">List Materi</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($peserta as $pesertas )
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $pesertas->nama }}</td>
                                                    <td>{{ $pesertas->email }}</td>
                                                    <td><a href="#" class="btn click-primary my-2 list-materi-btn" data-id="{{ $pesertas->id }}">List Materi</a></td>
                                                    {{-- <td><a href="#" class="btn click-primary my-2">List Materi</a></td> --}}
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <p>List Materi</p>
                                        <ul id="list-materi">

                                        </ul>

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

            .card-body .row {
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
            background: #355C7C;
            border-radius: 1000px;
            width: 45px;
            height: 45px;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            text-decoration: none;
        }

        .click-secondary-icon i {
            line-height: 45px;
        }

        .click-secondary {
            background: #355C7C;
            border-radius: 1000px;
            padding: 10px 25px;
            color: #ffffff;
            display: inline-block;
            font: normal bold 18px/1 "Open Sans", sans-serif;
            text-align: center;
            transition: color 0.1s linear, background-color 0.2s linear;
        }

        .click-secondary:hover {
            color: #A5C7EF;
            transition: color 0.1s linear, background-color 0.2s linear;
        }

        .click-warning {
            background: #f8be00;
            border-radius: 1000px;
            padding: 10px 20px;
            color: #000000;
            display: inline-block;
            font: normal bold 18px/1 "Open Sans", sans-serif;
            text-align: center;
            transition: color 0.1s linear, background-color 0.2s linear;/
        }

        .click-warning:hover {
            background: #A5C7EF;
            transition: color 0.1s linear, background-color 0.2s linear;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         $(document).ready(function () {
    $(".list-materi-btn").click(function () {
        var idPeserta = $(this).data("id");
        $.ajax({
            url: "/api/registrasi/list/" + idPeserta, // Ubah URL menjadi "/api/registrasi/list/{id_peserta}"
            type: "GET",
            success: function (data) {
                $("#list-materi").empty();
                $.each(data.list, function (index, materi) {
                    console.log(materi);
                    $("#list-materi").append("<li>" + materi + "</li>");
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                // Handle error here
            }
        });
    });
});

    </script>
@endsection
