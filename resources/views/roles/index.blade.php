@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $data['page'] ?? '' }}</h4>
                            @include('alerts.error')
                            @include('alerts.success')
                            @include('alerts.warning')

                            {{-- @can('Manage Roles')   --}}
                           <a href="{{route('roles.create')}}" type="submit" class="float-right btn btn-info btn-sm">New Roles</a>
                           {{-- @endcan --}}

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->description }}</td>

                                            {{-- @can('Manage Roles') --}}
                                                
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning shadow btn-xs sharp me-1">
                                                        <i style="font-size: 17px;" class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('roles.delete',$role->id)}}" class="btn btn-danger shadow btn-xs sharp delete-btn" data-url="">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            {{-- @endcan --}}

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
                            Swal.fire("Deleted!", "The role has been deleted successfully.", "success")
                            .then(() => {
                                location.reload(); // Refresh the page to reflect changes
                            });
                        } else {
                            Swal.fire("Error!", "Failed to delete the role.", "error");
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
