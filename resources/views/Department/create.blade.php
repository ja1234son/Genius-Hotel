@extends('layouts.app')
@section('content')



    <div class="content-wrapper">
        <div class="row" style="padding-left: 300px;">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Register Department</h4>
                        @include('alerts.errors')
                        @include('alerts.success')
                        @include('alerts.warning')
                        <form action="{{url('departments')}}"  method="post" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Department Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="title" placeholder="Enter department name">
                            </div>
                            <button type="submit" class="btn btn-info btn-sm">Submit</button>
                            <a class="btn btn-primary btn-sm" href="{{url('departments')}}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>











@endsection
