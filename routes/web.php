<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return View('home');
});

Route::group(['prefix' => 'api'], function () {
   
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@createCompetitor');
    Route::get('get_match_day', 'MatchDayController@getMatchDay');

    Route::group(['prefix' => 'user'], function () {
        Route::get('search', 'UserController@search');
        Route::get('auth', 'UserController@getAuth');
        Route::get('logout', 'UserController@logout');
        Route::put('profile', 'UserController@updated');
    });

    Route::group(['prefix' => 'match_day'], function () {
        Route::get('search', 'MatchDayController@search');
        Route::get('edit/{id}', 'MatchDayController@edit');
        Route::post('store', 'MatchDayController@store');
        Route::put('update', 'MatchDayController@update');
        Route::delete('remove', 'MatchDayController@remove');
    });

    Route::group(['prefix' => 'response'], function () {
        Route::post('store', 'MatchResponseController@saveParticipate');
        Route::get('search', 'MatchResponseController@getResponses');
    });

});