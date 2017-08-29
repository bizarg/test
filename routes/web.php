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
	

	
	$_SERVER_HOST = "http://174.127.85.34:2222/CMD_PLUGINS/installatron/index.raw";
		
        $_SERVER_USER = "admin";
        $_SERVER_PASS = "FhcC3fNwjN";
        $_INSTALL_APPLICATION = "wordpress";
        $_INSTALL_WHERE = "http://domain.com/blog0001/";

        // Create the query for the Installatron Install Automation API
        $query = $_SERVER_HOST."?api=json"
            ."&cmd=install"
            ."&application=".$_INSTALL_APPLICATION
            ."&url=".urlencode($_INSTALL_WHERE)
        ;

        // Send the query using CURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".base64_encode($_SERVER_USER.":".$_SERVER_PASS) . "\n\r"));
        curl_setopt($curl, CURLOPT_URL, $query);
        $response = curl_exec($curl);

        // And we got a response. Check for errors.
        if ( $response === false )
        {
            echo ("Installatron API Error: curl_exec threw error `".curl_error($curl)."` for `$query`.");
            return;
        }
        curl_close($curl);

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

	
	
    /*function test($curl, $post, $result) {
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    $out = curl_exec($curl);
    if ($out == $result) echo "Тест ($post) пройден";
    else echo "Тест ($post) провалился!";
    echo "<br />";
  }
  $start_date = microtime(true);
  if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, 'http://domain.com/tron/install.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_POST, true);

    test($curl, "a=5&b=8", 13);
    test($curl, "a=0&b=0", 0);
    test($curl, "a=-2&b=2", 0);
    test($curl, "a=-2.5&b=7.2", 4.7);
    test($curl, "a=5", 5);

    curl_close($curl);
  }
  echo "Время выполнения всех тестов: ".(microtime(true) - $start_date)." секунды";*/
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/installatron', 'InstallatronController@install');


Route::post('generate/token', 'Auth\PublicLoginController@generate_token');
Route::any('auth', 'Auth\PublicLoginController@token_login');
Route::get('/test', 'InstallatronController@test_token');
