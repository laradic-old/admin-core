<?php

Route::get("/", [ 'as' => 'home', 'uses' => 'AdminController@index' ]);


// Sentinel Session Routes
Route::get('login', [ 'as' => 'sentinel.login', 'uses' => 'SessionController@create' ]);
Route::get('logout', [ 'as' => 'sentinel.logout', 'uses' => 'SessionController@destroy' ]);
Route::get('sessions/create', [ 'as' => 'sentinel.session.create', 'uses' => 'SessionController@create' ]);
Route::post('sessions/store', [ 'as' => 'sentinel.session.store', 'uses' => 'SessionController@store' ]);
Route::delete('sessions/destroy', [ 'as' => 'sentinel.session.destroy', 'uses' => 'SessionController@destroy' ]);
