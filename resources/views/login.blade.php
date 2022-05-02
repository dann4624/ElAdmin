@extends('layouts.master')
@section('title')
    Login
@endsection
@section('content')
    <form method="post" action="{{route('login.submit')}}">
        @csrf
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
        <input type="text" name="password" placeholder="Password" value="{{ old('password') }}">
        <input type="submit" value="Login">
    </form>
@endsection
