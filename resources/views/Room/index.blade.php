@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Rooms</h4>
                            @include('alerts.error')
                            @include('alerts.success')
                            @include('alerts.warning')
                           <a href="{{url('rooms/create')}}" type="submit" class="float-right btn btn-info btn-sm">New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Name</th>
                                            <th>Room Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($room as $rom)
                                        <tr>
                                            <td>{{$rom->id}}</td>
                                            <td>{{$rom->name}}</td>
                                            <td>{{$rom->roomtype->name}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{url('rooms/'.$rom->id)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
                                                    <a href="{{url('rooms/'.$rom->id).'/edit'}}" class="btn btn-warning shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                    <button class="btn btn-danger shadow btn-xs sharp delete-btn" data-url="{{url('rooms/'.$rom->id).'/delete'}}"><i class="fa fa-trash"></i></button>
                                                    {{-- <a href="{{url('rooms/'.$rom->id).'/delete'}}" class="btn btn-danger  shadow btn-xs sharp"
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
