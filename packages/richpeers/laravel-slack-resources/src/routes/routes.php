<?php

// api routes
Route::prefix('api')->group(function () {
    Route::group(['middleware' => ['api']], function () {

        Route::post('/resources', 'Api\SlackCommandController@store')->middleware('slack-resource');
    });
});
