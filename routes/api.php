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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('login', 'build_apis@login')->name('login');
Route::post('register', 'build_apis@register');

//https://github.com/anil-sidhu/laravel-passport-poc

Route::group(['middleware' => 'auth:api'], function(){
Route::post('insert', 'build_apis@insert');
Route::put('update', 'build_apis@update');
Route::delete('destroy', 'build_apis@destroy');
Route::post('details', 'build_apis@details');

});


Route::get('list', 'build_apis@list');

// Route::middleware('auth:api')->get('/insert', function (Request $request) {
//         return 'everthing good';
//      });