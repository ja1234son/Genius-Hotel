@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $data['page'] }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">{{ $data['page3'] }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">{{ $data['page3'] }}</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <a href="{{ route('users') }}" class="btn btn-primary btn-sm font-weight-bolder">
                                        <span><i class="fas fa-plus-square"></i></span>
                                        Back
                                    </a>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                        <div class="card-body">
                            @include('alerts.success')
                            @include('alerts.errors')
                            @include('alerts.error')

                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{ route('user.permissions.update') }}" method="post" id="createForm">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data['user']->id }}">
                                        <div class="row gy-4">
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <label for="name" class="form-label">Name <span
                                                            class="required">*</span></label>
                                                    <input type="text" class="form-control form-control-sm" id="fname"
                                                        value="{{ $data['user']->name }}" name="fname" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row gy-4 mt-1">
                                            <label for="full_name" class="form-label">Permission <span
                                                    class="required">*</span></label>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label class="checkbox">
                                                            <input type="checkbox" id="check_all">
                                                            <span class="mr-2"> </span> Check All
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    @foreach ($data['permissionsAll'] as $key => $item)
                                                        <h5 class="card-header" style="background-color: #F4F7FA">
                                                            {{ $key }}</h5>
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                @foreach ($item as $permission)
                                                                    <div class="col-xxl-3 col-md-6 mb-2">
                                                                        <label class="checkbox">
                                                                            <input type="checkbox" name="permissions[]"
                                                                                id="{{ $permission->id }}"
                                                                                value="{{ $permission->id }}">
                                                                            <span class="mr-2"> </span>
                                                                            {{ $permission->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-center mb-1">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('users') }}" type="button"
                                                    class="btn btn-danger font-weight-bold btn-sm">Back</button>
                                                </a>
                                                <button type="submit" name="save_close" value="1"
                                                    class="btn btn-secondary font-weight-bold btn-sm">Save &
                                                    Close</button>
                                                <button type="submit" name="save"
                                                    class="btn btn-primary font-weight-bold btn-sm">Save</button>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-fluid -->
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
