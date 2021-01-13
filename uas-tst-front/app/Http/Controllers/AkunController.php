<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class AkunController extends Controller
{
    public function login(Request $request)
    {
        $url_api = 'covid-log-rest-api.herokuapp.com/api/v1/login';
        $response = Http::asForm()->post($url_api, [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
        $token = $response['data']['api_token'];
        $id = $response['data']['user']['id'];
        if($response['success'])
        {
            return redirect()->route('home', ['id' => $id, 'token' => $token]);
        }
        else {
            return redirect('/')->with('error','Akun tidak tersedia');
        }
    }

    public function register(Request $request)
    {
        $url_api = 'covid-log-rest-api.herokuapp.com/api/v1/register';
        $response = Http::asForm()->post($url_api, [
            'name' => $request->get('nama'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
        if ($response['success']) {
            return redirect('/')->with('sukses','Akun berhasil dibuat, silahkan login!');
        }
    }
}
