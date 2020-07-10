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
	//admin
	Route::post('changePassword',['as'=>'admin.changePassword', 'uses'=>'adminController@changePassword']);
	Route::get('adminList',['as'=>'admin.adminList', 'uses'=>'adminController@adminList']);
	Route::get('adminDelete/{id}',['as'=>'admin.adminDelete', 'uses'=>'adminController@adminDelete']);
	Route::get('adminReset/{id}',['as'=>'admin.adminReset', 'uses'=>'adminController@adminReset']);
	Route::post('adminEdit/{id}',['as'=>'admin.adminEdit', 'uses'=>'adminController@adminEdit']);
	Route::post('adminTambah',['as'=>'admin.adminTambah', 'uses'=>'adminController@adminAdd']);
	//user
	Route::get('userList',['as'=>'admin.userList', 'uses'=>'adminController@userList']);
	Route::get('userDelete/{id}',['as'=>'admin.userDelete', 'uses'=>'adminController@userDelete']);
	Route::get('userReset/{id}',['as'=>'admin.userReset', 'uses'=>'adminController@userReset']);
	Route::post('userEdit/{id}',['as'=>'admin.userEdit', 'uses'=>'adminController@userEdit']);
	Route::post('userTambah',['as'=>'admin.userTambah', 'uses'=>'adminController@userAdd']);
	//logout
	Route::get('logout',['as'=>'admin.logout', 'uses'=>'adminLoginController@logout']);
	//dashboard
	Route::get('dashboard',['as'=>'admin.dashboard', 'uses'=>'adminDashboardController@index']);
	//kue
	Route::get('kueList',['as'=>'admin.kueList', 'uses'=>'kueController@kueList']);
	Route::get('kueAdd',['as'=>'admin.kueAdd', 'uses'=>'kueController@kueAdd']);
	Route::post('kueTambah',['as'=>'admin.kueTambah', 'uses'=>'kueController@tambah']);
	Route::get('kueHapus/{id}',['as'=>'admin.kueHapus', 'uses'=>'kueController@hapus']);
	Route::get('jenisList',['as'=>'admin.jenisList', 'uses'=>'kueController@jenisList']);
	Route::post('jenisEdit\{id}',['as'=>'admin.jenisEdit', 'uses'=>'kueController@jenisEdit']);
	Route::post('jenisTambah',['as'=>'admin.jenisTambah', 'uses'=>'kueController@jenisTambah']);
	//order
	Route::post('statusUpdate/{id}',['as'=>'admin.statusUpdate', 'uses'=>'orderController@statusUpdate']);
	Route::get('orderBaruList',['as'=>'admin.orderBaruList', 'uses'=>'orderController@orderBaruList']);
	Route::get('orderSelesaiList',['as'=>'admin.orderSelesaiList', 'uses'=>'orderController@orderSelesaiList']);
	Route::get('orderProsesList',['as'=>'admin.orderProsesList', 'uses'=>'orderController@orderProsesList']);
	Route::get('orderHapus/{id}',['as'=>'admin.orderHapus', 'uses'=>'orderController@orderHapus']);
});