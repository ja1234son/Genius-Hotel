@extends('layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">{{ $data['page'] ?? '' }}</h4>
                        @include('alerts.errors')
                        @include('alerts.success')
                        @include('alerts.warning')
                    </div>
                    <div class="card-body">
                        <div class="form-validation">

                            <form class="needs-validation" action="{{ route('roles.update', $data['role']->id) }}"  method="POST" novalidate>
                                @csrf
                               @method('PUT')
                               <input type="hidden" name="id" value="{{$data['role']->id}}">

                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <!-- Name Field -->
                                        <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label text-end">Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Role name" value="{{$data['role']->name}}" required>
                                            </div>
                                        </div>

                                        <!-- Description Field -->
                                        <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label text-end">Description
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" placeholder="Write Description..." 
                                                name="description" value="{{$data['role']->description}}" required>
                                            </div>
                                        </div>

                                        <!-- Check All Checkbox -->
                                        <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label text-end">Check All</label>
                                            <div class="col-lg-6">
                                                <input type="checkbox" id="checkAllPermissions">
                                                <span class="mr-2"> Select All Permissions</span>
                                            </div>
                                        </div>

                                        <!-- Permissions Section (Unified Background) -->
                                        <div class="permissions-section p-3 border rounded">
                                            @foreach ($data['permissionsAll'] as $key => $item)
                                                <h5 class="text-start mt-3">{{ $key }}</h5>
                                                <div class="row">
                                                    @foreach ($item as $permission)
                                                        <div class="col-md-4 col-sm-6 text-start">
                                                            <label class="checkbox">
                                                                <input type="checkbox" class="permission-checkbox" 
                                                                       name="permissions[]" 
                                                                       value="{{ $permission->id }}"
                                                                       {{ in_array($permission->id, $data['permissionsAssigned']) ? 'checked' : '' }}>
                                                                <span class="mr-2"></span>
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
<br>
                                        <!-- Buttons Section (Centered) -->
                                        <div class="mb-3 row">
                                            <div class="col-12 text-center">
                                                <a href="{{ route('roles') }}" class="btn btn-danger font-weight-bold btn-sm">Back</a>
                                                <button type="submit" name="save_close" value="1"
                                                    class="btn btn-secondary font-weight-bold btn-sm submitButton">
                                                    Save & Close
                                                </button>
                                                <button type="submit" name="save"
                                                    class="btn btn-primary font-weight-bold btn-sm submitButton">
                                                    Save
                                                </button>
                                            </div>                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- JavaScript for "Check All" Functionality -->
                            <script>
                                document.getElementById('checkAllPermissions').addEventListener('change', function() {
                                    let checkboxes = document.querySelectorAll('.permission-checkbox');
                                    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script>
        $(document).ready(function() {

            $('#check_all').click(function() {
                var c = this.checked;
                $(':checkbox').prop('checked', c);
            });
        });

        var permissions = @json($data['permissionsAssigned']);
        $('input[type=checkbox]').each(function() {
            var id = $(this).val();
            if (ValueExist(id, permissions) == 1) {
                $(this).attr('checked', true);
            }
        });

        function ValueExist(value, arr) {
            var status = '0';

            for (var i = 0; i < arr.length; i++) {
                var name = arr[i];
                if (name == value) {
                    status = '1';
                    break;
                }
            }
            return status;
        }
    </script>
@endpush
