@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card m-4">
                <div class="card-body">
                <div class="card-title"><h3>Karyawan</h3></div>
                    <div class="col-md-12 d-flex">
                        <a href="/profile/{{ auth()->user()->id }}" class="btn p-2" data-toggle="tooltip" data-placement="top" title="Profile"><i class="fa fa-address-card   fa-4x" aria-hidden="true"></i></a>
                        <a href="/user" class="btn p-2" data-toggle="tooltip" data-placement="top" title="User"><i class="fa fa-users fa-4x" aria-hidden="true"></i></a>
                            <a href="#" class="btn p-2" data-toggle="tooltip" data-placement="top" title="Divisi"><i class="fa fa-briefcase fa-4x" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <div class="card m-4">
                <div class="card-body">
                    <div class="card-title"><h3>Rencana Kelas Mingguan</h3></div>
                    <div class="col-md-12 d-flex">
                        <a href="#" class="btn p-2" data-toggle="tooltip" data-placement="top" title="Rencana Kelas Mingguan"><i class="fa fa-pencil fa-4x" aria-hidden="true"></i></a>
                        <a href="#" class="btn p-2" data-toggle="tooltip" data-placement="top" title="Kalender"><i class="fa fa-calendar fa-4x" aria-hidden="true"></i></a>
                        {{-- <a href="#" class="btn" data-toggle="tooltip" data-placement="top" title="Divisi"><i class="fa fa-briefcase fa-4x" aria-hidden="true"></i></a> --}}
                    </div>
                </div>
            </div>

            <div class="card m-4">
                <div class="card-body">
                    <div class="card-title"><h3>Peserta</h3></div>
                    <div class="col-md-12 d-flex">
                        {{-- <a href="#" class="btn" data-toggle="tooltip" data-placement="top" title="Profile"><i class="fa fa-address-card   fa-4x" aria-hidden="true"></i></a>
                        <a href="#" class="btn" data-toggle="tooltip" data-placement="top" title="User"><i class="fa fa-users fa-4x" aria-hidden="true"></i></a>
                        <a href="#" class="btn" data-toggle="tooltip" data-placement="top" title="Divisi"><i class="fa fa-briefcase fa-4x" aria-hidden="true"></i></a> --}}
                    </div>
                </div>
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
        .card {
            overflow: scroll;
        }
    }
    /* .card{
        background: #A5C7EF
    } */
</style>
@endsection
