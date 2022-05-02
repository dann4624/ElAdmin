<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddresseController extends Controller
{
    public function index(){
        $id = session('id');
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder/".$id."/addresser";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->get($url)->json();

        $by_endpoint = "byer";
        $by_url = $base_url.$by_endpoint;
        $by_data = Http::withToken($token)->get($by_url)->json();

        return view('addresser.index')
            ->with('data',$data)
            ->with('plural',"Addresser")
            ->with('singular',"Addresse")
            ->with('byer',$by_data)
        ;
    }

    public function update($id,Request $request){
        $user_id = session('id');
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "addresser/".$id;
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                'vej' => $request->vej_navn,
                'vej_nummer' => $request->vej_nummer,
                'postnummer' => $request->postnummer,
            ]
        );
        return redirect()->route('addresser.index');
    }


    public function store(Request $request){
        $id = session('id');

        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder/".$id."/addresser";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->post($url,
            [
                'vej' => $request->vej_navn,
                'vej_nummer' => $request->vej_nummer,
                'postnummer' => $request->postnummer,
            ]
        );

        return redirect()->route('addresser.index');
    }

    public function destroy($id){
        $user_id = session('id');

        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "kunder/".$user_id."/addresser/".$id."/fjern";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);

        return redirect()->route('addresser.index');
    }

    public function foretrukken($id,Request $request){
        $user_id = session('id');

        $token = config('api.key');
        $base_url = config('api.url');

        $endpoint = "kunder/".$user_id."/addresser/".$id."/foretrukken";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->put($url,
            [
                //'vej_nummer' => $request->vej_nummer,
            ]
        );
        return redirect()->route('addresser.index');
    }

    public function foretrukkenFjern($id){
        $user_id = session('id');

        $token = config('api.key');
        $base_url = config('api.url');

        $endpoint = "kunder/".$user_id."/addresser/".$id."/foretrukken";
        $url = $base_url.$endpoint;
        $data = Http::withToken($token)->delete($url);
        return redirect()->route('addresser.index');
    }
}
