<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function home($id, $token)
    {
        $data['token'] = $token;
        $data['id'] = $id;
        if ($token != null && strlen($token) == 56 && $id != null) {
            return view('home', $data);
        }
        else {
            return redirect('/')->with('error','Anda harus login');
        }
    }

    public function log($id, $token)
    {
        $url_api = 'covid-log-rest-api.herokuapp.com/api/v1/symptoms';
        $get_gejala = Http::get($url_api);
        $data['gejala'] = $get_gejala['data'];
        $data['token'] = $token;
        $data['id'] = $id;
        return view('log', $data);
    }

    public function logPost($token, Request $request)
    {
        $url_api = 'covid-log-rest-api.herokuapp.com/api/v1/log?api_token='.$token;
        $response = Http::asForm()->post($url_api, [
            'user_id' => $request->get('user_id'),
            'symptom_id' => $request->get('symptom_id'),
            'temperature' => floatval($request->get('temperature')),
            'is_traveling' => $request->get('is_traveling'),
            'traveling_history' => $request->get('traveling_history'),
            'log_date' => $request->get('log_date'),
        ]);
        $data['log_id'] = $response['data']['id'];
        $data['tanggal'] = $request->get('log_date');
        $data['token'] = $token;
        $data['is_traveling'] = $request->get('is_traveling');
        $data['id'] = $request->get('user_id');
        return view('log-alert', $data);

    }

    public function logHistory($id, $token)
    {
        $url_api = 'covid-log-rest-api.herokuapp.com/api/v1/log/history/'.$id.'?api_token='. $token;
        $response = Http::get($url_api);
        $data['history'] = $response['data'];
        $data['token'] = $token;
        $data['id'] = $id;
        return view('riwayat',$data);
    }

    public function suggestion($logid, $token, Request $request)
    {
        $url_api = 'covid-log-rest-api.herokuapp.com/api/v1/log/suggestion/'.$logid.'?api_token='.$token;
        $response = Http::get($url_api);
        $data['is_traveling'] = $request->get('is_traveling');
        $data['saran'] = $response['data'];
        return view('saran',$data);
    }

    public function logEdit($logId, Request $request)
    {
        $api_token = $request->get('api_token');
        $user_id = $request->get('user_id');
        
        $url_api_log = 'covid-log-rest-api.herokuapp.com/api/v1/log/history-detail/'.$logId.'?api_token='.$api_token;
        $response_log = Http::get($url_api_log);
        
        $url_api_gejala = 'covid-log-rest-api.herokuapp.com/api/v1/symptoms';
        $response_get_gejala = Http::get($url_api_gejala);

        $data['log'] = $response_log['data'];
        $data['gejala'] = $response_get_gejala['data'];
        $data['token'] = $api_token;
        $data['log_id'] = $logId;
        $data['user_id'] = $user_id;
        return view('log-edit',$data);
    }

    public function logUpdate($logId, Request $request)
    {
        $api_token = $request->get('api_token');
        $user_id = $request->get('user_id');

        $url_api = 'covid-log-rest-api.herokuapp.com/api/v1/log/update/'.$logId.'?api_token='.$api_token;
        $response = Http::asForm()->put($url_api, [
            'symptom_id' => $request->get('symptom_id'),
            'temperature' => floatval($request->get('temperature')),
            'is_traveling' => $request->get('is_traveling'),
            'traveling_history' => $request->get('traveling_history'),
            'log_date' => $request->get('log_date'),
        ]);
        return redirect()->route('log-history',['id'=> $user_id, 'token'=> $api_token]);
    }
}
