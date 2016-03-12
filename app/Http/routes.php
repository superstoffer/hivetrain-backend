<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
});


Route::get('/trades', 'TradeController@getTrades');
Route::get('/trades/category/{cat}', 'TradeController@getTradesByCategory');
Route::post('/trade', 'TradeController@postTrade');
Route::delete('/trade/{id}', 'TradeController@deleteTrade');
Route::post('/user/{user_id}/trade/{trade_id}', 'TradeController@addUserToTrade');


Route::get('/user/{id}', 'UserController@getUserById');
Route::get('/user_performance/{id}', 'UserController@getUserPerformance');
Route::post('/user', 'UserController@postUser');
Route::post('/user_performance/{id}', 'UserController@updateUserPerformance');


Route::post('/login', 'Auth\AuthController@login');
Route::post('/logout/{id}', 'Auth\AuthController@logout');
