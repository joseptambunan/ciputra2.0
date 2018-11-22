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


Route::post('ces-login', function() 
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
		$user = \Modules\User\Entities\User::find($user->id);
        $jabatan = $user->jabatan;
        if ( $user->id == "1"){
            $request->session()->put('level', 'superadmin');
            return redirect("user");
        }
        
        if ( $user->is_rekanan == 0 ){           

            foreach ($jabatan as $key => $value) {
                if ( $value['level'] == "10"){                    
					if(Auth::loginUsingId($user->id)){
						return redirect("/project/detail?id=".$value['project_id']);
					} else {
						return 'Sorry, but your Credentials seem to be wrong, stupid';
					}
                    
                }else{
                    // $request->session()->put('level', '');
					if(Auth::loginUsingId($user->id)){
						return redirect("/project/detail?id=".$value['project_id']);
					} else {
						return 'Sorry, but your Credentials seem to be wrong, stupid';
					}
                }
            }
        }else {
            $user_rekanan_group = UserRekanan::where("user_login",$user->user_login)->get();
            if ( count($user_rekanan_group) > 0 ){
                $users = UserRekanan::find($user_rekanan_group->first()->id);
                $rekanan_group = $users->rekanan_group;
                $request->session()->put('rekanan_id', $rekanan_group->id);
                return redirect("rekanan/user");
            }else{
                return redirect("rekanan/user/fail");
            }
        }
        
	}else{
		return redirect('https://ces-test.ciputragroup.com');
	}

});

//Route::get('/', 'PrivilegeController@index')->middleware("auth");
//Route::post('/login/validation','PrivilegeController@validation');
Route::get('/logout','PrivilegeController@destroy');
Route::post('/workorder/save-nonbudget','WorkorderController@savenonbudget');
