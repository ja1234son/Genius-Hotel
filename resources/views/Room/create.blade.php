@extends('layouts.app')
@section('content')



    <div class="content-wrapper">
        <div class="row" style="padding-left: 300px;">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Register Rooms</h4>
                        @include('alerts.errors')
                        @include('alerts.success')
                        @include('alerts.warning')
                        <form action="{{url('rooms')}}" method="post" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Room Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="name" placeholder="Enter room name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">RoomTypes</label><span class="text-danger">*</span>
                                <select class="form-control" name="room_type_id" aria-label="Text input with dropdown button">
                                    <option value="0">-- Select roomtype --</option>
                                    @foreach($roomtyp as $rt)
                                        <option value="{{$rt->id}}">{{$rt->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info btn-sm">Submit</button>
                            <a class="btn btn-primary btn-sm" href="{{url('rooms')}}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>











@endsection
