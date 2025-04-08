@extends('layouts.app')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10" style="padding-left: 20px;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Register Rooms</h4>
                        @include('alerts.errors')
                        @include('alerts.success')
                        @include('alerts.warning')
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{url('rooms')}}"  method="post"  novalidate >
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-6 col-form-label" for="validationCustom01">Room Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="validationCustom01"   name="name" placeholder="Enter room name"
                                                     required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-6 col-form-label" for="validationCustom05">RoomTypes
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select name="room_type_id" class="default-select wide form-control" id="validationCustom05">
                                                        <option value="0"  data-display="Select">--Please select roomtype--</option>
                                                       @foreach($roomtyp as $rt)
                                                        <option value="{{$rt->id}}">{{$rt->name}}</option>
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






@endsection
