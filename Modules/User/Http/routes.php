<?php

Route::group([ 'prefix' => 'api', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
	Route::get('user/product', 'UserController@user_product');
	Route::get('cancel/product', 'UserController@cancel_user_product');
	Route::get('product/list', 'UserController@getUserProduct');
	Route::get('index/list', 'UserController@getIndexInfo');
	Route::get('openid', 'UserController@getOpenid');
	Route::get('getHash/{id}', 'UserController@getHash');
	
	   
    Route::get('send/sms', 'UserController@send_sms');
    Route::get('check/code', 'UserController@check_code');    
    Route::get('company/get', 'UserController@getCompany');
    Route::get('decrypt/data', 'UserController@DeCryptWxData');
    Route::get('check/session', 'UserController@checkSession');
    
    
});
