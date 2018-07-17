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
                    </br>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $map['html'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div class="container">
        <div class="row">
            @if($props)
                @foreach($props as $prop)
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top" src="https://www.siasat.com/wp-content/uploads/2017/11/real-estate.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$prop->address}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">for sale</h6>
                                <p class="card-text"><strong>Price: </strong>{{number_format($prop->price,2,".",",")}}</p>
                                <a href="{{route('buy')}}?id={{$prop->id}}" class="card-link">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@section('js') 
    
    {!! $map['js'] !!}

@endsection
