@extends('master')

@section('title')
    xem chi tiet khach hang: {{ $customer->name }}
@endsection
@section('content')
    <div class="container">
        <h2>xem chi tiet khach hang: {{ $customer->name }}</h2>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Ten Truong</th>
                        <th scope="col">Gia Tri</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($customer->toArray() as $key => $value)
                        <tr class="">
                            <td scope="row">{{strtoupper($key)}}</td>
                            <td>
                                @php
                                    switch ($key) {
                                        case 'avatar':
                                            if ($value) {
                                                $url =  Storage::url($value) ;
                                                echo  "<img src='$url' alt='' width='100px'>";
                                            }
                                            break;
                                        case 'is_active':
                                            echo $customer->is_active 
                                                ?  '<span class="badge bg-primary">Yes!</span>'
                                                    :  '<span class="badge bg-danger">No!</span>';
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
