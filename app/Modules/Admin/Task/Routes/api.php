<?php

Route::group(['prefix' => 'tasks', 'middleware' => []], function () {
    Route::get('/', 'Api\TaskController@index')->name('api.task.index');
    Route::post('/', 'Api\TaskController@store')->name('api.task.store');
    Route::get('/{task}', 'Api\TaskController@show')->name('api.task.show');
    Route::put('/{task}', 'Api\TaskController@update')->name('api.task.update');
    Route::delete('/{task}', 'Api\TaskController@destroy')->name('api.task.delete');
});

Route::group(['prefix' => 'requirements', 'middleware' => []], function () {
    Route::get('/', 'Api\RequirementController@index')->name('api.requirement.index');
    Route::post('/', 'Api\RequirementController@store')->name('api.requirement.store');
    Route::get('/{task}', 'Api\RequirementController@show')->name('api.requirement.show');
    Route::put('/{task}', 'Api\RequirementController@update')->name('api.requirement.update');
    Route::delete('/{task}', 'Api\RequirementController@destroy')->name('api.requirement.delete');
});
