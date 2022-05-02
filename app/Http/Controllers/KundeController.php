<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class KundeController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('kunder.index')
            ->with('data',$data)
            ->with('plural',"Kunder")
            ->with('singular',"Kunde");
    }

    public function show($id){
        return view('kunder.show');
    }

    public function edit($id){
        return view('kunder.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'fornavn' => $request->fornavn,
                'efternavn' => $request->efternavn,
                'email' => $request->email,
            ]
        );
        return redirect()->route('kunder.index');
    }

    public function create(){
        return view('kunder.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'fornavn' => $request->fornavn,
                'efternavn' => $request->efternavn,
                'username' => $request->username,
                'password' => $request->password,
                'email' => $request->email,
            ]
        );
        return redirect()->route('kunder.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('kunder.index');
    }

    public function navn(Request $request){
        $id = session('id');
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder/".$id."/navn";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'fornavn' => $request->fornavn,
                'efternavn' => $request->efternavn,
            ]
        );
        Session::put('fornavn', $request->fornavn);
        Session::put('efternavn', $request->efternavn);
        return redirect()->route('home');
    }

    public function password(Request $request){
        $id = session('id');
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder/".$id."/password";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'password' => $request->password,
            ]
        );

        return redirect()->route('home');
    }

    public function sager(Request $request){
        $id = session('id');
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder/".$id."/sager";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('kunder.sager')
            ->with('data',$data)
            ->with('plural',"Sager")
            ->with('singular',"Sag");
    }
}
