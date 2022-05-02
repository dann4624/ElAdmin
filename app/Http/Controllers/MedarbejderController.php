<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class MedarbejderController extends Controller
{
    public function index(){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "medarbejdere";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();
        return view('medarbejdere.index')
            ->with('data',$data)
            ->with('plural',"Medarbejdere")
            ->with('singular',"Medarbejder");
    }

    public function show($id){
        return view('medarbejdere.show');
    }

    public function edit($id){
        return view('medarbejdere.edit');
    }

    public function update($id,Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "medarbejdere/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'fornavn' => $request->fornavn,
                'efternavn' => $request->efternavn
            ]
        );
        return redirect()->route('medarbejdere.index');
    }

    public function create(){
        return view('medarbejdere.create');
    }

    public function store(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "medarbejdere";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'fornavn' => $request->fornavn,
                'efternavn' => $request->efternavn,
                'username' => $request->username,
                'password' => $request->password,
            ]
        );
        return redirect()->route('medarbejdere.index');
    }

    public function destroy($id){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "medarbejdere/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('medarbejdere.index');
    }

    public function navn(Request $request){
        $id = session('id');
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "medarbejdere/".$id."/navn";
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
        $endpoint = "medarbejdere/".$id."/password";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'password' => $request->password,
            ]
        );

        return redirect()->route('home');
    }
}
