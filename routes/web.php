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


Route::get('home', function() {
	return view('admins.index');
});

// Route::get('/updateDb', 'ProductController@updateDb');

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

		Route::delete('/delete/{id}', 'ProductController@destroy');

		Route::get('show/{id}', 'ProductController@show');
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

		Route::delete('/delete/{id}', 'BrandController@destroy');

		Route::get('/{brand_slug}', 'BrandController@listProduct');

		Route::get('/show/{brand_slug}', 'BrandController@getDataListProduct');
	});
});


Route::get('','ShopController@index');
Route::get('{product_slug}', 'ShopController@getProductDetail');

Route::group(['prefix' => 'function'], function() {
	//ADMIN
	Route::get('topsis', 'TopsisController@index');	
	Route::get('entropy', 'TopsisController@entropy')->name('entropy');
	Route::get('normalizateProduct', 'TopsisController@normalizateProduct')->name('normalizateProduct');
	//CUSTOMER
	Route::get('suggestion', 'ShopController@showSuggestPage');
});
Route::post('decisionSupport', 'TopsisController@decisionSupport');
