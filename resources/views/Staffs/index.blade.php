@extends('layouts.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-2 font-weight-bold  text-primary">Staffs</h5>
            <a href="{{url('staffs/create')}}" type="submit" class="float-right btn btn-success btn-sm">New</a>
        </div>
        @include('alerts.errors')
        @include('alerts.success')
        @include('alerts.warning')
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
                        <th>Action</th>

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
                        <th>Action</th>

                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($staffs as $staff)
                        <tr>
                            <td>{{$staff->id}}</td>
                            <td>{{$staff->full_name}}</td>
                            <td>{{$staff->department->title}}</td>
                            <td>
                                <img class="im" width="50px" height="50px" src="{{ asset('assets/StaffImages') }}/{{ $staff->photo }}" alt="">
                            </td>
                            <td>{{$staff->salary_type}}</td>
                            <td>{{$staff->salary_amount}}</td>
                            <td>
                                <a href="{{url('staffs/' .$staff->id)}}" class="btn btn-info btn-sm"><i class="typcn typcn-eye"></i></a>
                                <a href="{{url('staffs/'.$staff->id).'/edit'}}" class="btn btn-warning btn-sm "><i class="typcn typcn-edit"></i></a>
                                <a onclick="return confirm('Are You Sure??')"
                                   href=""
                                   class="btn btn-danger btn-sm">
                                    <i class="typcn typcn-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
