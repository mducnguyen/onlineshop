<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ProductController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::get('/product/','ProductController@index');
Route::get('/product/search','ProductController@search');
Route::get('/product/{id}', 'ProductController@show');

//learning Laravel
Route::get('/bladeTesting', 'LearningController@showBlade');


Route::get('/admin/product', 'Admin\ProductController@index');
Route::get('/admin/product/create','Admin\ProductController@create');
Route::get('/admin/product/{id}/edit', 'Admin\ProductController@edit');
Route::post('/admin/product','Admin\ProductController@store');
Route::post('/admin/product/{id}/update', 'Admin\ProductController@update');
Route::get('/admin/product/{id}/delete', 'Admin\ProductController@delete');
Route::get('/admin/product/search','Admin\ProductController@search');
