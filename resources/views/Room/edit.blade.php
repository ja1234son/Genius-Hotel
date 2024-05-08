@extends('layouts.app')
@section('content')

{{--

    <div class="content-wrapper">
        <div class="row" style="padding-left: 300px;">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Rooms</h4>
                        @include('alerts.errors')
                        @include('alerts.success')
                        @include('alerts.warning')
                        <form action="{{url('rooms/'.$data->id)}}" method="post" class="forms-sample">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="exampleInputUsername1">Room Name</label><span class="text-danger">*</span>
                                <input type="text" value="{{$data->name}}" class="form-control" name="name" placeholder="Enter room name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">RoomTypes</label><span class="text-danger">*</span>
                                <select class="form-control" name="room_type_id" aria-label="Text input with dropdown button">
                                    <option value="0">-- Select roomtype --</option>
                                    @foreach($roomtype as $rt)
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
    </div> --}}




    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10" style="padding-left: 20px;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit <strong style="color: orange;">{{ $data->name }}</strong> </h4>
                        @include('alerts.errors')
                        @include('alerts.success')
                        @include('alerts.warning')
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{url('rooms/'.$data->id)}}"  method="post"  novalidate >
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-6 col-form-label" for="validationCustom01">Room Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" value="{{$data->name}}"  class="form-control" id="validationCustom01"   name="name" placeholder="Enter room name"
                                                     required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-6 col-form-label" for="validationCustom05">RoomTypes
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select name="room_type_id" class="default-select wide form-control" id="validationCustom05">
                                                        {{-- <option value="0"  data-display="Select">--Please select roomtype--</option> --}}
                                                       @foreach($roomtype as $rt)
                                                        <option @if($data->id == $rt->id) selected @endif value="{{$rt->id}}">{{$rt->name}}</option>
                                                       @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-lg-9 ms-auto  d-flex justify-content-center mb-1">
                                                    <a href="{{ url('rooms') }}" type="button"
                                                    class="btn btn-danger font-weight-bold btn-sm">Back</button>
                                                </a>
                                                    <button type="submit" name="save_close" value="1"
                                                    class="btn btn-secondary font-weight-bold btn-sm submitButton">Save
                                                    &
                                                    Close</button>
                                                <button type="submit" name="save"
                                                    class="btn btn-primary font-weight-bold btn-sm submitButton">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
y







@endsection
