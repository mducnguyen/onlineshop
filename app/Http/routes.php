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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('product','ProductController@index');
Route::get('/product/save','ProductController@add');
Route::post('/product/save','ProductController@add');
Route::get('/product/add','ProductController@addView');

Route::get('/product/{id}/edit', 'ProductController@editView');
Route::post('/product/{id}/update', 'ProductController@update');

Route::get('/product/{id}/delete', 'ProductController@delete');
Route::get('/product/search','ProductController@search');