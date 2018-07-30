<?php

Route::group(['middleware' => 'web', 'prefix' => 'department', 'namespace' => 'Modules\Department\Http\Controllers'], function()
{
    Route::get('/', 'DepartmentController@index');
    Route::post('/add-department', 'DepartmentController@adddepartment');
    Route::post('/deletedepartment', 'DepartmentController@deletedepartment');
    Route::post('/updatedepartment', 'DepartmentController@updatedepartment');
});
