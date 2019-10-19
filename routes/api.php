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

Route::group(['middleware' => ['session_api']], function () {
    Route::get('/{lang}', 'NewsApiController@home')->name("Home");
    Route::get('/{lang}/trending', 'NewsApiController@home')->name("trending");
    Route::get('/{lang}/source/{source}', 'NewsApiController@home')->name("Source");
    Route::get('/{lang}/category/{category}', 'NewsApiController@home')->name("Category");
    Route::get('/{lang}/source/{source}/category/{category}', 'NewsApiController@home')->name("Source | Category");
    Route::get('/{lang}/get-story/{id}', 'NewsApiController@getStory');
    Route::put('/select-sources/{lang}', 'NewsApiController@setSources');
    Route::post('/like-news/{id}', 'NewsApiController@likeNews');
});

