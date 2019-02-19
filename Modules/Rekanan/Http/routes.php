<?php

Route::group(['middleware' => 'web', 'prefix' => 'rekanan', 'namespace' => 'Modules\Rekanan\Http\Controllers'], function()
{
    Route::get('/all', 'RekananController@index');
    Route::get('/add','RekananController@create');
    Route::get('/detail','RekananController@show');
    Route::post('/ceknpwp','RekananController@ceknpwp');
    Route::post('/store','RekananController@store');
    Route::post('/update','RekananController@update');

    Route::post('/spesifikasi-add','RekananController@spesifikasi');
    Route::post('/spesifikasi-delete','RekananController@deletespesifikasi');

    Route::post('/blacklist','RekananController@blacklist');

    Route::post("/user-add",'RekananController@useradd');
    Route::post("/user-update",'RekananController@userupdate');

    Route::get("/user","UserRekananController@index");
    Route::get("/user/fail",'UserRekananController@fail');
    Route::post("/user/update-rekanan",'UserRekananController@update');
    Route::get("/user/contact","UserRekananController@contact");
    Route::post("/user/updatecontact","UserRekananController@storecontact");

    Route::get("/user/cabang","UserRekananController@cabang");
    Route::post("/user/savecabang","UserRekananController@savecabang");

    Route::get("/user/price","UserRekananController@pricelist");
    Route::post("/user/uploadprice","UserRekananController@savepricelist");
    Route::get("/user/tender","UserRekananController@tender");
    Route::get("/user/tender/detail","UserRekananController@tender_detail");

    //Penawaran Pertama
    Route::get('/user/tender/penawaran-add','UserRekananController@addpenawaran');
    Route::post('/user/tender/penawaran-save','UserRekananController@savepenawaran');
    Route::get('/user/tender/penawaran-update','UserRekananController@step1');
    Route::post('/user/tender/penawaran-update1','UserRekananController@updatepenawaran1');


    //Penawaran Kedua
    Route::get('/user/tender/penawaran-step2','UserRekananController@step2');
    Route::post('/user/tender/penawaran-update2','UserRekananController@updatepenawaran2');

    //Penawaran ketiga
    Route::get('/user/tender/penawaran-step3','UserRekananController@step3');
    Route::post('/user/tender/penawaran-update3','UserRekananController@updatepenawaran3');

    Route::get('/usulan','RekananController@usulan');
    Route::post('/usulan/save','RekananController@saveusulan');

});
