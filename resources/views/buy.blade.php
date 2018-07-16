@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Buy Property</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {!! session('status') !!}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            {!! $map['html'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js') 
    
    {!! $map['js'] !!}

    <script>

        function getLatLong(event) {
            console.log(event.latLng.lat());
        }

    </script>   

@endsection
