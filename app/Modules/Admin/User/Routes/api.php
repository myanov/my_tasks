<?php

Route::group(['prefix' => 'users', 'middleware' => []], function () {
    Route::get('/', 'Api\UserController@index')->name('api.user.index');
    Route::post('/', 'Api\UserController@store')->name('api.user.store');
    Route::get('/{user}', 'Api\UserController@show')->name('api.user.show');
    Route::put('/{user}', 'Api\UserController@update')->name('api.user.update');
    Route::delete('/{user}', 'Api\UserController@destroy')->name('api.user.delete');
});
