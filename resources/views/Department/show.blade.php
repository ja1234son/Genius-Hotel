@extends('layouts.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-2 font-weight-bold  text-primary">{{$departs->title}} Department</h5>
            <a href="{{url('departments')}}" type="submit" class="float-right btn btn-success btn-sm">View all</a>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>{{$departs->id}}</td>
                            <td>{{$departs->title}}</td>
                        </tr>



                </table>
            </div>
        </div>
    </div>

@endsection
