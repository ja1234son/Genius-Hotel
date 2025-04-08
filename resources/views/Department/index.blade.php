@extends('layouts.app')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Departments</h4>
                            @include('alerts.error')
                            @include('alerts.success')
                            @include('alerts.warning')

                            {{-- @can('Manage Department')     --}}
                           <a href="{{url('departments/create')}}" type="submit" class="float-right btn btn-dark btn-sm">New</a>
                           {{-- @endcan --}}

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>S/n</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($depart as $departs)
                                        <tr>
                                            <td>{{$departs->id}}</td>
                                            <td>{{$departs->title}}</td>

                                            {{-- @can('Manage Department')   --}}
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{url('departments/'.$departs->id)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
                                                    <a href="{{url('departments/'.$departs->id).'/edit'}}" class="btn btn-warning shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{route('department.delete',$departs->id)}}" class="btn btn-danger shadow btn-xs sharp delete-btn" data-url="">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                            </td>
                                            {{-- @endcan --}}

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
                            Swal.fire("Deleted!", "The department has been deleted successfully.", "success")
                            .then(() => {
                                location.reload(); // Refresh the page to reflect changes
                            });
                        } else {
                            Swal.fire("Error!", "Failed to delete the department.", "error");
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
