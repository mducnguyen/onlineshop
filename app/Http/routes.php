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
    use Symfony\Component\HttpKernel\EventListener\RouterListener;

    Route::get('/', 'ProductController@index');
    Route::controllers(['auth' => 'Auth\AuthController', 'password' => 'Auth\PasswordController',]);
    Route::get('/product/', 'ProductController@index');
    Route::get('/product/search', 'ProductController@search');
    Route::get('/product/{id}', 'ProductController@show');
    /* Category */
    Route::resource('category', 'CategoryController');
    //learning Laravel
    Route::get('/bladeTesting', 'LearningController@showBlade');
    Route::get('/hund', 'LearningController@showHund');
    /* Admin\Product */
    Route::get('/admin/', 'Admin\ProductController@index');
    Route::get('/admin/product', 'Admin\ProductController@index');
    Route::get('/admin/product/create', 'Admin\ProductController@create');
    Route::get('/admin/product/{id}/edit', 'Admin\ProductController@edit');
    Route::post('/admin/product', 'Admin\ProductController@store');
    Route::post('/admin/product/{id}/update', 'Admin\ProductController@update');
    Route::delete('/admin/product/{id}', 'Admin\ProductController@destroy');
    Route::get('/admin/product/search', 'Admin\ProductController@search');
    /* Shopping Cart */
    Route::get('/cart/', 'CartController@index');
    Route::post('/cart/', 'CartController@add');
    Route::delete('/cart/{id}', 'CartController@destroy');
    Route::put('/cart/{id}', 'CartController@update');
    Route::get('/cart/checkout','CartController@checkout');
    Route::post('/cart/order','CartController@order');
    /* Image */
    // Route::post('/admin/product/{id}/image/', 'Admin\ProductController@addImageInput');
    // _TODO: delete method
    Route::get('/admin/image/{id}', 'Admin\ImageController@destroy');
    /* Admin\Category */
    Route::resource('/admin/category', 'Admin\CategoryController');

    /* Admin\Analytics */
    Route::get('/admin/analytics/abc', 'Admin\AnalyticController@abcAnalyse');
    Route::get('/admin/analytics/partslist', 'Admin\AnalyticController@showPartsList');
    Route::get('/admin/analytics/partslist/{id}','Admin\AnalyticController@partsListOf');

    Route::get('/hotsale/', 'AdvertisementController@index');
