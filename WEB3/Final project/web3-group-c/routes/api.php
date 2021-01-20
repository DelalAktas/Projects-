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

//In API requests, specify the Barer Token in the header that is matching the user's api_token in the DB.
Route::group(['middleware' => 'auth:api'], function() {
    //User routes
    Route::get('user', 'ApiControllers\ApiUserController@index')->name('user.index');
    Route::delete('user/{user}', 'ApiControllers\ApiUserController@destroy')->name('user.destroy');
    Route::get('user/{user}', 'ApiControllers\ApiUserController@show')->name('user.show');
    Route::put('user/{user}', 'ApiControllers\ApiUserController@update')->name('user.update');
    
    
    Route::post('blog', 'ApiControllers\ApiBlogController@store')->name('blog.store');
    Route::put('blog/{blog}', 'ApiControllers\ApiBlogController@update')->name('blog.update'); // Dont forget to put barear token for this user 
    
});

//Blog route
Route::post('user', 'ApiControllers\ApiUserController@store')->name('user.store');
Route::get('blog', 'ApiControllers\ApiBlogController@index')->name('blog.index');
Route::get('blog/{blog}', 'ApiControllers\ApiBlogController@show')->name('blog.show');
Route::delete('blog/{blog}', 'ApiControllers\ApiBlogController@destroy')->name('blog.destroy');




