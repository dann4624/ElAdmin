<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SagtypeController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sagstyper";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('sagstyper.index')
            ->with('data',$data)
            ->with('plural',"Sagstyper")
            ->with('singular',"Sagstype");
    }

    public function show($id){
        return view('sagstyper.show');
    }

    public function edit($id){
        return view('sagstyper.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sagstyper/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'navn' => $request->navn,
                'pris' => $request->pris,
            ]
        );
        return redirect()->route('sagstyper.index');
    }

    public function create(){
        return view('sagstyper.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sagstyper";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'navn' => $request->navn,
                'pris' => $request->pris,
            ]
        );
        return redirect()->route('sagstyper.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "sagstyper/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('sagstyper.index');
    }
}
