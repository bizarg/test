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


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/installatron', 'InstallatronController@install');


Route::post('generate/token', 'Auth\PublicLoginController@generate_token');
Route::any('auth', 'Auth\PublicLoginController@token_login');
Route::get('/test', 'InstallatronController@test_token');
