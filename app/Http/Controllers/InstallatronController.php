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
//        $arr = request('install');
//        $arr = collect(request()->except('_token'));
//        $arr = collect(request()->only('install.names', 'install.versions'));



//        $_SERVER_HOST = "/CMD_PLUGINS/installatron/index.raw";
//        $_LOGIN = "http://174.127.85.34:2222/CMD_LOGIN";

//        $_SERVER_USER = "admin";
//        $_SERVER_PASS = "FhcC3fNwjN";
//        $_INSTALL_APPLICATION = "newword";
//        $_INSTALL_WHERE = "http://domain.com/blog9998/";

//         Create the query for the Installatron Install Automation API
//        $query = $_SERVER_HOST."?api=json"
//            ."&cmd=install"
//            ."&application=".$_INSTALL_APPLICATION
//            ."&url=".urlencode($_INSTALL_WHERE)
//        ;

//        $fields = array(
//            'referer' => $query,
//            'username' => $_SERVER_USER,
//            'password' => $_SERVER_PASS,
//        );

//        $ckfile = public_path().'\tmp\cookie.txt';

//        $curl = curl_init($_LOGIN);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
//        curl_setopt($curl,CURLOPT_COOKIEJAR, $ckfile);
//        curl_setopt($curl,CURLOPT_COOKIEFILE, $ckfile);
//        curl_setopt($curl,CURLOPT_POSTFIELDS, $fields);
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);


        $names = request('install.names');
        $versions = request('install.versions');

        $_SERVER_HOST = "/CMD_PLUGINS/installatron/index.raw";
        $_LOGIN = "http://174.127.85.34:2222/CMD_LOGIN";
        $_SERVER_USER = "admin";
        $_SERVER_PASS = "FhcC3fNwjN";

        $ckfile = public_path().'\tmp\cookie.txt';

        $message = [];
        foreach ($names as $i => $name) {

             $query = $_SERVER_HOST."?api=json"
                 ."&cmd=install"
                 ."&application=".$versions[$i]
                 ."&url=".urlencode($name)
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
                $message[] = 'False';
            }
            $response = json_decode($response);
            $message[$name] = $response;

            curl_close($curl);
        }

        dd($message);

    }


}
