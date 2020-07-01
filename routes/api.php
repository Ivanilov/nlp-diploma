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
Route::get('/language', 'TestController@languageDetect');
Route::get('/article', 'TestController@articleExtract');
Route::get('/sentiment', 'TestController@sentiment');
Route::get('/entityExtraction', 'TestController@entityExtraction');
Route::get('/neighbouring', 'TestController@neighbouring');
Route::get('/summarization', 'TestController@summarization');
Route::get('/concept', 'TestController@concept');

