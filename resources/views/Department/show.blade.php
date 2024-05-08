@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> <strong style="color: orange;">{{$departs->title}}</strong> Department</h4>
                            @include('alerts.error')
                            @include('alerts.success')
                            @include('alerts.warning')
                            <a href="{{url('departments')}}" type="submit" class="float-right btn btn-dark btn-sm">View all</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$departs->id}}</td>
                                            <td>{{$departs->title}}</td>
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
