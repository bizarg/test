<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send', function () {
    echo "<form method='post' action='/curl'>";
	echo "<input type='submit' value='send'>";
	echo "</form>";
});



Route::get('/curl', function () {

//    function getlog($ip,$username,$password,$domain) {
//        $url = 'http://'.$ip.':2222';
//
//        // set temp cookie
//        $ckfile = tempnam ("/tmp", "CURLCOOKIE");
//
//        // make list of POST fields
//        $fields = array(
//            'referer' =>urlencode('/'),
//            'username'=>urlencode($username),
//            'password'=>urlencode($password)
//        );
//        $fields_string='';
//        foreach($fields as $key=>$value) {
//            $fields_string .= $key.'='.$value.'&';
//        }
//        rtrim($fields_string,'&');
//        $ch = curl_init();
//        curl_setopt($ch,CURLOPT_COOKIEJAR, $ckfile);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch,CURLOPT_URL,$url.'/CMD_LOGIN');
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-DirectAdmin:  ".base64_encode($username.":".$password) . "\n\r"));
//        curl_setopt($ch, CURLOPT_PORT, 2222);
//        curl_setopt($ch,CURLOPT_POST,count($fields));
//        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
////        dd(get_headers($url.'/CMD_LOGIN'));
//        $result = curl_exec($ch);
//        if($result===false) {
//            die('CURL ERROR: '.curl_error($ch));
//        } else {
//            curl_setopt($ch,CURLOPT_URL,$url.'/CMD_SHOW_LOG?domain='.$domain.'&type=log');
//            curl_setopt($ch,CURLOPT_COOKIEFILE, $ckfile);
//            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//            $result = curl_exec($ch);
//            curl_close($ch);
//            if($result===false) {
//                die('CURL ERROR: '.curl_error($ch));
//            } else {
//                return $result;
//            }
//        }
//    }
//    echo getlog("174.127.85.34", "admin", "FhcC3fNwjN", "domain.com");
//
//	$_SERVER_HOST = "http://174.127.85.34:2222/CMD_PLUGINS/installatron/index.raw";
	$_SERVER_HOST = "/CMD_PLUGINS/installatron/index.raw";
	$_LOGIN = "http://174.127.85.34:2222/CMD_LOGIN";
	$REDDIT = "https://www.reddit.com/post/login";

        $_SERVER_USER = "admin";
        $_SERVER_PASS = "FhcC3fNwjN";
        $_INSTALL_APPLICATION = "newword";
        $_INSTALL_WHERE = "http://domain.com/blog9998/";

//         Create the query for the Installatron Install Automation API
        $query = $_SERVER_HOST."?api=json"
            ."&cmd=install"
            ."&application=".$_INSTALL_APPLICATION
            ."&url=".urlencode($_INSTALL_WHERE)
        ;

            $fields = array(
            'referer' => $query,
            'username' => $_SERVER_USER,
            'password' => $_SERVER_PASS,
        );

            $fields2 = [
                'op' => 'login',
                'dest' => 'https://www.reddit.com/',
                'user' => 'bizarg',
                'passwd' => '0934074302'
            ];

//        $fields_string='';
//        foreach($fields as $key=>$value) {
//            $fields_string .= $key.'='.$value.'&';
//        }
//        rtrim($fields_string,'&');

//    $data = base64_encode($_SERVER_USER.":".$_SERVER_PASS);
//    dd($data);
    if (!file_exists('tmp')) mkdir('tmp');


        $ckfile = 'C:\xampp\htdocs\installotron\installatron\public\tmp\cookie.txt';

        // Send the query using CURL
        $curl = curl_init($_LOGIN);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
//        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:53.0) Gecko/20100101 Firefox/53.0');


        curl_setopt($curl,CURLOPT_COOKIEJAR, $ckfile);
        curl_setopt($curl,CURLOPT_COOKIEFILE, $ckfile);

//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

//        curl_setopt($curl, CURLOPT_HEADER, true);
//        curl_setopt($curl, CURLOPT_PORT, 2222);

        curl_setopt($curl,CURLOPT_POSTFIELDS, $fields);
//        curl_setopt($curl,CURLOPT_POST, true);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".base64_encode($_SERVER_USER.":".$_SERVER_PASS) . "\n\r"));
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/plain'));

        $response = curl_exec($curl);

        curl_close($curl);
//        dd($response);
    echo $response;

//
        // And we got a response. Check for errors.
        if ( $response === false )
        {
            echo ("Installatron API Error: curl_exec threw error `".curl_error($curl)."` for `$query`.");
            return;
        }

        if ( strpos($response,"result") === false )
        {
            error_log("Installatron API Error: malformed response for `$query`: ".$response);
            return;
        }

        // Response looks good. Parse it.
        $response = json_decode($response, true);

        if ( $response["result"] === false )
        {
            error_log("Installatron API Error: ".$response["message"]." (query: `$query`)");
            return;
        }

        // Output the final result!
        echo $response["message"];


	
//    function test($curl, $post, $result) {
//    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
//    $out = curl_exec($curl);
//    if ($out == $result) echo "Тест ($post) пройден";
//    else echo "Тест ($post) провалился!";
//    echo "<br />";
//  }
//  $start_date = microtime(true);
//  if( $curl = curl_init() ) {
//    curl_setopt($curl, CURLOPT_URL, 'http://domain.com/tron/install.php');
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
//    curl_setopt($curl, CURLOPT_POST, true);
//
//    test($curl, "a=5&b=8", 13);
//    test($curl, "a=0&b=0", 0);
//    test($curl, "a=-2&b=2", 0);
//    test($curl, "a=-2.5&b=7.2", 4.7);
//    test($curl, "a=5", 5);
//
//    curl_close($curl);
//  }
//  echo "Время выполнения всех тестов: ".(microtime(true) - $start_date)." секунды";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/installatron', 'InstallatronController@install');


Route::post('generate/token', 'Auth\PublicLoginController@generate_token');
Route::any('auth', 'Auth\PublicLoginController@token_login');
Route::get('/test', 'InstallatronController@test_token');
