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

//Route::middleware('auth:api')->get('/getusers', 'UsersController@getUsers');

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('/getusers', 'UsersController@getUsers');
    Route::post('/user/update/name', 'UsersController@updateName');
    Route::post('/user/update/email', 'UsersController@updateEmail');

    Route::get('/getroles', 'RoleController@getRoles');
    Route::post('/role/update/name', 'RoleController@updateName');
    Route::post('/role/destroy', 'RoleController@destroy');


});
