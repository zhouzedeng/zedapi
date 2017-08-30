<?php

Route::group(['prefix' => 'open', 'namespace' => 'Modules\Product\Http\Controllers'], function()
{
        Route::get('products/{comkey}', 'ProductController@index');
        Route::get('products/{_product_id}', 'ProductController@show')->where('_product_id', '[0-9a-zA-Z]+');
    
});
