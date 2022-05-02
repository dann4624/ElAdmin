@extends('layouts.master')
@section('title')
    Mine Sager
@endsection
@section('content')
    <style>
        #data_table td,#data_table th{
            padding-inline:0.8rem;
            padding-block:0.5rem;
        }

        #data_table th:first-of-type{
            padding-left:1rem;
        }

        #data_table th:last-of-type{
            padding-right:1rem;
        }

        #data_table td:first-of-type{
            padding-left:1rem;
        }
        #data_table td:last-of-type{
            padding-right:1rem;
        }
    </style>
    <table id="data_table">
        <thead>
        <th>Indlevering</th>
        <th>Chip ID</th>
        <th>Beskrivelse</th>
        <th>Kunde</th>
        <th>Produkt</th>
        <th>Type</th>
        <th>Afhentning</th>
        <th>Status</th>
        <th>Status Skiftet</th>
        <th style="text-align: center">Manage</th>
        </thead>
        @foreach($data as $object)
            <tr>
                <td>
                    {{$object['indlevering']}}
                </td>
                <td>
                    {{$object['chip_id']}}
                </td>
                <td>
                    {{$object['beskrivelse']}}
                </td>
                <td>
                    <a href="/kunder/{{$object['kunde']['id']}}">Kunde</a>
                </td>
                <td>
                    <a href="/produkter/{{$object['produkt']['id']}}">Produkt</a>
                </td>
                <td>
                    {{$object['sagstype']['navn']}}
                </td>
                <td>
                    {{$object['afhentningstype']['navn']}}
                </td>
                <td>
                    {{$object['status']['navn']}}
                </td>
                <td>
                    {{$object['status_skift']}}
                </td>
                <td id="cms">
                    <a href="{{request()->segment(count(request()->segments()))}}/{{$object['id']}}/edit" class="btn btn-info" id="edit_button">Rediger</a>
                    <form method="post" action="{{request()->segment(count(request()->segments()))}}/{{$object['id']}}/delete" id="delete_button" onsubmit="return confirm('Er du sikke på du vil slette denne {{$singular}}?');">
                        @method('DELETE')
                        <input type="submit" value="Slet" class="btn btn-danger">
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
@endsection
