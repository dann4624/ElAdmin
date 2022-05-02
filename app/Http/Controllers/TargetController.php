<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TargetController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "targets";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('targets.index')
            ->with('data',$data)
            ->with('plural',"API Targets")
            ->with('singular',"API Target");
    }

    public function show($id){
        return view('targets.show');
    }

    public function edit($id){
        return view('targets.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "targets/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('targets.index');
    }

    public function create(){
        return view('targets.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "targets";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'navn' => $request->navn,
            ]
        );
        return redirect()->route('targets.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "targets/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('targets.index');
    }
}
