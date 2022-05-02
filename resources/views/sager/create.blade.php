@extends('layouts.master')
@section('title')
    Ny Sag
@endsection
@section('content')
    <form method="post" action="{{route('sager.store')}}">
        @include('sager.form')
    </form>
@endsection
