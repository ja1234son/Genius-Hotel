@extends('layouts.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-2 font-weight-bold  text-primary">{{$data->name}}</h5>
            <a href="{{url('roomtypes')}}" type="submit" class="float-right btn btn-success btn-sm">View all</a>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Room Gallery</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Room Gallery</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->price}}</td>
                            <td>
                                    <img width="50px" height="50px" src="{{ asset('assets/RoomImages') }}/{{ $data->profile }}" alt="">
                            </td>
                        </tr>



                </table>
            </div>
        </div>
    </div>

@endsection
