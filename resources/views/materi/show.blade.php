{{-- profil saya --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Atur tata letak kolom untuk layar kecil */
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
        /* body.light-theme #card {
            background-color: #fff;
            color: #000
        }

        body.dark-theme #card {
            background-color: #000;
            color: #fff;
            #
        } */
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

</style>

@endsection
