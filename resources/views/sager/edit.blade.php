@extends('layouts.master')
@section('title')
    Rediger Sag
@endsection
@section('content')
    <form method="post" action="{{route('sager.update',['sager' => request()->route('sager')])}}">
        @if($formtype == "edit")
            @method('put')
        @endif
        @include('sager.form')
    </form>
@endsection
