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

/*
 * Pages
 */
Route::group(['prefix' => '/', 'namespace' => 'Pages'], function() {
    Route::get('/', 'IndexController@index');
    Route::get('product', 'ProductController@index');
    Route::get('product/{id?}', 'ProductController@productDetail')->where(['id' => '[0-9]+']);
    Route::get('category/{id?}', 'CategoryController@index')->where(['id' => '[0-9]+']);
    Route::get('series/{id?}', 'SeriesController@index')->where(['id' => '[0-9]+']);
    Route::get('shop', function() { return view('pages.shop'); });
    Route::get('about', function() { return view('pages.about'); });
});

/*
 *
 */
Route::group(['prefix' => 'user', 'namespace' => 'User'], function() {
    Route::get('login', 'LoginController@login');
    Route::post('do_login', 'LoginController@doLogin');
    Route::get('logout', 'LoginController@logout');
});

/*
 * Dashboard
 */
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

        /* Profile */
        Route::get('profile', 'ProfileController@index');
        Route::post('profile/do_password_reset', 'ProfileController@doPasswordReset');

        /* Else */
        Route::get('else', 'ElseController@index');
        Route::post('else/do_update', 'ElseController@doUpdate');
});


/*
 * Dashboard
 */
Route::group([
    'prefix' => 'dashboard2',
    'namespace' => 'Dashboard2',
    'middleware' => ['my_auth']
],
    function() {
//        Route::get('/', 'IndexController@index');

        /* Bannner */
        Route::get('banner', 'BannerController@index');
        Route::post('banner/do_del', 'BannerController@doDelBanner');
        Route::post('banner/do_save', 'BannerController@doSaveBanner');

        /* HotNews */
        Route::get('hotnews', 'HotNewsController@index');
//        Route::post('hotnews/do_edit', 'HotNewsController@doEdit');

        /* Categroies */
        Route::get('category', 'CategoryController@index');
//        Route::post('category/do_edit', 'CategoryController@doEdit');

        /* Series */
        Route::get('series', 'SeriesController@index');
//        Route::post('series/do_edit', 'SeriesController@doEdit');

        /* Material */
        Route::get('material', 'MaterialController@index');
//        Route::post('material/do_edit', 'MaterialController@doEdit');

        /* Product */
        Route::get('product', 'ProductController@index');
        Route::get('product/new', 'ProductController@newProduct');
        Route::get('product/{id?}', 'ProductController@product')->where(['id' => '[0-9]+']);
        Route::post('product/do_save', 'ProductController@doSaveProduct');
        Route::post('product/do_del', 'ProductController@doDelProduct');
//        Route::post('product/do_edit', 'ProductController@doEdit');

        /* Authority */
//        Route::get('authority/user', 'AuthorityController@index');
//        Route::get('authority/user/edit/{id?}', 'AuthorityController@edit')->where(['id' => '[0-9]+']);
//        Route::post('authority/user/do_edit', 'AuthorityController@doEdit');

        /* Profile */
//        Route::get('profile', 'ProfileController@index');
//        Route::post('profile/do_password_reset', 'ProfileController@doPasswordReset');

        /* Else */
//        Route::get('else', 'ElseController@index');
//        Route::post('else/do_update', 'ElseController@doUpdate');
    });
