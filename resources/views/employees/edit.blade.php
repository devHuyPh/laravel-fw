@extends('master')

@section('title')
    Cập nhật Nhân Viên: {{ $employee->fist_name . $employee->last_name }}
@endsection
@section('content')
    Cập nhật Nhân Viên: {{ $employee->fist_name . $employee->last_name }}

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-info">
            THAO TAC THANH CONG
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <form method="POST" action="{{ route('employees.update', $employee) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">First Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="fist_name" id="fist_name"
                        value="{{ $employee->fist_name }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Last Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="last_name" id="last_name"
                        value="{{ $employee->last_name }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address"
                        value="{{ $employee->address }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone"
                        value="{{ $employee->phone }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{ $employee->email }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date_of_birth" class="col-4 col-form-label">date_of_birth</label>
                <div class="col-8">
                    <input type="date_of_birth" class="form-control" name="date_of_birth" id="date_of_birth"
                        value="{{ $employee->date_of_birth }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="hire_date" class="col-4 col-form-label">hire_date</label>
                <div class="col-8">
                    <input type="hire_date" class="form-control" name="hire_date" id="hire_date"
                        value="{{ $employee->hire_date }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="manager_id" class="col-4 col-form-label">manager_id</label>
                <div class="col-8">
                    <input type="manager_id" class="form-control" name="manager_id" id="manager_id"
                        value="{{ $employee->manager_id }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="salary" class="col-4 col-form-label">salary</label>
                <div class="col-8">
                    <input type="" class="form-control" name="salary" id="salary"
                        value="{{ $employee->salary }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="department_id" class="col-4 col-form-label">department_id</label>
                <div class="col-8">
                    <input type="department_id" class="form-control" name="department_id" id="department_id"
                        value="{{ $employee->department_id }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Is active</label>
                <div class="col-8">

                    <input type="checkbox" class="form-checkbox" name="is_active" id="is_active" value="1"
                        @checked($employee->is_active) />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="profile_picture" class="col-4 col-form-label">profile_picture</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="profile_picture" id="avatar" />
                    @if ($employee->profile_picture)
                        <img src="{{ route('employee.picture', $employee->id) }}" alt="Profile Picture" width="100"
                            height="100">
                    @endif
                </div>
            </div>



            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
