@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                {{-- @if ( auth()->user()->jabatan == 'HRD' )
                    <a href="{{ route('feedback.create') }}" class="btn btn-md click-primary mx-4" data-toggle="tooltip" data-placement="top" title="Tambah Perusahaan"><img src="{{ asset('icon/plus.svg') }}" class="" width="30px"> Buat Pertanyaan</a>
                @endif --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mt-3 text-center">&nbsp;Data Feedback</h4>
                    <table id="datafeedback" class="display" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th scope="col">No</th> --}}
                                <th scope="col">RKM</th>
                                <th scope="col">Peserta</th>
                                {{-- <th scope="col">Email</th> --}}
                                <th>Materi</th>
                                <th>Pelayanan</th>
                                <th>Fasilitas</th>
                                <th>Instuktur</th>
                                <th>Instruktur 2</th>
                                <th>Asisten</th>
                                {{-- <th>Umum</th> --}}
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<style>

</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function(){
            $('#datafeedback').DataTable({
                "processing": true,
                "ajax": {
                    "url": "{{ route('getFeedbacks') }}", // URL API untuk mengambil data
                    "type": "GET",
                },
                "columns": [
                    {"data": "rkm.nama_materi"},
                    {"data": "regist.nama"},
                    // {"data": "email"},
                    {"data": "materi"},
                    {"data": "pelayanan"},
                    {"data": "fasilitas"},
                    {"data": "instruktur"},
                    {"data": "instruktur2"},
                    {"data": "asisten"},
                ],
                // "columnDefs": [
                //     { "width": "10%", "targets": [4, 5, 6, 7, 8, 9] } // Mengatur lebar kolom Materi, Pelayanan, Fasilitas, Instruktur, Instruktur 2, Asisten
                // ]
            });
        });
    </script>
@endsection

