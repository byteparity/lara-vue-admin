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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::group(['middleware' => 'jwt.auth'], function(){
	Route::get('auth/user', 'AuthController@user');
	Route::put('auth/user/{user}','AuthController@update');
	Route::post('auth/logout', 'AuthController@logout');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
	Route::get('auth/refresh', 'AuthController@refresh');
});

// App v1 API
Route::group(['prefix' => 'v1', 'middleware' => 'jwt.auth'], function () {
	Route::get('products', 'Api\v1\ProductController@index');
	Route::get('products/{product}', 'Api\v1\ProductController@show');
	Route::post('products','Api\v1\ProductController@store');
	Route::put('products/{product}','Api\v1\ProductController@update');
	Route::delete('products/{product}', 'Api\v1\ProductController@destroy');

});
