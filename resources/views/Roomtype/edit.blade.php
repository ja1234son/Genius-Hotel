@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-10" style="padding-left: 20px;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit <strong style="color: orange;"> {{$data->name}}</strong></h4>
                        @include('alerts.errors')
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{url('roomtypes/'.$data->id)}}" enctype="multipart/form-data" method="post"  novalidate >
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-6 col-form-label" for="validationCustom01">RoomType Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="validationCustom01"
                                                      name="name"  value="{{$data->name}}"  placeholder="Enter roomtype name"
                                                     required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-6 col-form-label" for="validationCustom02">RoomType Price <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="number" class="form-control" id="validationCustom02"
                                                    name="price"  value="{{$data->price}}" placeholder="Enter roomtype price"
                                                    required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-6 col-form-label" for="validationCustom03">RoomType Gallery
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="file" class="form-control" id="validationCustom03" multiple name="images" required>
                                                    <input type="hidden" class="form-control" value="{{ $data->profile }}" id="validationCustom03"
                                                     multiple name="old_images" required>
                                                     <br>
                                                     <img width="50" height="50" src="{{ asset('assets/RoomImages') }}/{{ $data->profile }}" alt="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-lg-9 ms-auto  d-flex justify-content-center mb-1">
                                                    <a href="{{ url('roomtypes') }}" type="button"
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











@endsection
