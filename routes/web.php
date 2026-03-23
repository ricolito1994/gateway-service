<?php

use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "api",
    "namespace" => "App\Http\Controllers",
], function () {
    Route::get('/', "GatewayController@index");
    Route::post ('/login/{test?}', "GatewayController@login");
    Route::post ('/logout/{test?}', "GatewayController@logout");
    Route::post ('/refreshtoken/{test?}', "GatewayController@refreshtoken");
    

    Route::group([
        "prefix" => "ip",
    ], function () {
        Route::get('{page?}', "GatewayController@indexIP");
        Route::get('find/{id}', "GatewayController@findIP");
        Route::patch('update/{id}/{userId}', "GatewayController@updateIP");
        Route::post('create/{userId}' , "GatewayController@createIP");
        Route::delete('delete/{id}/{userId}' , "GatewayController@deleteIP");
    });

    Route::group([
        "prefix" => "user",
    ], function () {
        Route::get('{id}', "GatewayController@findUser");
    });

    Route::group([
        "prefix" => "logs",
        "middlewaare" => 'is_super_admin'
    ], function () {
        Route::get('/', "LogsController@index");
        Route::get('find/{id}', "LogsController@find");
    });
});