<?php

Route::group(['prefix' => 'roles', 'middleware' => []], function () {
    Route::get('/', 'Api\RoleController@index')->name('api.role.index');
    Route::post('/', 'Api\RoleController@store')->name('api.role.store');
    Route::get('/{role}', 'Api\RoleController@show')->name('api.role.show');
    Route::put('/{role}', 'Api\RoleController@update')->name('api.role.update');
    Route::delete('/{role}', 'Api\RoleController@destroy')->name('api.role.delete');
});

Route::group(['prefix' => 'permissions', 'middleware' => []], function () {
    Route::get('/', 'Api\PermissionController@index')->name('api.permission.index');
    Route::post('/', 'Api\PermissionController@store')->name('api.permission.store');
});
