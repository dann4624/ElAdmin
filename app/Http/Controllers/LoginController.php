<?php

namespace App\Http\Controllers;

use http\Env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class LoginController extends Controller
{
    public function form(){
        return view('login');
    }

    public function login(Request $request){
        $token = config('api.key');
        $base_url = config('api.url');
        $endpoint = "medarbejdere/login";
        $url = $base_url.$endpoint;

        /*
        // For Debug Purposes
        echo "<b>Token : </b>".$token."<br>";
        echo "<b>Base URL : </b>".$base_url."<br>";
        echo "<b>Full URL : </b>".$url."<br>";
        echo "<br><br>";
        echo "<b>Username : </b>".$request->username."<br>";
        echo "<b>Password : </b>".$request->password."<br>";
        echo "<br><br>";
        */
        //echo $user;
         $user = Http::withToken($token)->asForm()->post($url,
            [
                'username' => $request->username,
                'password' => $request->password,
            ]
        );
        $type = "Medarbejder";
        echo "First Reason : ".$user->reason()."<br>";
        if($user->failed()){
            $endpoint = "kunder/login";
            $url = $base_url.$endpoint;
            $user = Http::withToken($token)->asForm()->post($url,
                [
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            );
            $type = "Kunde";

            if($user->failed()){

                $error = "Request Failed because : ".$user->reason();
                return redirect()->route('login.form')
                    ->withInput($request->all())
                    ->with('error',$error)
                ;
            }
        }

        session([
            'id' => $user['id'],
            'fornavn' => $user['fornavn'],
            'efternavn' => $user['efternavn'],
            'type' => $type,
        ]);
        return redirect()->route('home');

    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('login.form');
    }
}
