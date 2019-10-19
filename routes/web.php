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
Route::group(['middleware' => ['session_api']], function () {
    Route::redirect('/', '/english');
    Route::get('/{lang}', 'HomeController@home')->name("Home");
    Route::get('/{lang}/sitemap.xml', 'SitemapsController@genSitemap')->name('Sitemaps');
    Route::get('/{lang}/trending', 'HomeController@home')->name("trending");
    Route::get('/{lang}/source/{source}', 'HomeController@home')->name("Source");
    Route::get('/{lang}/category/{category}', 'HomeController@home')->name("Category");
    Route::get('/{lang}/source/{source}/category/{category}', 'HomeController@home')->name("Source | Category");
    Route::get('/{lang}/news/{newsid}/{slug?}', 'HomeController@showNews')->name("News");
});


