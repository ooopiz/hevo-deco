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

Route::get('product/images/get', 'Dashboard\ProductController@getImg');
Route::post('product/images/upload', 'Dashboard\ProductController@uploadImg');
Route::post('product/images/delete', 'Dashboard\ProductController@deleteImg');
Route::post('product/images/resort', 'Dashboard\ProductController@resort');

Route::post('banner/do_delete', 'Dashboard\BannerController@doDelete');
Route::post('hotnews/do_delete', 'Dashboard\HotNewsController@doDelete');
Route::post('category/do_delete', 'Dashboard\CategoryController@doDelete');
Route::post('series/do_delete', 'Dashboard\SeriesController@doDelete');
Route::post('material/do_delete', 'Dashboard\MaterialController@doDelete');
Route::post('product/do_delete', 'Dashboard\ProductController@doDelete');

Route::post('get/material_list', 'Dashboard\ProductController@getMaterialList');
Route::post('add/material_list', 'Dashboard\ProductController@addMaterialList');
Route::post('material/do_delete_by_product', 'Dashboard\ProductController@doDeleteMaterial');
