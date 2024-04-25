@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="card">
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
            $(document).ready(function() {
              $('#perusahaan_key').select2({
                placeholder: "Pilih Perusahaan",
                allowClear: true,
                ajax: {
                    url: '{{route('getPerusahaan')}}',
                    processResults: function({data}){
                        console.log(data)
                        return{
                            results: $.map(data, function(item){
                                return {
                                    id: item.id,
                                    text: item.nama_perusahaan
                                }
                            })
                        }
                    }
                    // dataType: 'json'
                  },

              });
            });
    </script>
@endsection
