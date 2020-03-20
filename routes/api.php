<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/oauth/token/destroy', 'Auth\TwitterController@tokenDestroy');
    Route::get('/users', 'UserController@users');
    Route::get('/user/profile/{id}', 'ProfileController@index');
    Route::post('/user/profile', 'ProfileController@create');
    Route::put('/user/profile', 'ProfileController@update');
    Route::delete('/user/profile', 'ProfileController@delete');
    Route::post('/friend/request', 'FriendController@request');
    Route::put('/friend/accept/', 'FriendController@acceptRequest');
    Route::get('/notifications', 'NotificationController@index');

});


Route::group(['middleware' => ['web']], function () {
//    Route::resource('contents', 'Api\ContentsController');
    Route::get('/auth/twitter/', 'Auth\TwitterController@getRedirectUrl');
    Route::get('/auth/twitter/callback', 'Auth\TwitterController@handleTwitterCallback');

});

