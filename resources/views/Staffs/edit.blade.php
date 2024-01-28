@extends('layouts.app')
@section('content')



    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit {{ $staff->full_name }} Details</h4>
                        @include('alerts.errors')
                        @include('alerts.success')
                        @include('alerts.warning')
                           <form action="{{url('staffs/'.$staff->id)}}" enctype="multipart/form-data"  method="post" class="forms-sample">
                           @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Full Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" value="{{ $staff->full_name }}" name="full_name" placeholder="Enter staff name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Department</label><span class="text-danger">*</span>
                                <select class="form-control" name="department_id" aria-label="Text input with dropdown button">
                                    <option value="0">-- Select department --</option>
                                    @foreach($depart as $dp)
                                        <option  @if($staff->id==$dp->id) selected @endif value="{{$dp->id}}">{{$dp->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Image</label><span class="text-danger">*</span>
                                <input type="file" class="form-control"  name="photo">
                                <input type="hidden" value="{{ $staff->photo }}" class="form-control"  name="old_photo">
                                <img class="" width="50px" height="50px" src="{{ asset('assets/StaffImages') }}/{{ $staff->photo }}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Salary type</label><span class="text-danger">*</span>
                                <input type="radio" class="form-control" @if($staff->salary_type=='daily') checked
                                @endif value="daily" name="salary_type">Daily
                                <input type="radio" class="form-control"  @if($staff->salary_type=='monthly') checked
                                @endif  value="monthly " name="salary_type">Monthly

                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Salary amount</label><span class="text-danger">*</span>
                                <input type="number" class="form-control"  value="{{ $staff->salary_amount }}" name="salary_amount" placeholder="Enter salary amount">
                            </div>
                            <button type="submit" class="btn btn-info btn-sm">Submit</button>
                            <a class="btn btn-primary btn-sm" href="{{url('staffs')}}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>











@endsection
