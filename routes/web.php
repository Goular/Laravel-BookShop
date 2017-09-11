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

//前台模块
Route::get('/','\App\Http\Controllers\IndexController@index');

//登录模块
Route::get('/login','\App\Http\Controllers\LoginController@index');