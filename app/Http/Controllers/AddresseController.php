<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddresseController extends Controller
{
    // Liste af Objekter
    public function index(){
        // Hent brugeren som er logget ind's ID
        $id = session('id');

        // Hent API Key fra ENV fil
        $token = config('api.key');

        // Hent API Base URL fra ENV fil
        $base_url = config('api.url');

        // Definer Endpoint
        $endpoint = "kunder/".$id."/addresser";

        // Definer fuld URL
        $url = $base_url.$endpoint;

        // Lav HTTP Request
        $data = Http::withToken($token)->get($url)->json();

        // Definer Endpoint 2
        $by_endpoint = "byer";

        // Definer URL 2
        $by_url = $base_url.$by_endpoint;

        // Lav HTTP Request 2
        $by_data = Http::withToken($token)->get($by_url)->json();

        // Send Data til View
        return view('addresser.index')
            ->with('data',$data)
            ->with('plural',"Addresser")
            ->with('singular',"Addresse")
            ->with('byer',$by_data)
        ;
    }

    public function update($id,Request $request){
        // Hent brugeren som er logget ind's ID
        $id = session('id');

        // Hent API Key fra ENV fil
        $token = config('api.key');

        // Hent API Base URL fra ENV fil
        $base_url = config('api.url');

        // Definer Endpoint
        $endpoint = "addresser/".$id;

        // Definer Fuld URL
        $url = $base_url.$endpoint;

        // Lav HTTP Request
        $data = Http::withToken($token)->put($url,
            [
                'vej' => $request->vej_navn,
                'vej_nummer' => $request->vej_nummer,
                'postnummer' => $request->postnummer,
            ]
        );

        // Redirect til View
        return redirect()->route('addresser.index');
    }


    public function store(Request $request){
        // Hent brugeren som er logget ind's ID
        $id = session('id');

        // Hent API Key fra ENV fil
        $token = config('api.key');

        // Hent API Base URL fra ENV fil
        $base_url = config('api.url');

        // Definer Endpoint
        $endpoint = "kunder/".$id."/addresser";

        // Definer Fuld URL
        $url = $base_url.$endpoint;

        // Lav HTTP Request
        $data = Http::withToken($token)->post($url,
            [
                'vej' => $request->vej_navn,
                'vej_nummer' => $request->vej_nummer,
                'postnummer' => $request->postnummer,
            ]
        );

        // Redirect til View
        return redirect()->route('addresser.index');
    }

    public function destroy($id){
        // Hent brugeren som er logget ind's ID
        $user_id = session('id');

        // Hent API Key fra ENV fil
        $token = config('api.key');

        // Hent API Base URL fra ENV fil
        $base_url = config('api.url');

        // Definer Endpoint
        $endpoint = "kunder/".$user_id."/addresser/".$id."/fjern";

        // Definer Fuld URL
        $url = $base_url.$endpoint;

        // Lav HTTP Request
        $data = Http::withToken($token)->delete($url);

        // Redirect til View
        return redirect()->route('addresser.index');
    }

    public function foretrukken($id,Request $request){
        // Hent brugeren som er logget ind's ID
        $user_id = session('id');

        // Hent API Key fra ENV fil
        $token = config('api.key');

        // Hent API Base URL fra ENV fil
        $base_url = config('api.url');

        // Definer Endpoint
        $endpoint = "kunder/".$user_id."/addresser/".$id."/foretrukken";

        // Definer Fuld URL
        $url = $base_url.$endpoint;

        // Lav HTTP Request
        $data = Http::withToken($token)->put($url,
            [
                //'vej_nummer' => $request->vej_nummer,
            ]
        );

        // Redirect til View
        return redirect()->route('addresser.index');
    }

    public function foretrukkenFjern($id){
        // Hent brugeren som er logget ind's ID
        $user_id = session('id');

        // Hent API Key fra ENV fil
        $token = config('api.key');

        // Hent API Base URL fra ENV fil
        $base_url = config('api.url');

        // Definer Endpoint
        $endpoint = "kunder/".$user_id."/addresser/".$id."/foretrukken";

        // Definer Fuld URL
        $url = $base_url.$endpoint;

        // Lav HTTP Request
        $data = Http::withToken($token)->delete($url);

        // Redirect til View
        return redirect()->route('addresser.index');
    }
}
