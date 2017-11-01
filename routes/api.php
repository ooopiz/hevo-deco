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

Route::get('product/images/get', 'DashBoard\ProductController@getImg');
Route::post('product/images/upload', 'DashBoard\ProductController@uploadImg');

Route::post('banner/do_delete', 'DashBoard\BannerController@doDelete');
Route::post('hotnews/do_delete', 'DashBoard\HotNewsController@doDelete');
Route::post('category/do_delete', 'DashBoard\CategoryController@doDelete');
Route::post('series/do_delete', 'DashBoard\SeriesController@doDelete');
Route::post('material/do_delete', 'DashBoard\MaterialController@doDelete');
Route::post('product/do_delete', 'DashBoard\ProductController@doDelete');
