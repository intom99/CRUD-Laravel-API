<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('v1/articles', 'api\v1\ArticlesController@index');
Route::post('v1/articles/store', 'api\v1\ArticlesController@store');
Route::get('v1/articles/{id}', 'api\v1\ArticlesController@show');
Route::post('v1/articles/update', 'api\v1\ArticlesController@update');
Route::delete('v1/articles/{id}', 'api\v1\ArticlesController@destroy');
