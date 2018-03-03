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

Route::get('/user', function(Request $request) {
    return $request->user();
})->middleware('auth:api');

//get all items
Route::get('items/', 'ItemsController@index');
//post to add a new item
Route::post('items/', 'ItemsController@store')->middleware('auth.basic');
//get item by id
Route::get('items/{item}', 'ItemsController@show');
// update using creds
Route::patch('items/{item}', 'ItemsController@update')->middleware('auth.basic');
// get status of item
Route::get('items/{item}/status', 'ItemsController@status');
//enable item requires credentials
Route::patch('items/{item}/enable', 'ItemsController@enable')->middleware('auth.basic');
//disable item requires credentials
Route::patch('items/{item}/disable', 'ItemsController@disable')->middleware('auth.basic');

