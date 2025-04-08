@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Booking Requests</h4>
                            @include('alerts.error')
                            @include('alerts.success')
                            @include('alerts.warning')
                            {{-- <a href="{{url('staffs/create')}}" type="submit" class="float-right btn btn-primary btn-sm">New</a> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Guest Name</th>
                                            <th>Phone No</th>
                                            <th>Room</th>
                                            <th>Check in Date</th>
                                            <th>Check out Date</th>
                                            <th>Adults</th>
                                            <th>Children</th>
                                            <th>Special Request</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($bookings as $booking)
                                        
                                        <tr>
                                            <td>{{$booking->id}}</td>
                                            <td>{{$booking->guest_name}}</td>
                                            <td>{{$booking->phone}}</td>
                                            <td></td>
                                          <td>{{$booking->check_in_date}}</td>
                                          <td>{{$booking->check_out_date}}</td>
                                          <td>{{$booking->adults}}</td>
                                          <td>{{$booking->children}}</td>
                                          <td>{{$booking->special_request}}</td>

                                          <td>
                                          @if ($booking->status == 'confirmed')
                                          <span class="badge badge-success">Complete</span>

                                              @elseif ($booking->status == 'pending')
                                              <span class="badge badge-warning">Pending</span>

                                              @elseif($booking->status == 'cancelled')
                                              <span class="badge badge-danger">Cancelled</span>
                                          @endif
                                          </td>

                                            <td>
                                                <div class="d-flex">
                                                    {{-- <a href="" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a> --}}
                                                    {{-- <a href="" class="btn btn-warning shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a> --}}
                                                    <button class="btn btn-danger shadow btn-xs sharp delete-btn" data-url="{{url('adminbookinglist-delete/'.$booking->id)}}"><i class="fa fa-trash"></i></button>
                                                    {{-- <a class="btn btn-danger shadow btn-xs sharp delete-btn" onclick="confirmation(event)" href="{{ url('staffs/' . $staff->id).'/delete' }}"><i class="fa fa-trash"> --}}
                                                        </i></a>
                                                </div>
                                            </td>
                                        </tr>
                                     
                                        @endforeach

                                    </tbody>
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
