@extends('master')

@section('title')
    Danh sách Nhân Viên
@endsection
@section('content')
    <h1>Danh sách Nhân Viên</h1>
    <a class="btn btn-info" href="{{ route('employees.create') }}">Create</a>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-success">
            THAO TAC THANH CONG
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID </th>
                    <th scope="col">HỌ TÊN</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">DATE OF BIRTH</th>
                    <th scope="col">HIRE DATE</th>
                    <th scope="col">SALARY</th>
                    <th scope="col">IS ACTIVE</th>
                    <th scope="col">DEPARTMENT ID</th>
                    <th scope="col">MANAGER ID</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">PROFILE PICTURE</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $employee)
                    <tr class="">
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->fist_name }}.{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            @if ($employee->is_active)
                                <span class="badge 	bg-primary">New!</span>
                            @else
                                <span class="badge bg-danger">No!</span>
                            @endif

                        </td>
                        <td>{{ $employee->department_id }}</td>
                        <td>{{ $employee->manager_id }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            @if ($employee->profile_picture)
                                <img src="{{ route('employee.picture', $employee->id) }}" alt="Profile Picture" width="100" height="100">
                            @else
                                No image
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show', $employee) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $employee) }}">Edit</a>

                            <form action="{{ route('employees.destroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('xoa nhe')">XM</button>
                            </form>

                            <form action="{{ route('employees.forceDestroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-dark" onclick="return confirm('xoa nhe')">XC</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{$data->links();}}
    </div>
@endsection
