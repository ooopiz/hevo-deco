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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('product/images/upload', 'Dashboard2\ProductController@uploadImg');
Route::post('product/images/delete', 'Dashboard2\ProductController@deleteImg');
Route::post('product/images/resort', 'Dashboard2\ProductController@resort');

