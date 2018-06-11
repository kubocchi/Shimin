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

#active-center routes
// List active-center
Route::post('active-centers', 'ActiveCenterController@index');
// List single active-center
Route::get('active-center/{id}', 'ActiveCenterController@show');
// Create new active-center
Route::post('active-center', 'ActiveCenterController@store');
// Update active-center
Route::put('active-center', 'ActiveCenterController@store');
// Delete active-center
Route::delete('active-center/{id}', 'ActiveCenterController@destroy');

Route::post('active-center/images/upload', 'ActiveCenterController@postImageUpload');
