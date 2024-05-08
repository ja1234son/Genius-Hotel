@extends('layouts.app')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit <strong style="color: orange;">{{ $staff->full_name }}</strong> Details</h4>
                            @include('alerts.errors')
                            @include('alerts.success')
                            @include('alerts.warning')
                        </div>
                        <div class="card-body">
                            <div class="form-validation">

                                <form class="needs-validation" action="{{url('staffs/'.$staff->id)}}" enctype="multipart/form-data"  method="post"  novalidate >
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Full Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control"  value="{{ $staff->full_name }}"
                                                     id="validationCustom01" name="full_name"
                                                    placeholder="Enter staff name"
                                                     required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom02">Email <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="email" class="form-control" name="email" id="validationCustom02"
                                                     placeholder="Your valid email.."  value="{{ $staff->email }}" required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom03">Photo
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control"  name="photo"  id="validationCustom03"required>
                                                    <input type="hidden" class="form-control" value="{{ $staff->photo }}"
                                                     name="old_photo"  id="validationCustom03"required>
                                                  <img class="" width="50px" height="50px" src="{{ asset('assets/StaffImages') }}/{{ $staff->photo }}" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom05">Department
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control"  name="department_id" id="validationCustom05">
                                                    {{-- <option value="0">-- Please select department --</option> --}}
                                                    @foreach($depart as $dp)
                                                    <option @if($staff->id == $dp->id) selected @endif value="{{$dp->id}}">{{$dp->title}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom06">Salary type
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="radio"  id="validationCustom06" @if($staff->salary_type=='daily') checked
                                                    @endif value="daily" name="salary_type"> Daily
                                                    <input type="radio"  id="validationCustom06" @if($staff->salary_type=='monthly') checked
                                                    @endif value="monthly" name="salary_type"> Monthly
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom06">Salary amount
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control"  value="{{ $staff->salary_amount }}" name="salary_amount" id="validationCustom06"
                                                    placeholder="$21.60" required>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-lg-9 ms-auto  d-flex justify-content-center">
                                                    <a href="{{ url('staffs') }}" type="button"
                                                    class="btn btn-danger font-weight-bold btn-sm">Back</button>
                                                </a>
                                                    <button type="submit" name="save_close" value="1"
                                                    class="btn btn-secondary font-weight-bold btn-sm submitButton">Save
                                                    &
                                                    Close</button>
                                                <button type="submit" name="save"
                                                    class="btn btn-primary font-weight-bold btn-sm submitButton">Save</button>
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
