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


Route::get('/', ['as'=>'user.home','uses'=>'userHomeController@index']);
Route::get('/kue', ['as'=>'user.kue','uses'=>'userHomeController@productIndex']);
Route::get('/keranjang', ['as'=>'user.keranjang','uses'=>'userHomeController@checkoutIndex']);

Route::get('login/admin',['as'=>'login', 'uses'=>'adminLoginController@index']);
Route::post('login/admin',['as'=>'loginCheck', 'uses'=>'adminLoginController@login']);

Route::middleware('sessionHasAdmin')->prefix('admin')->group(function () {
	//dashboard
	Route::get('dashboard',['as'=>'admin.dashboard', 'uses'=>'adminDashboardController@index']);
});