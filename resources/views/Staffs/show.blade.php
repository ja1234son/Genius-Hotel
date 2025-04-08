@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> <strong style="color: orange;">{{$staff->full_name}}</strong> Details</h4>
                            @include('alerts.error')
                            @include('alerts.success')
                            @include('alerts.warning')
                            <a href="{{url('staffs')}}" type="submit" class="float-right btn btn-primary btn-sm">View all</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Photo</th>
                                            <th>Salary Type</th>
                                            <th>Salary Amount</th>
                                        </tr>
                                    </thead>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
