@extends('master')

@section('title')
    xem chi tiet khach hang: {{ $employee->name }}
@endsection
@section('content')
    <div class="container">
        <h2>xem chi tiet khach hang: {{ $employee->name }}</h2>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Ten Truong</th>
                        <th scope="col">Gia Tri</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($employee->toArray() as $key => $value)
                        <tr class="">
                            <td scope="row">{{ strtoupper($key) }}</td>
                            <td>
                                @php
                                    switch ($key) {
                                        case 'profile_picture':
                                            if ($value) {
                                                echo '<img src="' .
                                                    route('employee.picture', $employee->id) .
                                                    '" alt="profile_picture" width="100" height="100">';
                                            }
                                            else {
                                                echo 'NO profile_picture';
                                            }
                                            break;

                                        case 'is_active':
                                            echo $employee->is_active
                                                ? '<span class="badge bg-primary">Yes!</span>'
                                                : '<span class="badge bg-danger">No!</span>';
                                            break;
                                        default:
                                            echo $value;
                                            break;
                                    }
                                @endphp
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
