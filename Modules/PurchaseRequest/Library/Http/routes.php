<?php

Route::group(['middleware' => 'web', 'prefix' => 'library', 'namespace' => 'Modules\Library\Http\Controllers'], function()
{
    Route::get('/', 'LibraryController@index');
});
