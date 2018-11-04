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

Route::get('/', function () {
	return view('welcome');
});

Route::get('home', function() {
	return view('admins.index');
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function() {
		return view('admins.index');
	});

	/*
	Action with Product
	 */
	Route::group(['prefix' => 'products'], function() {

		Route::get('', 'ProductController@index');

		Route::get('/getData', 'ProductController@getData')->name('admin.product.getData');

		Route::post('/store', 'ProductController@store')->name('admin.product.store');

		Route::get('/edit/{id}', 'ProductController@edit');

		Route::put('/update/{id}', 'ProductController@update');
	});	

	/*
	Action with Brands
	 */
	Route::group(['prefix' => 'brands'], function() {

		Route::get('', 'BrandController@index');

		Route::get('/getData', 'BrandController@getData')->name('admin.brand.getData');

		Route::post('/store', 'BrandController@store')->name('admin.brand.store');

		Route::get('/edit/{id}', 'BrandController@edit');

		Route::put('/update/{id}', 'BrandController@update');
	});
});

