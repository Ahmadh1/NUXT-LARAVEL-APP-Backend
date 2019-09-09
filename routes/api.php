<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');

Route::group(['prefix' => 'topics'], function() {
	// Topic Routes
    Route::post('/', 'TopicController@store');
    Route::get('/', 'TopicController@index');
    Route::get('/{topic}', 'TopicController@show');
    Route::patch('/{topic}', 'TopicController@update');
    Route::delete('/{topic}', 'TopicController@destroy');

    // Post Route
    Route::group(['prefix' => '/{topic}/posts'], function() {
        Route::post('/', 'PostController@store');
        Route::get('/{post}', 'PostController@show');
        Route::patch('/{post}', 'PostController@update');
        Route::delete('/{post}', 'PostController@destroy');
        // Likes
   Route::group(['prefix' => '/{post}/likes'], function () {
            Route::post('/', 'LikeController@store');
        });
    });
    
});