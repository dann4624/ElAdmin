<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FabrikantController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "fabrikanter";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('fabrikanter.index')
            ->with('data',$data)
            ->with('plural',"Fabrikanter")
            ->with('singular',"Fabrikant");
    }

    public function show($id){
        return view('fabrikanter.show');
    }

    public function edit($id){
        return view('fabrikanter.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "fabrikanter/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('fabrikanter.index');
    }

    public function create(){
        return view('fabrikanter.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "fabrikanter";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('fabrikanter.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "fabrikanter/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('fabrikanter.index');
    }
}
