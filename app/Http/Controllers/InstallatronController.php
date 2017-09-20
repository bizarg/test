<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class InstallatronController extends Controller
{
    public function test_token()
    {
        Artisan::call('generate:token', ['email' => 'new12@user.com', 'amhost_id' => '12', 'amhost_login' => '12']);
    }

    public function install(Request $request)
    {
//        dd($request);
        $domains = request('install.domains');
        $app = request('install.app');

        $_SERVER_HOST = "/CMD_PLUGINS/installatron/index.raw";
        $_LOGIN = "http://174.127.85.34:2222/CMD_LOGIN";
        $_SERVER_USER = "admin";
        $_SERVER_PASS = "FhcC3fNwjN";

        $ckfile = public_path().'\tmp\cookie.txt';

        $message = [];
        foreach ($domains as $i => $domain) {

             $query = $_SERVER_HOST."?api=json"
                 ."&cmd=install"
                 ."&application=".$app[$i]
                 ."&url=".urlencode($domain)
             ;

            $fields = [
                'referer' => $query,
                'username' => $_SERVER_USER,
                'password' => $_SERVER_PASS,
            ];

            $curl = curl_init($_LOGIN);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl,CURLOPT_COOKIEJAR, $ckfile);
            curl_setopt($curl,CURLOPT_COOKIEFILE, $ckfile);
            curl_setopt($curl,CURLOPT_POSTFIELDS, $fields);

            $response = curl_exec($curl);
            if ($response === false) {
                $messages[] = 'Error';
            } else {
                $response = json_decode($response);
                $messages[] = $response;
            }

            curl_close($curl);
        }

        $answer = [];

        foreach ($messages as $message) {
                $answers[] = array_diff(explode("\n", $message->message), array(''));
        }

        return view('answer', compact('answers'));

    }


}
