@extends('layouts.app')
@section('content')



    <div class="content-wrapper">
        <div class="row" style="padding-left: 300px;">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Register RoomTypes</h4>
                        @include('alerts.errors')
                        @include('alerts.success')
                        @include('alerts.warning')
                        <form action="{{url('roomtypes')}}" enctype="multipart/form-data" method="post" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">RoomType Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="name" placeholder="Enter roomtype name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">RoomType Price</label><span class="text-danger">*</span>
                                <input type="number" class="form-control" name="price" placeholder="Enter roomtype price">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">RoomType Details</label><span class="text-danger">*</span>--}}
{{--                                <input type="text" class="form-control" name="detail" placeholder="Write roomtype details">--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="exampleInputUsername1">RoomType Gallery</label><span class="text-danger">*</span>
                                <input type="file" class="form-control" multiple name="images[]">
                            </div>
                            <button type="submit" class="btn btn-info btn-sm">Submit</button>
                            <a class="btn btn-primary btn-sm" href="{{url('roomtypes')}}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>











@endsection
