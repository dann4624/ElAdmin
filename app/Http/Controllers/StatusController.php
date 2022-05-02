<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StatusController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "statuser";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('statuser.index')
            ->with('data',$data)
            ->with('plural',"Statuser")
            ->with('singular',"Status");
    }

    public function show($id){
        return view('statuser.show');
    }

    public function edit($id){
        return view('statuser.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "statuser/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('statuser.index');
    }

    public function create(){
        return view('statuser.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "statuser";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'navn' => $request->navn,
            ]
        );

        return redirect()->route('statuser.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "statuser/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('statuser.index');
    }
}
