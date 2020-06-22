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


// AUTH ROUTES
Route::post('/login', 'Auth\LoginController@login');
Route::post('/login/refresh', 'Auth\LoginController@refresh');
Route::middleware('auth:api')->get('/logout', 'Auth\LoginController@logout');

// // AUTHENTICATED USER
Route::middleware('auth:api')->get('user', 'User\UserController@getCurrentUser');

// ACCOUNT OPERATIONS
Route::middleware('auth:api')->prefix('/accounts')->group(function () {
    Route::middleware('permission:account.index')->get('', 'User\AccountController@index');
    Route::middleware('permission:account.show')->get('/{id}', 'User\AccountController@show');
    Route::middleware('permission:account.deposit')->post('/{id}/deposit', 'User\AccountController@deposit');
    Route::middleware('permission:account.withdraw')->post('/{id}/withdraw', 'User\AccountController@withdraw');
});
