<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InstallatronController extends Controller
{
    public function test_token()
    {
        Artisan::call('generate:token', ['email' => 'new12@user.com', 'amhost_id' => '12', 'amhost_login' => '12']);
    }

    public function install(Request $request)
    {
        $array = $request->except('_token');

        $newarray = [];
        foreach ($array['name'] as $key => $name) {
            $newarray[] = $name;
        }
    }
//        dd($request);
//        wzrcdw
//        .gShgJiCeq95


        // First, let's define some configurables.
//        $_SERVER_HOST = "http://path/to/installatron/frontend";
//        $_SERVER_HOST = "http://94.102.48.5:2222/CMD_PLUGINS/installatron";
//        $_SERVER_USER = "bizarg";
//        $_SERVER_PASS = "gYfSJHJatf";
//        $_INSTALL_APPLICATION = "wordpress";
////        $_INSTALL_WHERE = "/home/bizarg/domains/installotron2.net/public_html/";
//        $_INSTALL_WHERE = "http://www.installotron2.net/blog";
//
//        // Create the query for the Installatron Install Automation API
//        $query = $_SERVER_HOST."?api=json"
//            ."&cmd=install"
//            ."&application=".$_INSTALL_APPLICATION
//            ."&url=".urlencode($_INSTALL_WHERE)
//        ;
////        dump($query);
//        // Send the query using CURL
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//        curl_setopt($curl, CURLOPT_HEADER, 0);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".base64_encode($_SERVER_USER.":".$_SERVER_PASS) . "\n\r"));
//        curl_setopt($curl, CURLOPT_URL, $query);
//        $response = curl_exec($curl);
////        dd($response);
//        // And we got a response. Check for errors.
//        if ( $response === false )
//        {
////            dd("Installatron API Error: curl_exec threw error `".curl_error($curl)."` for `$query`.");
////            error_log("Installatron API Error: curl_exec threw error `".curl_error($curl)."` for `$query`.");
//            echo ("Installatron API Error: curl_exec threw error `".curl_error($curl)."` for `$query`.");
//            return;
//        }
//        curl_close($curl);
//
//        if ( strpos($response,"result") === false )
//        {
////            dd("Installatron API Error: malformed response for `$query`: ".$response);
//            error_log("Installatron API Error: malformed response for `$query`: ".$response);
//            return;
//        }
//
//        // Response looks good. Parse it.
//        $response = json_decode($response, true);
//
//        if ( $response["result"] === false )
//        {
////            dd("Installatron API Error: ".$response["message"]." (query: `$query`)");
//            error_log("Installatron API Error: ".$response["message"]." (query: `$query`)");
//            return;
//        }
//
//        // Output the final result!
//        echo $response["message"];



}
