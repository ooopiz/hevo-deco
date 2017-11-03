<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/', 'namespace' => 'Pages'], function() {
    Route::get('/', 'IndexController@index');
    Route::get('product', 'ProductController@index');
    Route::get('product/{id?}', 'ProductController@productDetail')->where(['id' => '[0-9]+']);
    Route::get('category/{id?}', 'CategoryController@index')->where(['id' => '[0-9]+']);
    Route::get('series/{id?}', 'SeriesController@index')->where(['id' => '[0-9]+']);

});

Route::group(['prefix' => 'user', 'namespace' => 'User'], function() {
    Route::get('login', 'LoginController@login');
    Route::post('do_login', 'LoginController@doLogin');
    Route::get('logout', 'LoginController@logout');
});

Route::group([
        'prefix' => 'dashboard',
        'namespace' => 'Dashboard',
        'middleware' => ['my_auth']
    ],
    function() {
        Route::get('/', 'IndexController@index');

        /* Bannner */
        Route::get('banner', 'BannerController@index');
        Route::post('banner/do_edit', 'BannerController@doEdit');

        /* HotNews */
        Route::get('hotnews', 'HotNewsController@index');
        Route::post('hotnews/do_edit', 'HotNewsController@doEdit');

        /* Categroies */
        Route::get('category', 'CategoryController@index');
        Route::post('category/do_edit', 'CategoryController@doEdit');

        /* Series */
        Route::get('series', 'SeriesController@index');
        Route::post('series/do_edit', 'SeriesController@doEdit');

        /* Material */
        Route::get('material', 'MaterialController@index');
        Route::post('material/do_edit', 'MaterialController@doEdit');

        /* Product */
        Route::get('product', 'ProductController@index');
        Route::post('product/do_edit', 'ProductController@doEdit');

        /* Authority */
        Route::get('authority/user', 'AuthorityController@index');
        Route::get('authority/user/edit/{id?}', 'AuthorityController@edit')->where(['id' => '[0-9]+']);
        Route::post('authority/user/do_edit', 'AuthorityController@doEdit');
});
