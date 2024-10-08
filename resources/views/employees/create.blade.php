@extends('master')

@section('title')
    Thêm mới
@endsection
@section('content')
    {{-- @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
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
    @endif --}}

    <div class="container">
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 row">
                <label for="fist_name" class="col-4 col-form-label">fist_name</label>
                <div class="col-8">
                    <input type="text" class="form-control @error('fist_name') is-invalid @enderror" name="fist_name"
                        id="fist_name" value="{{ old('fist_name') }}" />
                    @error('fist_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="last_name" class="col-4 col-form-label">Last Name</label>
                <div class="col-8">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                        id="last_name" value="{{ old('last_name') }}" />
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Address</label>
                <div class="col-8">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                        id="address" value="{{ old('address') }}" />
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
                        id="phone" value="{{ old('phone') }}" />
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" value="{{ old('email') }}" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="date_of_birth" class="col-4 col-form-label">Date of Birth</label>
                <div class="col-8">
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                        name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" />
                    @error('date_of_birth')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="hire_date" class="col-4 col-form-label">Hire Date</label>
                <div class="col-8">
                    <input type="datetime" class="form-control @error('hire_date') is-invalid @enderror" name="hire_date"
                        id="hire_date" value="{{ old('hire_date') }}" />
                    @error('hire_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="salary" class="col-4 col-form-label">Salary</label>
                <div class="col-8">
                    <input type="number" class="form-control @error('salary') is-invalid @enderror" name="salary"
                        id="salary" value="{{ old('salary') }}" />
                    @error('salary')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Is Active</label>
                <div class="col-8">
                    <input type="checkbox" class="form-checkbox @error('is_active') is-invalid @enderror" name="is_active"
                        id="is_active" value="1" />
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="department_id" class="col-4 col-form-label">Department ID</label>
                <div class="col-8">
                    <input type="number" class="form-control @error('department_id') is-invalid @enderror"
                        name="department_id" id="department_id" value="{{ old('department_id') }}" />
                    @error('department_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="manager_id" class="col-4 col-form-label">Manager ID</label>
                <div class="col-8">
                    <input type="number" class="form-control @error('manager_id') is-invalid @enderror"
                        name="manager_id" id="manager_id" value="{{ old('manager_id') }}" />
                    @error('manager_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="profile_picture" class="col-4 col-form-label">Profile Picture</label>
                <div class="col-8">
                    <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                        name="profile_picture" id="profile_picture" />
                    @error('profile_picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
