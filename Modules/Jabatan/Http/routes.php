<?php

Route::group(['middleware' => 'web', 'prefix' => 'jabatan', 'namespace' => 'Modules\Jabatan\Http\Controllers'], function()
{
    Route::get('/', 'JabatanController@index');
    Route::post('/add-jabatan','JabatanController@addJabatan');
    Route::post('/deletejabatan','JabatanController@deletejabatan');
    Route::post('/updatejabatan','JabatanController@updatejabatan');
});
