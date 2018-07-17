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
                        <div class="col-md-4">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Photo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Map</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="col-md-12">
                                        <img class="card-img-top" src="https://www.siasat.com/wp-content/uploads/2017/11/real-estate.jpg" alt="Card image cap">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="col-md-12">
                                        {!! $map['html'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @if($props)
                                @foreach($props as $prop)
                                    <div class="card-body">
                                        <h5 class="card-title">Property Information</h5>
                                        <p class="card-text"><strong>Address:</strong> {{$prop->address}}</p>
                                        <p class="card-text"><strong>Price:</strong> Php{{number_format($prop->price,2,".",",")}}</p>
                                        <h5 class="card-title">Seller Information</h5>
                                        <p class="card-text"><strong>Name:</strong> {{$prop->seller->name}}</p>
                                        <p class="card-text"><strong>Email:</strong> {{$prop->seller->email}}</p>                                        
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Schedule a showing
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content schedule-form">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" value="{{$props[0]->id}}" name="prop_id">
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="sched"/>
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js') 
    
    {!! $map['js'] !!}

    <script type="text/javascript">
        $(document).ready(function() {        
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    minDate: new Date(),
                    dateFormat: 'yyyy-mm-dd HH:mm:ss',
                });
            });

            $('.schedule-form').submit(function(e) {
                e.preventDefault();

                var serialized = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "/add/schedule",
                    data: serialized,
                    dataType: "json",
                    success: function(data) {
                        if(data) {
                            $(".schedule-form")[0].reset();
                            swal("Set!", "Schedule has been set.", "success");
                        }
                    },
                    error: function(err) {
                        swal("Error!", "Something went wrong.", "error");
                    }
                });
            });
        });

    </script>   

@endsection
