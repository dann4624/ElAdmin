<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AfhentningstypeController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "afhentningstyper";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('afhentningstyper.index')
            ->with('data',$data)
            ->with('plural',"Afhentningstyper")
            ->with('singular',"Afhentningstype");
    }

    public function show($id){

    }

    public function edit($id){
        return view('afhentningstyper.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "afhentningstyper/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('afhentningstyper.index');
    }

    public function create(){
        return view('afhentningstyper.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "afhentningstyper";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('afhentningstyper.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "afhentningstyper/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('afhentningstyper.index');
    }
}
