<?php

use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "api",
    "namespace" => "App\Http\Controllers",
], function () {
    Route::get('/', "GatewayController@index");
    Route::post ('/login', "GatewayController@login");
    Route::post ('/refreshtoken', "GatewayController@refreshtoken");
    

    Route::group([
        "prefix" => "ip",
    ], function () {
        Route::get('{page?}', "GatewayController@indexIP");
        Route::get('find/{id}', "GatewayController@findIP");
        Route::put('update/{id}/{userId}', "GatewayController@updateIP");
        Route::post('create/{userId}' , "GatewayController@createIP");
        Route::delete('delete/{id}/{userId}' , "GatewayController@deleteIP");
    });

    Route::group([
        "prefix" => "logs",
        "middlewaare" => 'is_super_admin'
    ], function () {
        Route::get('/', "LogsController@index");
        Route::get('find/{id}', "LogsController@find");
    });
});