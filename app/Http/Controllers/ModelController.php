<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ModelController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "modeller";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();

        $fabrikant_endpoint = "fabrikanter";
        $fabrikant_url = $base_url.$fabrikant_endpoint;
        $fabrikant_data = Http::withToken($token)->get($fabrikant_url)->json();

        $type_endpoint = "produkttyper";
        $type_url = $base_url.$type_endpoint;
        $type_data = Http::withToken($token)->get($type_url)->json();


        return view('modeller.index')
            ->with('data',$data)
            ->with('plural',"Modeller")
            ->with('singular',"Model")
            ->with('fabrikanter',$fabrikant_data)
            ->with('typer',$type_data)
            ;
    }

    public function show($id){
        return view('modeller.show');
    }

    public function edit($id){
        return view('modeller.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "modeller/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'navn' => $request->navn,
                'fabrikant_id' => $request->fabrikant_id,
                'type_id' => $request->type_id,
            ]
        );
        return redirect()->route('modeller.index');
    }

    public function create(){
        return view('modeller.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "modeller";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'navn' => $request->navn,
                'fabrikant_id' => $request->fabrikant_id,
                'type_id' => $request->type_id,
            ]
        );
        return redirect()->route('modeller.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "modeller/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('modeller.index');
    }
}
