<?php

Route::group(['middleware' => 'web', 'prefix' => 'approval', 'namespace' => 'Modules\Approval\Http\Controllers'], function()
{
    Route::get('/', 'ApprovalController@index');
});
