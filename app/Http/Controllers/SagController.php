<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SagController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sager";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('sager.index')
            ->with('data',$data)
            ->with('plural',"Sager")
            ->with('singular',"Sag");
    }

    public function show($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sager/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('sager.show')
            ->with('data',$data)
        ;
    }

    public function edit($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sager/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();

        $produkt_endpoint = "produkter";
        $produkt_url = $base_url.$produkt_endpoint;
        $produkt_data = Http::withToken($token)->get($produkt_url)->json();

        $kunde_endpoint = "kunder";
        $kunde_url = $base_url.$kunde_endpoint;
        $kunde_data = Http::withToken($token)->get($kunde_url)->json();

        $medarbejdere_endpoint = "medarbejdere";
        $medarbejdere_url = $base_url.$medarbejdere_endpoint;
        $medarbejdere_data = Http::withToken($token)->get($medarbejdere_url)->json();

        $sags_type_endpoint = "sagstyper";
        $sags_type_url = $base_url.$sags_type_endpoint;
        $sags_type_data = Http::withToken($token)->get($sags_type_url)->json();

        $afhentning_type_endpoint = "afhentningstyper";
        $afhentning_type_url = $base_url.$afhentning_type_endpoint;
        $afhentning_type_data = Http::withToken($token)->get($afhentning_type_url)->json();

        $status_endpoint = "statuser";
        $status_url = $base_url.$status_endpoint;
        $status_data = Http::withToken($token)->get($status_url)->json();

        return view('sager.edit')
            ->with('data',$data)
            ->with('produkter',$produkt_data)
            ->with('kunder',$kunde_data)
            ->with('medarbejdere',$medarbejdere_data)
            ->with('sagstyper',$sags_type_data)
            ->with('afhentningstyper',$afhentning_type_data)
            ->with('statuser',$status_data)
            ->with('formtype','edit')
        ;
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sager/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'kunde_id' => $request->kunde_id,
                'medarbejder_id' => $request->medarbejder_id,
                'produkt_id' => $request->produkt_id,
                'afhentningstype_id' => $request->afhentningstype_id,
                'status_id' => $request->status_id,
                'sagstype_id' => $request->sagstype_id,
                'chip_id' => $request->chip_id,
                'indlevering' => $request->indlevering,
                'beskrivelse' => $request->beskrivelse,
                'status_skift' => $request->status_skift,
            ]
        );
        return redirect()->route('sager.index');

    }

    public function create(){
        $token = config('api.key');
        $base_url = config('api.url');

        $produkt_endpoint = "produkter";
        $produkt_url = $base_url.$produkt_endpoint;
        $produkt_data = Http::withToken($token)->get($produkt_url)->json();

        $kunde_endpoint = "kunder";
        $kunde_url = $base_url.$kunde_endpoint;
        $kunde_data = Http::withToken($token)->get($kunde_url)->json();

        $medarbejdere_endpoint = "medarbejdere";
        $medarbejdere_url = $base_url.$medarbejdere_endpoint;
        $medarbejdere_data = Http::withToken($token)->get($medarbejdere_url)->json();

        $sags_type_endpoint = "sagstyper";
        $sags_type_url = $base_url.$sags_type_endpoint;
        $sags_type_data = Http::withToken($token)->get($sags_type_url)->json();

        $afhentning_type_endpoint = "afhentningstyper";
        $afhentning_type_url = $base_url.$afhentning_type_endpoint;
        $afhentning_type_data = Http::withToken($token)->get($afhentning_type_url)->json();

        $status_endpoint = "statuser";
        $status_url = $base_url.$status_endpoint;
        $status_data = Http::withToken($token)->get($status_url)->json();

        return view('sager.create')
            ->with('produkter',$produkt_data)
            ->with('kunder',$kunde_data)
            ->with('medarbejdere',$medarbejdere_data)
            ->with('sagstyper',$sags_type_data)
            ->with('afhentningstyper',$afhentning_type_data)
            ->with('statuser',$status_data)
            ->with('formtype','create')
        ;
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sager";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'kunde_id' => $request->kunde_id,
                'medarbejder_id' => $request->medarbejder_id,
                'produkt_id' => $request->produkt_id,
                'afhentningstype_id' => $request->afhentningstype_id,
                'status_id' => $request->status_id,
                'sagstype_id' => $request->sagstype_id,
                'chip_id' => $request->chip_id,
                'indlevering' => $request->indlevering,
                'beskrivelse' => $request->beskrivelse,
                'status_skift' => $request->status_skift,
            ]
        );
        return redirect()->route('sager.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sager/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('sager.index');
    }

    public function mine(){
        $id = session('id');
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "medarbejdere/".$id."/sager";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();


        return view('sager.mine')
            ->with('data',$data)
            ->with('plural',"Sager")
            ->with('singular',"Sag")
        ;
    }
}
