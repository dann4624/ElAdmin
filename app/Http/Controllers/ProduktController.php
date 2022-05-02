<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProduktController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "produkter";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();

        $model_endpoint = "modeller";
        $model_url = $base_url.$model_endpoint;
        $modeller = Http::withToken($token)->get($model_url)->json();

        return view('produkter.index')
            ->with('data',$data)
            ->with('plural',"Produkter")
            ->with('singular',"Produkt")
            ->with('modeller',$modeller);
    }

    public function show($id){
        return view('produkter.show');
    }

    public function edit($id){
        return view('produkter.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "produkter/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'navn' => $request->navn,
                'model_id' => $request->model_id,
            ]
        );
        return redirect()->route('produkter.index');
    }

    public function create(){
        return view('produkter.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "produkter";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'navn' => $request->navn,
                'model_id' => $request->model_id,
            ]
        );
        return redirect()->route('produkter.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "produkter/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('produkter.index');
    }
}
