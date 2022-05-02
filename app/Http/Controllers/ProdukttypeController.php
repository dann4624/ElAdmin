<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProdukttypeController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "produkttyper";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('produkttyper.index')
            ->with('data',$data)
            ->with('plural',"Produkt Typer")
            ->with('singular',"Produkt Type");
    }

    public function show($id){
        return view('produkttyper.show');
    }

    public function edit($id){
        return view('produkttyper.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "produkttyper/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('produkttyper.index');
    }

    public function create(){
        return view('produkttyper.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "produkttyper";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('produkttyper.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "produkttyper/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('produkttyper.index');
    }
}
