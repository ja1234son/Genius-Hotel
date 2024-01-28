@extends('layouts.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-2 font-weight-bold  text-primary">Rooms</h5>
            <a href="{{url('rooms/create')}}" type="submit" class="float-right btn btn-success btn-sm">New</a>
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
                        <th>Roomtype</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Roomtype</th>
                        <th>Action</th>

                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($room as $rm)
                        <tr>
                            <td>{{$rm->id}}</td>
                            <td>{{$rm->name}}</td>
                            <td>{{$rm->roomtype->name}}</td>
                            <td>
                                <a href="{{url('rooms/'.$rm->id)}}" class="btn btn-info btn-sm"><i class="typcn typcn-eye"></i></a>
                                <a href="{{url('rooms/'.$rm->id).'/edit'}}" class="btn btn-warning btn-sm "><i class="typcn typcn-edit"></i></a>
                                <a onclick="return confirm('Are You Sure??')" href="{{url('rooms/'.$rm->id).'/delete'}}" class="btn btn-danger btn-sm">
                                    <i class="typcn typcn-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach


                </table>
            </div>
        </div>
    </div>

@endsection
