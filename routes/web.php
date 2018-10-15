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

Auth::routes();


/*Route::post('ces-login', function() 
{
	if(!isset($_POST["user_login"]))
	{
		header('location: https://ces-test.ciputragroup.com');
	}

	$hasil = (explode("~#~",$_POST["user_login"]));
	// echo 'User ID :'.$hasil[0].'<br>';
	// echo 'Username :'.$hasil[1].'<br>';

	$user = \App\User::where('user_login', $hasil[1])->first();

	if ($user) 
	{
		\Auth::loginUsingId($user->id);

		return redirect()->route('project');
	}else{
		return redirect('https://ces-test.ciputragroup.com');
	}

});*/

Route::get('/', 'PrivilegeController@index')->middleware("auth");
Route::post('/login/validation','PrivilegeController@validation');
Route::get('/logout','PrivilegeController@destroy');
Route::post('/workorder/save-nonbudget','WorkorderController@savenonbudget');
