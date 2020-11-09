<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankIDController;

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

    

Route::post('users', 'UserController@store');
Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');
Route::get('users/{id}/orders', 'OrderController@getAllOrdersforUser');
Route::get('users/pnr/{pnr}', 'UserController@getUserbyPNR');
Route::put('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@destroy');

Route::post('orders', 'OrderController@store');
Route::get('orders', 'OrderController@index');
Route::get('orders/{id}', 'OrderController@show');
Route::get('orders/{order}/users', 'UserController@getUserforOrder');
Route::put('orders/{id}', 'OrderController@update');
Route::delete('orders/{id}', 'OrderController@destroy');

Route::get('login', 'BankIDController@bankidlogin');

Route::post('checkpnr', 'PersonnummerController@valid');
