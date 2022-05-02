<style>
    #form_table{
        display:table;
    }
    .row{
        display:table-row;
    }
    .cell{
        display:table-cell;
        padding:1rem;
    }
    .label, .thead{
        font-weight:bold;
        vertical-align:top;
    }
    .label::after{
        padding-inline:1rem;
        content: " : ";
    }
    .data{

    }
</style>
<div id="form_table">
    @csrf
    <div class="row">
        <div class="cell label">
            Beskrivelse
        </div>
        <div class="cell data">
            <textarea name="beskrivelse">@if(isset($data)){{$data['beskrivelse']}}@endif</textarea>
        </div>
    </div>

    <div class="row">
        <div class="cell label">
            Chip ID
        </div>
        <div class="cell data">
            <input type="text" name="chip_id" @if(isset($data))value="{{$data['chip_id']}}" @endif>
        </div>
    </div>

    <div class="row">
        <div class="cell label">
            Medarbejder
        </div>
        <div class="cell data">
            <select name="medarbejder_id">
                @foreach($medarbejdere as $medarbejder)
                    <option value="{{$medarbejder['id']}}" @if(isset($data['medarbejder']))@if($data['medarbejder']['id'] == $medarbejder['id']) selected @endif @endif>{{$medarbejder['id']}} - {{$medarbejder['fornavn']}} {{$medarbejder['efternavn']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="cell label">
            Kunde
        </div>
        <div class="cell data">
            <select name="kunde_id">
                @foreach($kunder as $kunde)
                    <option value="{{$kunde['id']}}" @if(isset($data['kunde']))@if($data['kunde']['id'] == $kunde['id']) selected @endif @endif>{{$kunde['id']}} - {{$kunde['fornavn']}} {{$kunde['efternavn']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="cell label">
            Sags Type
        </div>
        <div class="cell data">
            <select name="sagstype_id">
                @foreach($sagstyper as $sagstype)
                    <option value="{{$sagstype['id']}}" @if(isset($data['sagstype']))@if($data['sagstype']['id'] == $sagstype['id']) selected @endif @endif>{{$sagstype['navn']}} - {{$sagstype['pris']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="cell label">
            Afhentnings Type
        </div>
        <div class="cell data">
            <select name="afhentningstype_id">
                @foreach($afhentningstyper as $afhentningstype)
                    <option value="{{$afhentningstype['id']}}" @if(isset($data['sagstype']))@if($data['afhentningstype']['id'] == $afhentningstype['id']) selected @endif @endif>{{$afhentningstype['navn']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="cell label">
            Status
        </div>
        <div class="cell data">
            <select name="status_id">
                @foreach($statuser as $status)
                    <option value="{{$status['id']}}" @if(isset($data['status']))@if($data['status']['id'] == $status['id']) selected @endif @endif>{{$status['navn']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="cell label">
            Produkt
        </div>
        <div class="cell data">
            <select name="produkt_id">
                @foreach($produkter as $produkt)
                    <option value="{{$produkt['id']}}" @if(isset($data['produkt']))@if($data['produkt']['id'] == $produkt['id']) selected @endif @endif>{{$produkt['model']['fabrikant']['navn']}} {{$produkt['model']['navn']}} [ {{$produkt['navn']}} ] ( {{$produkt['model']['type']['navn']}} )</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="cell">
            <input type="hidden" name="indlevering" @if(isset($data['indlevering']))value="{{$data['indlevering']}}"@else value="{{now()}}" @endif>
            <input type="hidden" name="status_skift" @if(isset($data['status_skift']))value="{{$data['status_skift']}}"@else value="{{now()}}" @endif>
        </div>
        <div class="cell data">
            <input type="submit" @if($formtype == "edit")value="Rediger Sag"@else value="Opret Sag" @endif>
        </div>
    </div>
</div>

