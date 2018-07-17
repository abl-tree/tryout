@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <div class="row">
                @if($schedules)
                    @foreach($schedules as $schedule)
                        <div class="col-lg-4">
                            <div class="card">
                                <img class="card-img-top" src="https://www.siasat.com/wp-content/uploads/2017/11/real-estate.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{$schedule->property->address}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">for viewing</h6>
                                    <p class="card-text"><strong>Schedule:</strong> {{$schedule->sched_date}}</p>
                                    <p class="card-text"><strong>Seller:</strong> {{$schedule->property->seller->name}}</p>
                                    <p class="card-text"><strong>Email:</strong> {{$schedule->property->seller->email}}</p>
                                    <a href="{{route('home')}}?id={{$schedule->property->id}}" class="card-link">Locate</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>
    </div>
</div>
@endsection
