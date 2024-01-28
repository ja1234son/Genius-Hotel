@extends('layouts.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-2 font-weight-bold  text-primary">{{$staff->full_name}} Details</h5>
            <a href="{{url('staffs')}}" type="submit" class="float-right btn btn-success btn-sm">View all</a>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Photo</th>
                        <th>Salary Type</th>
                        <th>Salary Amount</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Photo</th>
                        <th>Salary Type</th>
                        <th>Salary Amount</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>{{$staff->id}}</td>
                            <td>{{$staff->full_name}}</td>
                            <td>{{$staff->department->title}}</td>
                            <td>
                                <img class="im" width="50px" height="50px" src="{{ asset('assets/StaffImages') }}/{{ $staff->photo }}" alt="">
                            </td>
                            <td>{{$staff->salary_type}}</td>
                            <td>{{$staff->salary_amount}}</td>
                        </tr>



                </table>
            </div>
        </div>
    </div>

@endsection
