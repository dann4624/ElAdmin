@extends('layouts.master')
@section('title')
    Mine {{$plural}}
@endsection
@section('content')
    <form action="{{route('addresser.store',['id' => session('id')])}}" method="post" id="create_form">
        @csrf
        <input type="text" placeholder="Vej Navn" name="vej_navn" id="create_vej_navn">
        <input type="text" placeholder="Vej Nummer" name="vej_nummer" id="create_vej_nummer">
        <select name="postnummer" id="create_postnummer">
            @foreach($byer as $by)
                <option value="{{$by['postnummer']}}">{{$by['postnummer']}} {{$by['navn']}}</option>
            @endforeach
        </select>
        <input type="submit" class="btn btn-success" id="add_button" value="Tilføj ny {{$singular}}">
    </form>
    @if(isset($data) && count($data) >= 1)
        <table id="data_table">
            <thead>
                <th>Vej Navn</th>
                <th>Vej Nummer</th>
                <th>By</th>
                <th>Foretrukken</th>
                <th style="text-align: center">Manage</th>
            </thead>
        @foreach($data as $object)
            <tr>
                <form action="{{request()->segment(count(request()->segments()))}}/{{$object['id']}}" method="post" id="edit_form">
                    @method('put')
                    @csrf
                    <td>
                        <input type="text" placeholder="Vej Navn" name="vej_navn" id="create_vej_navn" value="{{$object['vej']}}" readonly>
                    </td>
                    <td>
                        <input type="text" placeholder="Vej Nummer" name="vej_nummer" id="create_vej_nummer" value="{{$object['vej_nummer']}}" readonly>
                    </td>
                    <td>
                        <select name="postnummer" id="create_postnummer" disabled>
                            @foreach($byer as $by)
                                <option value="{{$by['postnummer']}}" @if($by['postnummer'] == $object['by']['postnummer'])selected @endif>{{$by['postnummer']}} {{$by['navn']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        @if($object['foretrukken'] == 1)
                            Foretrukken
                        @else
                            Ikke Foretrukken
                        @endif
                    </td>
                    <td id="cms">
                        <input type="submit" value="Opdater" class="btn btn-info hidden" id="edit_button_{{$object['id']}}">
                </form>
                <a class="btn btn-secondary" id="enable-edit_{{$object['id']}}" onclick="enableEdit(this)">Rediger</a>
                @if($object['foretrukken'] == 0)
                    <form method="post" action="{{route('addresser.foretrukken.add',['id' => $object['id']])}}">
                        @method('put')
                        @csrf
                        <input type="submit" value="Gør Foretrukken" class="btn btn-info" id="foretrukken_add_{{$object['id']}}">
                    </form>
                @else
                    <form method="post" action="{{route('addresser.foretrukken.remove',['id' => $object['id']])}}">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Fjern Foretrukken" class="btn btn-info" id="foretrukken_remove_{{$object['id']}}">
                    </form>
                @endif
                <form method="post" action="{{request()->segment(count(request()->segments()))}}/{{$object['id']}}" id="delete_button_{{$object['id']}}" onsubmit="return confirm('Er du sikke på du vil slette denne {{$singular}}?');" id="delete_form_{{$object['id']}}">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Slet" class="btn btn-danger">
                </form>
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
        editButton.parentElement.parentElement.children[4].firstElementChild.removeAttribute('readonly'); // Remove the readonly attribute from the "Navn" input
        editButton.parentElement.parentElement.children[5].firstElementChild.removeAttribute('disabled'); // Remove the readonly attribute from the "Navn" input
        editButton.parentElement.parentElement.children[7].firstElementChild.classList.remove('hidden'); // Show the Update button
        editButton.classList.add('hidden'); // Hide the Edit button
    }
</script>
