@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                            @include('alerts.error')
                            @include('alerts.success')
                            @include('alerts.warning')
                           <a href="{{route('users.create')}}" type="submit" class="float-right btn btn-info btn-sm">New User</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values['users'] as $key => $employee)
                                        <tr>
                                            <td>{{$employee->id}}</td>
                                            <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                                            <td>{{$employee->email}}</td>
                                            <td>{{$employee->gender}}</td>
                                            <td>{{ $employee->roles->pluck('name')->join(', ') }}</td>
                                            <td>
                                                @if($employee->status == 'active')
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('users.edit',$employee->id)}}" class="btn btn-warning shadow btn-xs sharp me-1">
                                                        <i style="font-size: 17px;" class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('users.delete',$employee->id)}}" class="btn btn-danger shadow btn-xs sharp delete-btn" data-url="">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
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
        document.addEventListener('DOMContentLoaded', function() {
           document.querySelectorAll('.delete-btn').forEach(button => {
               button.addEventListener('click', function(event) {
                   event.preventDefault(); // Prevent the default link behavior
       
                   // Get the delete URL from the href attribute
                   let url = this.getAttribute('href');
       
                   // Show the SweetAlert confirmation dialog
                   Swal.fire({
                       title: 'Are you sure you want to delete?',
                       text: "You won't be able to recover this data!",
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#d33',
                       cancelButtonColor: '#3085d6',
                       confirmButtonText: 'Yes, delete it!'
                   }).then((result) => {
                       if (result.isConfirmed) {
                           // Send AJAX request for deletion
                           fetch(url, {
                               method: 'POST', // Laravel expects a POST request with a DELETE override
                               headers: {
                                   'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                   'Content-Type': 'application/json'
                               },
                               body: JSON.stringify({ _method: 'DELETE' }) // Laravel requires _method to simulate DELETE
                           })
                           .then(response => response.json())
                           .then(data => {
                               if (data.success) {
                                   Swal.fire("Deleted!", "The user has been deleted successfully.", "success")
                                   .then(() => {
                                       location.reload(); // Refresh the page to reflect changes
                                   });
                               } else {
                                   Swal.fire("Error!", "Failed to delete user.", "error");
                               }
                           })
                           .catch(error => {
                               Swal.fire("Error!", "Something went wrong while deleting.", "error");
                           });
                       }
                   });
               });
           });
       });
       
       
           </script>
    
@endsection
