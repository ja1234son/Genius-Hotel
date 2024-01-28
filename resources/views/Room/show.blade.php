@extends('layouts.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-2 font-weight-bold  text-primary">Rooms</h5>
            <a href="{{url('rooms')}}" type="submit" class="float-right btn btn-success btn-sm">View all</a>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Roomtype</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Roomtype</th>

                    </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->roomtype->name}}</td>
                        </tr>



                </table>
            </div>
        </div>
    </div>

@endsection
