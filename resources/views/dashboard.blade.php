@extends('master')

@section('content')
    <h1>Dashboard</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Đăng Xuất</button>
    </form>
@endsection
