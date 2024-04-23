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
        </div>
    </div>
</div>
<style>

</style>
@push('js')
    <script>

    </script>
@endpush
@endsection

