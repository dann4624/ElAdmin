@extends('layouts.master')
@section('title')
    {{$plural}}
@endsection
@section('content')
    <form action="{{request()->segment(count(request()->segments()))}}" method="post" id="create_form">
        @csrf
        <input type="text" placeholder="Navn" name="navn" id="create_navn">
        <select name="fabrikant_id" id="create_fabrikant_id">
            @foreach($fabrikanter as $fabrikant)
                <option value="{{$fabrikant['id']}}">{{$fabrikant['navn']}}</option>
            @endforeach
        </select>
        <select name="type_id" id="edit_type_id">
            @foreach($typer as $type)
                <option value="{{$type['id']}}">{{$type['navn']}}</option>
            @endforeach
        </select>
        <input type="submit" class="btn btn-success" id="add_button" value="Tilføj ny {{$singular}}">
    </form>
    @if(isset($data) && count($data) >= 1)
        <table id="data_table">
            <thead>
            <th>Navn</th>
            <th>Fabrikant</th>
            <th>Type</th>
            <th style="text-align: center">Manage</th>
            </thead>
            @foreach($data as $object)
                <tr>
                    <form action="{{request()->segment(count(request()->segments()))}}/{{$object['id']}}" method="post" id="edit_form">
                        @method('PUT')
                        @csrf
                        <td>
                            <input type="text" value="{{$object['navn']}}" name="navn" id="edit_navn_{{$object['id']}}"  readonly >
                        </td>
                        <td>
                            <select name="fabrikant_id" id="edit_fabrikant_id_{{$object['id']}}" disabled>
                                @foreach($fabrikanter as $fabrikant)
                                    <option value="{{$fabrikant['id']}}" @if($object['fabrikant']['id'] == $fabrikant['id']) selected @endif>{{$fabrikant['navn']}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="type_id" id="edit_type_id_{{$object['id']}}" disabled>
                                @foreach($typer as $type)
                                    <option value="{{$type['id']}}"  @if($object['type']['id'] == $type['id']) selected @endif>{{$type['navn']}}</option>
                                @endforeach
                            </select>
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
        editButton.parentElement.parentElement.children[3].firstElementChild.removeAttribute('readonly'); // Remove the readonly attribute from the "Navn" input
        editButton.parentElement.parentElement.children[4].firstElementChild.removeAttribute('disabled'); // Remove the readonly attribute from the "Navn" input
        editButton.parentElement.parentElement.children[5].firstElementChild.removeAttribute('disabled'); // Remove the readonly attribute from the "Navn" input
        editButton.parentElement.parentElement.children[6].firstElementChild.classList.remove('hidden'); // Show the Update button
        editButton.classList.add('hidden'); // Hide the Edit button
    }
</script>
