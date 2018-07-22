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

//Route::get('/students/{id}', 'StudentController@show');
Route::post('/login','StudentController@login');

Route::group(['middleware'=>'jwt.auth'], function(){
    Route::get('/students/{id}', 'StudentController@show');
    Route::get('/students', 'StudentController@index');

    Route::post('/students', 'StudentController@store');
    Route::put('/students/{id}', 'StudentController@update');
    Route::delete('/students/{id}', 'StudentController@delete');
});