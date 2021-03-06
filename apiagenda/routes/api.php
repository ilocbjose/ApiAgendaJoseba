<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');

Route::post('password/email', 'App\Http\Controllers\UserController@forgot');
Route::post('password/reset', 'App\Http\Controllers\UserController@reset');

Route::group(['middleware' => ['jwt.verify']], function() {
    
	Route::get('user','App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('logout','App\Http\Controllers\UserController@logout');

    Route::post('create','App\Http\Controllers\CrudController@createContact');

    Route::post('eraseContact','App\Http\Controllers\CrudController@eraseContact');
    Route::post('eraseUser', 'App\Http\Controllers\UserController@eraseUser');

    Route::get('showContact', 'App\Http\Controllers\CrudController@showContact');

    Route::post('updateContact/{id}','App\Http\Controllers\CrudController@updateContact');
    
    Route::get('search','App\Http\Controllers\SearchController@search');

});
