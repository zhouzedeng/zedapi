<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('oauth/token', 'AccessTokenController@generate');
Route::post('apply', 'ManagerController@store');

Route::group(['middleware' => 'auth:api'], function () {
    
    Route::group(['namespace' => 'Album'], function () {
        Route::get('albums/categories', 'AlbumCategoryController@index');
        Route::get('albums', 'AlbumController@index');
        Route::patch('albums/{_album_id}/like', 'AlbumController@like')->where('_album_id', '[0-9a-zA-Z]+');
        Route::get('albums/{_album_id}/photos', 'AlbumPhotoController@index')->where('_album_id', '[0-9a-zA-Z]+');
        Route::patch('albums/photos/{_photo_id}/like', 'AlbumPhotoController@like')->where('_photo_id', '[0-9a-zA-Z]+');
    });

    Route::group(['namespace' => 'Studio'], function () {
        Route::get('studios/categories', 'StudioCategoryController@index');
        Route::get('studios', 'StudioController@index');
        Route::get('studios/{_studio_id}/photos', 'StudioPhotoController@index')->where('_studio_id', '[0-9a-zA-Z]+');
    });

    Route::group(['namespace' => 'Clothing'], function () {
        Route::get('clothings/categories', 'ClothingCategoryController@index');
        Route::get('clothings', 'ClothingController@index');
        Route::get('clothings/{_clothing_id}/photos', 'ClothingPhotoController@index')->where('_clothing_id', '[0-9a-zA-Z]+');
        Route::get('clothings/{_clothing_id}/around', 'ClothingAroundController@index')->where('_clothing_id', '[0-9a-zA-Z]+');
    });

    Route::group(['namespace' => 'Combo'], function () {
        Route::get('combos/categories', 'ComboCategoryController@index');
        Route::get('combos', 'ComboController@index');
        Route::get('combos/{_combo_id}', 'ComboController@show')->where('_combo_id', '[0-9a-zA-Z]+');
    });

    Route::group(['namespace' => 'Product'], function () {
        Route::get('products/categories', 'ProductCategoryController@index');
        Route::get('products', 'ProductController@index');
        Route::get('products/{_product_id}', 'ProductController@show')->where('_product_id', '[0-9a-zA-Z]+');
    });

    Route::group(['namespace' => 'Order'], function () {
        Route::get('orders', 'OrderController@index');
        Route::get('orders/obligations', 'OrderController@obligations');
        Route::get('orders/pays', 'OrderController@pays');
        Route::get('orders/{_order_id}', 'OrderController@show')->where('_order_id', '[0-9a-zA-Z]+');
        Route::post('orders', 'OrderController@store');
        Route::post('orders/drafts', 'OrderController@storeDraft');
        Route::patch('orders/{_order_id}/pay', 'OrderController@pay')->where('_order_id', '[0-9a-zA-Z]+');
    });
});











