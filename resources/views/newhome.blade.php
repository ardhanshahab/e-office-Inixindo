@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: ">
    <div class="row justify-content-between">
        <div class="container d-flex justify-content-around my-4">
            <!-- Modal Pemberitahuan -->
            <div class="modal fade" id="modalPemberitahuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-md-12 d-flex justify-content-between">
                                <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
                                @if (auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'Accounting')
                                    <a href="{{ route('notif.create') }}" class="btn btn-sm btn-custom mx-4"><img src="{{ asset('icon/plus.svg') }}" class="" width="20px"></a>
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="modal-body">
                            {{-- {{ $notifikasi }} --}}
                            @foreach ($notifikasi->sortByDesc('created_at') as $notif)
                            <div class="card-body" id="notif">
                                <table>
                                    <tr>
                                      <td style="width:80%"><div class="card-title" style="text-transform: capitalize">Pengumuman <strong>{{ $notif->tipe_notifikasi }}</strong> Dari {{ $notif->id_user }} <b>{{ $notif->users->jabatan }}</b>
                                        <p> {{ $notif->isi_notifikasi }} </p>
                                        <p class="m-0">{{ \Carbon\Carbon::parse($notif->created_at)->translatedFormat('d F Y \J\a\m H:i:s') }}</p></div></td>
                                      <td style="width:20%">
                                        {{-- <a href="#" class="btn btn-primary">View</a> --}}
                                        <a href="#" class="btn btn-danger" id="dismiss-notification">Tutup</a>
                                      </td>
                                    </tr>
                                </table>
                            </div>
                            <hr class="m-0" id="hr">
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @if (auth()->user()->jabatan == 'Instruktur' || auth()->user()->jabatan == 'Education Manager')
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Kelas anda minggu ini</h5>
                <h4 class="text-center">{{ $kelasmingguini }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Running Class</h5>
                <h4 class="text-center">{{ $runningclass }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Jumlah Mengajar</h5>
                <h4 class="text-center">{{ $jumlahmengajar }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Jumlah Peserta anda</h5>
                <h4 class="text-center">{{ $pesertaanda }}</h4>
            </div>
        @endif
        @if (auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'Accounting')
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Total Karyawan</h5>
                <h4 class="text-center">{{ $totalkaryawan }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Karyawan Aktif</h5>
                <h4 class="text-center">{{ $karyawanaktif }}</h4>
            </div>
            <div class="mx-1" id="hero1">
                <h5 class="card-title text-center">Peserta Aktif</h5>
                <h4 class="text-center">{{ $pesertaaktif }}</h4>
            </div>
        @endif
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-6">
            <div class="row">
                {{-- karyawan --}}
                <div class="col-md-12 my-1">
                    {{-- content --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <h5 class="text-center card-title">Karyawan</h5>
                                <div class="col-sm-6 my-1">
                                    <div class="card" id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/credit-card.svg') }}" class="img-responsive" width="30px">
                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                {{-- <h5 class="card-title">Profil Saya</h5> --}}
                                                <a href="/profile/{{ auth()->user()->id }}" class="link stretched-link text-decoration-none"><h5 class="card-title">Profil Saya</h5></a>
                                                <p class="card-text">Profil saya sebagai karyawan INIXINDO Bandung.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 my-1">
                                    <div class="card"  id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/users.svg') }}" class="img-responsive" width="30px">

                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                <a href="/user" class="link stretched-link text-decoration-none"><h5 class="card-title">Data Karyawan</h5></a>
                                                <p class="card-text">Data lengkap semua karyawan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (auth()->user()->jabatan == 'HRD' || auth()->user()->jabatan == 'Accounting' || auth()->user()->jabatan == 'Direktur' || auth()->user()->jabatan == 'Direktur Utama')
                                <div class="col-sm-6 my-1">
                                    <div class="card"  id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/users.svg') }}" class="img-responsive" width="30px">
                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                <a href="/jabatan" class="link stretched-link text-decoration-none"><h5 class="card-title">Jabatan</h5></a>
                                                <p class="card-text">Data Jabatan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-6 my-1">
                                    <div class="card"  id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/users.svg') }}" class="img-responsive" width="30px">
                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                <a href="#" class="link stretched-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalPemberitahuan">
                                                    <h5 class="card-title">Notifikasi</h5>
                                                </a>
                                                <p class="card-text">Pemberitahuan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end karyawan --}}
                {{-- peserta --}}
                <div class="col-md-12 my-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <h5 class="text-center">Peserta</h5>
                                <div class="col-sm-6">
                                    <div class="card" id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/table.svg') }}" class="img-responsive" width="30px">
                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                <a href="/peserta" class="link stretched-link text-decoration-none"><h5 class="card-title">Data Peserta</h5></a>
                                                <p class="card-text">Data Peserta yang mengikuti kelas.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="card" id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/user-check.svg') }}" class="img-responsive" width="30px">
                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px" id="">
                                                <a href="/registrasi" class="link stretched-link text-decoration-none"><h5 class="card-title">Registrasi</h5></a>
                                                <p class="card-text">Registrasi peserta kelas.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 mt-2">
                                    <div class="card" id="card-hover">
                                        <div class="card-body d-flex">
                                            <div class="col-md-2">
                                                <img src="{{ asset('icon/briefcase.svg') }}" class="img-responsive" width="30px">

                                            </div>
                                            <div class="col-md-10" style="margin-left: 10px">
                                                <a href="/perusahaan" class="link stretched-link text-decoration-none"><h5 class="card-title">Perusahaan</h5></a>
                                                <p class="card-text">Data Perusahaan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                {{-- end peserta --}}

            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                {{-- RKM --}}
                    <div class="col-md-12 my-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <h5 class="text-center">Rencana Kelas Mingguan</h5>
                                    <div class="col-sm-6">
                                        <div class="card" id="card-hover">
                                            <div class="card-body d-flex">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('icon/calendar.svg') }}" class="img-responsive" width="30px">
                                                </div>
                                                <div class="col-md-10" style="margin-left: 10px">
                                                    <a href="/rkm" class="link stretched-link text-decoration-none"><h5 class="card-title">Rencana Kelas Mingguan</h5></a>
                                                    <p class="card-text">Rencana kelas untuk minggu ini.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card" id="card-hover">
                                            <div class="card-body d-flex">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('icon/book-open.svg') }}" class="img-responsive" width="30px">

                                                </div>
                                                <div class="col-md-10" style="margin-left: 10px">
                                                    <a href="/materi" class="link stretched-link text-decoration-none"><h5 class="card-title">Materi</h5></a>
                                                    <p class="card-text">Data Materi.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mt-2">
                                        <div class="card" id="card-hover">
                                            <div class="card-body d-flex">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('icon/file-text.svg') }}" class="img-responsive" width="30px">

                                                </div>
                                                <div class="col-md-10" style="margin-left: 10px">
                                                    <a href="/feedback" class="link stretched-link text-decoration-none"><h5 class="card-title">Feedback</h5></a>
                                                    <p class="card-text">Feedback Pelayanan.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- end RKM --}}
            </div>
        </div>
    </div>
</div>
<style>
    @media screen and (max-width: 768px) {
        a {
            width: auto;
            max-width: 100%;
        }

    }
    #notif{
        padding: 0.5rem;
        table{
            width: 100%;
            tr{
            display:flex;
            td{
                a.btn{
                font-size: 0.8rem;
                padding: 3px;
                }
            }
            td:nth-child(2){
                text-align:right;
                justify-content: space-around;
            }
            }
        }

        }
    .btn-custom {
        background-color: #182F51;
        color: white;
    }
    .btn-custom:hover {
        background-color: #355C7C;
        color: white;
    }


</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$('#modalPemberitahuan').on('click', '.btn-danger', function(e) {
  e.preventDefault();
  $(this).closest('.card-body').hide();

  // Periksa apakah masih ada notifikasi yang tersisa
  if ($('#modalPemberitahuan .card-body:visible').length === 0) {
    $('hr').hide();
    $('#modalPemberitahuan .modal-body').append('<p>Tidak ada notifikasi</p>');
  }
});


</script>
@endsection
