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

// ----- basic crud operations --------- //

Route::post('/todo', 'ToDoController@create');

Route::get('/todo', 'ToDoController@read');

Route::get('/todo/{id}', 'ToDoController@show');

Route::put('/todo/{id}', 'ToDoController@update');

Route::delete('/todo/{id}', 'ToDoController@delete');