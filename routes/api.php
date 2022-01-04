<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('login', 'App\Http\Controllers\Api\AuthController@login');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('list', 'App\Http\Controllers\Api\TaskController@index');
    Route::post('store', 'App\Http\Controllers\Api\TaskController@store');
    Route::patch('update', 'App\Http\Controllers\Api\TaskController@update');
    Route::delete('delete', 'App\Http\Controllers\Api\TaskController@destroy');
});

