@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sell Property</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {!! session('status') !!}
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-8">
                            {!! $map['html'] !!}
                        </div>
                        <div class="col-md-4">
                            <form class="sell-form">
                                @csrf
                                <div class="form-group">
                                    <label for="latitude">Location (Lat, Long)</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control col-md-12" id="latitude" name="latitude" disabled>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control col-md-12" id="longitude" name="longitude" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" placeholder="Price" min="0" name="price" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
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
            $('#latitude').val(event.latLng.lat());
            $('#longitude').val(event.latLng.lng());
        }

        $(document).ready(function (){
            $(".sell-form").submit(function(event){
                event.preventDefault(); 
                // Find disabled inputs, and remove the "disabled" attribute
                var disabled = $(this).find(':input:disabled').removeAttr('disabled');

                // serialize the form
                var serialized = $(this).serialize();

                // re-disabled the set of inputs that you previously enabled
                disabled.attr('disabled','disabled');

                $.ajax({
                    type: "POST",
                    url: "{{route('sellprop')}}",
                    data: serialized,
                    dataType: "json",
                    success: function(data) {
                        if(data) {
                            $(".sell-form")[0].reset();
                            swal("Successful!", "Property added to the database.", "success");
                        }
                    },
                    error: function(err) {
                        swal("Error!", "Something went wrong.", "error");
                        console.log(err);
                    }
                })
            });
        });

    </script>   

@endsection
