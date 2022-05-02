@extends('layouts.master')
@section('title')
    {{$plural}}
@endsection
@section('content')
    <form action="{{request()->segment(count(request()->segments()))}}" method="post" id="create_form">
        @csrf
        <input type="text" placeholder="Fornavn" name="fornavn" id="create_fornavn">
        <input type="text" placeholder="Efternavn" name="efternavn" id="create_efternavn">
        <input type="email" placeholder="Email" name="email" id="create_email">
        <input type="text" placeholder="Username" name="username" id="create_username">
        <input type="text" placeholder="Password" name="password" id="create_password">
        <input type="submit" class="btn btn-success" id="add_button" value="Tilføj ny {{$singular}}">
    </form>
    @if(isset($data) && count($data) >= 1)
        <table id="data_table">
            <thead>
            <th>ID</th>
            <th>Fornavn</th>
            <th>Efternavn</th>
            <th>Email</th>
            <th style="text-align: center">Manage</th>
            </thead>
            @foreach($data as $object)
                <tr>
                    <td>
                        {{$object['id']}}
                    </td>
                    <form action="{{request()->segment(count(request()->segments()))}}/{{$object['id']}}" method="post" id="edit_form">
                        @method('PUT')
                        @csrf
                        <td>
                            <input type="text" value="{{$object['fornavn']}}" name="fornavn" id="edit_fornavn_{{$object['id']}}"  readonly >
                        </td>
                        <td>
                            <input type="text" value="{{$object['efternavn']}}" name="efternavn" id="edit_fornavn_{{$object['id']}}"  readonly >
                        </td>
                        <td>
                            <input type="email" value="{{$object['email']}}" name="email" id="edit_email_{{$object['id']}}"  readonly >
                        </td>
                        <td id="cms">
                            <input type="submit" value="Opdater" class="btn btn-info hidden" id="edit_button_{{$object['id']}}">
                    </form>
                    <a class="btn btn-secondary" id="enable-edit_{{$object['id']}}" onclick="enableEdit(this)">Rediger</a>
                    <form method="post" action="{{request()->segment(count(request()->segments()))}}/{{$object['id']}}" id="delete_button_{{$object['id']}}" onsubmit="return confirm('Er du sikke på du vil slette denne {{$singular}}?');" id="delete_form_{{$object['id']}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Slet" class="btn btn-danger">
                    </form>

                    </td>
                </tr>
            @endforeach
        </table>
    @else
        Ingen {{$plural}}
    @endif

@endsection
<script>
    function enableEdit(editButton){
        editButton.parentElement.parentElement.children[4].firstElementChild.removeAttribute('readonly'); // Remove the readonly attribute from the "Fornavn" input
        editButton.parentElement.parentElement.children[5].firstElementChild.removeAttribute('readonly'); // Remove the readonly attribute from the "Efternavn" input
        editButton.parentElement.parentElement.children[6].firstElementChild.removeAttribute('readonly'); // Remove the readonly attribute from the "Email" input
        editButton.parentElement.parentElement.children[7].firstElementChild.classList.remove('hidden'); // Show the Update button
        editButton.classList.add('hidden'); // Hide the Edit button
    }
</script>
