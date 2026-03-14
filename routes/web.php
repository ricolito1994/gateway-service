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
        Route::get('/', "GatewayController@indexIP");
        Route::get('find/{id}', "GatewayController@findIP");
        Route::put('update/{id}', "GatewayController@updateIP");
        Route::post('create' , "GatewayController@createIP");
        Route::delete('kill/{id}' , "GatewayController@killIP");
    });

    Route::group([
        "prefix" => "logs",
    ], function () {
        Route::get('find', "GatewayController@findIP");
        Route::put('update/{id}', "GatewayController@updateIP");
    });
});