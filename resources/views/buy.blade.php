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
                        <autocomplete></autocomplete>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" placeholder="Search" name="search" required>
                            </div>
                        </div>
                    </div> -->
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

    <script type="text/javascript">

        // Create the search box and link it to the UI element.
        // var input = document.getElementById('search');
        // var searchBox = new google.maps.places.SearchBox(input);
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        function getLatLong(event) {
            console.log(event.latLng.lat());
        }

    </script>   

@endsection
