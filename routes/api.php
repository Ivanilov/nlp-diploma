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
Route::get('/users', function () {
    return factory('App\User', 10)->make();
});
Route::post('/language', 'ApiController@languageDetect');
Route::get('/article', 'ApiController@articleExtract');
Route::post('/sentiment', 'ApiController@sentiment');
Route::get('/entityExtraction', 'ApiController@entityExtraction');
Route::post('/neighbouring', 'ApiController@neighbouring');
Route::get('/summarization', 'ApiController@summarization');
Route::get('/concept', 'ApiController@concept');

