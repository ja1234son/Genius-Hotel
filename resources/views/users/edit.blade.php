@extends('layouts.app')

@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $data['page3'] }}</h4>
                            @include('alerts.errors')
                            @include('alerts.success')
                            @include('alerts.warning')
                        </div>
                        <div class="card-body">
                            <div class="form-validation">

                                <form class="needs-validation" action="{{ route('users.update', $users->id) }}" method="post"  novalidate >
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="{{$users->id}}" name="id">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">First Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{$users->first_name}}" class="form-control" id="validationCustom01" name="first_name"
                                                    placeholder="Enter staff name"
                                                     required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom02">Last Name <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="email" class="form-control"  value="{{$users->last_name}}" name="last_name" id="validationCustom02"
                                                     placeholder="Enter Your Last Name.." required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom03">Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="email" class="form-control"  value="{{$users->email}}" placeholder="Enter Valid Email"  name="email"  id="validationCustom03"required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom05">Gender
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control"  name="gender" id="validationCustom05">
                                                    <option value="0">-- Select gender --</option>
                                                    <option value="Male" {{$users->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                     <option value="Female" {{ $users->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom06">Roles <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="role" id="validationCustom06">
                                                        <option value="">--Select Roles--</option>
                                                        @foreach ($data['roles'] as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $users->roles->contains($item->id) ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom06">Phone
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number"  value="{{$users->phone_no}}" class="form-control"  name="phone" id="validationCustom06" 
                                                    placeholder="Enter Phone Number" required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-12 text-center">
                                                    <a href="{{route('users')}}" class="btn btn-danger font-weight-bold btn-sm">Back</a>
                                                    <button type="submit" name="save_close" value="1"
                                                        class="btn btn-secondary font-weight-bold btn-sm submitButton">
                                                        Save & Close
                                                    </button>
                                                    <button type="submit" name="save"
                                                        class="btn btn-primary font-weight-bold btn-sm submitButton">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


