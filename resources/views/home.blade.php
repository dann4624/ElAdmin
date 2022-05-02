@extends('layouts.master')
@section('title')
    Hjem
@endsection
@section('content')
    <style>
        .table{
            display:table;
        }

        .row{
            display:table-row;

        }

        .cell{
            display:table-cell;
            margin-bottom:1rem;
            padding-bottom:1rem;
        }

        label{
            font-weight:bold;
        }

        label::after{
            content: " : ";
        }

        #navn_table{
            max-width:25rem;
        }

        input[type=submit]{
            border-style:var(--main_border_style);
            border-color:var(--main_border_color);
            border-width:var(--main_border);
            padding:0.7rem;
            font-weight:bold;
        }
    </style>
    <!--
        <b>Session ID : </b> {{session()->get('id')}} <br>
        <b>Session Fornavn : </b> {{session()->get('fornavn')}} <br>
        <b>Session Efternavn : </b> {{session()->get('efternavn')}} <br>
        <b>Session Type : </b> {{session()->get('type')}} <br>

        <br><br>
    -->
    <h2>Skift Navn</h2>
    <form method="post" action="{{route(session()->get('type').".navn",[])}}">
        @method('put')
        @csrf
        <div class="table" id="navn_table">
            <div class="row">
                <div class="cell">
                    <label for="fornavn">Fornavn</label>
                </div>
                <div class="cell">
                    <input type="text" name="fornavn" placeholder="Fornavn" value="{{session()->get('fornavn')}}" id="fornavn">
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <label for="efternavn">Efternavn</label>
                </div>
                <div class="cell">
                    <input type="text" name="efternavn" placeholder="Efternavn" value="{{session()->get('efternavn')}}" id="efternavn">
                </div>
            </div>
            <div class="row">
                <div class="cell">
                </div>
                <div class="cell">
                    <input type="submit" value="Skift Navn" class="btn btn-success">
                </div>
            </div>
        </div>
    </form>

    <br><br>

    <h2>Skift Password</h2>
    <form method="post" action="{{route(session()->get('type').".password")}}">
        @method('put')
        @csrf
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Skift Password" class="btn btn-success">
    </form>

    <br><br>
@endsection

