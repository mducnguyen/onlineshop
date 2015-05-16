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

Route::get('/product_manager','ProductController@index');

Route::get('/product/add','ProductController@addView');
Route::get('/product/{id}/edit', 'ProductController@editView');

Route::post('/product/save','ProductController@add');
Route::post('/product/{id}/update', 'ProductController@update');
Route::get('/product/{id}/delete', 'ProductController@delete');

Route::get('/product/search','ProductController@search');
Route::get('/product/{id}', 'ProductController@show');

//learning Laravel
Route::get('/bladeTesting', 'LearningController@showBlade');
