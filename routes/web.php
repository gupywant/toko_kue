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
Route::get('/kue/{id}', ['as'=>'user.kue','uses'=>'userHomeController@productIndex']);

Route::post('/keranjang/{id}', ['as'=>'user.keranjang','uses'=>'userHomeController@checkoutIndex']);
Route::get('/keranjang/{id}', ['as'=>'user.keranjangGet','uses'=>'userHomeController@checkoutIndexGet']);
Route::get('/keranjang', ['as'=>'user.keranjangGET','uses'=>'userHomeController@checkoutIndexGet']);
Route::post('/keranjangOut/{id}', ['as'=>'user.keranjangOut','uses'=>'userHomeController@checkoutProses']);
Route::get('/orderUser', ['as'=>'user.orderUser','uses'=>'userHomeController@orderUser']);

Route::get('/login/user', ['as'=>'user.login','uses'=>'userLoginController@index']);
Route::get('/login/forgot', ['as'=>'user.forgot','uses'=>'userLoginController@forgot']);
Route::get('/login/register', ['as'=>'user.register','uses'=>'userLoginController@register']);
Route::post('/login/login', ['as'=>'user.loged','uses'=>'userLoginController@login']);
Route::post('/login/userRegister', ['as'=>'user.userRegister','uses'=>'userLoginController@userRegister']);
Route::post('/login/reset', ['as'=>'user.reset','uses'=>'userLoginController@reset']);
Route::get('login/logout',['as'=>'user.logout', 'uses'=>'userLoginController@logout']);

Route::get('/profile', ['as'=>'user.profile','uses'=>'userLoginController@profile']);
Route::post('/updateProfile', ['as'=>'user.updateProfile','uses'=>'userLoginController@updateProfile']);
Route::post('/passwordChange', ['as'=>'user.passwordChange','uses'=>'userLoginController@passwordChange']);

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
	Route::get('kueEdit/{id}',['as'=>'admin.kueEdit', 'uses'=>'kueController@kueEdit']);
	Route::post('kueUpdate/{id}',['as'=>'admin.kueUpdate', 'uses'=>'kueController@kueUpdate']);
	Route::post('kueTambah',['as'=>'admin.kueTambah', 'uses'=>'kueController@tambah']);
	Route::get('kueHapus/{id}',['as'=>'admin.kueHapus', 'uses'=>'kueController@hapus']);
	Route::get('gambarDelete/{id}',['as'=>'admin.gambarDelete', 'uses'=>'kueController@gambarDelete']);
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

Route::middleware('sessionHasAdmin')->prefix('admin')->group(function () {


});