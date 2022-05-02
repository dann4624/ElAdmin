<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TokenController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "tokens";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();

        $target_endpoint = "targets";
        $target_url = $base_url.$target_endpoint;
        $target_data = Http::withToken($token)->get($target_url)->json();


        return view('tokens.index')
            ->with('data',$data)
            ->with('plural',"API Tokens")
            ->with('singular',"API Token")
            ->with('targets',$target_data)
            ;
    }

    public function show($id){
        return view('tokens.show');
    }

    public function edit($id){
        return view('tokens.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "tokens/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'token' => $request->token,
                'target_id' => $request->target_id,
            ]
        );
        return redirect()->route('tokens.index');
    }

    public function create(){
        return view('tokens.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "tokens";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'token' => $request->token,
                'target_id' => $request->target_id,
            ]
        );
        return redirect()->route('tokens.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "tokens/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('tokens.index');
    }
}
