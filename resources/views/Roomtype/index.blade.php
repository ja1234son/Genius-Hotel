@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Room Types</h4>
                            @include('alerts.error')
                            @include('alerts.success')
                            @include('alerts.warning')
                           <a href="{{url('roomtypes/create')}}" type="submit" class="float-right btn btn-success btn-sm">New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Room Gallery</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($data as $roomtypes)
                                        <tr>
                                            <td>{{$roomtypes->id}}</td>
                                            <td>{{$roomtypes->name}}</td>
                                            <td>{{$roomtypes->price}}</td>
                                            <td><img class="rounded-circle" width="35" src="{{ asset('assets/RoomImages') }}/{{ $roomtypes->profile }}" alt=""></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{url('roomtypes/'.$roomtypes->id)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
                                                    <a href="{{url('roomtypes/'.$roomtypes->id).'/edit'}}" class="btn btn-warning shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                    <button class="btn btn-danger shadow btn-xs sharp delete-btn" data-url="{{url('roomtypes/'.$roomtypes->id).'/delete'}}"><i class="fa fa-trash"></i></button>
                                                    {{-- <a href="{{url('roomtypes/'.$roomtypes->id).'/delete'}}" class="btn btn-danger  shadow btn-xs sharp"
                                                      ><i class="fa fa-trash"></i></a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                     @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Listen for click event on delete button
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior

                    // Extract delete action URL from data-url attribute
                    let url = this.getAttribute('data-url');

                    // Display SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'Are you sure to delete?',
                        text: 'You wont be able to recover this data',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to delete action URL
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>
@endsection
