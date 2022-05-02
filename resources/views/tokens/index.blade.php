@extends('layouts.master')
@section('title')
    {{$plural}}
@endsection
@section('content')
    <form action="{{request()->segment(count(request()->segments()))}}" method="post" id="create_form">
        @csrf
        <input type="text" placeholder="token" name="token" id="create_navn">
        <select name="target_id" id="create_target_id">
            @foreach($targets as $target)
                <option value="{{$target['id']}}">{{$target['navn']}}</option>
            @endforeach
        </select>
        <input type="submit" class="btn btn-success" id="add_button" value="Tilføj ny {{$singular}}">
    </form>
    @if(isset($data) && count($data) >= 1)
        <table id="data_table">
            <thead>
            <th>Navn</th>
            <th>Target</th>
            <th style="text-align: center">Manage</th>
            </thead>
            @foreach($data as $object)
                <tr>
                    <form action="{{request()->segment(count(request()->segments()))}}/{{$object['id']}}" method="post" id="edit_form">
                        @method('PUT')
                        @csrf
                        <td>
                            <input type="text" value="{{$object['token']}}" name="token" id="edit_navn_{{$object['id']}}"  readonly >
                        </td>
                        <td>
                            <select name="target_id" id="edit_target_id_{{$object['id']}}" disabled>
                                @foreach($targets as $target)
                                    <option value="{{$target['id']}}" @if($object['target']['id'] == $target['id']) selected @endif>{{$target['navn']}}</option>
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
        editButton.parentElement.parentElement.children[4].firstElementChild.removeAttribute('disabled'); // Remove the disabled attribute from the "Target" input
        editButton.parentElement.parentElement.children[5].firstElementChild.classList.remove('hidden'); // Show the Update button
        editButton.classList.add('hidden'); // Hide the Edit button
    }
</script>
