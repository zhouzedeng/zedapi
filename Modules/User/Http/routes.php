<?php

Route::group([ 'prefix' => 'open', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::post('user/add', 'UserController@store');
    Route::post('visitor/add', 'UserController@visitor_store');    
    Route::get('user/get', 'UserController@getUsersByUnionid');
    
    Route::get('user/combo', 'UserController@user_combo'); 
    Route::get('cancel/combo', 'UserController@cancel_user_combo');
    
    Route::get('index/list', 'UserController@getIndexInfo');
    Route::get('merchant/qrcode', 'UserController@getLittleProQrcode');
    Route::get('openid', 'UserController@getOpenid');
    
    
    Route::get('accesstoken', 'UserController@get_access_token');
    Route::get('qrcode', 'UserController@get_qrcode');    
    Route::get('user/combolist', 'UserController@getUserCombos');
    
    Route::get('user/activitylist', 'UserController@getUserActivity'); 
    
    Route::get('cancel/activity', 'UserController@cancel_user_activity');
    Route::get('user/activity', 'UserController@user_activity');
    
    Route::post('user/gift', 'UserController@user_gift');
    
    Route::get('user/colletlist', 'UserController@getUserCollet');    
    Route::post('cancel/collet', 'UserController@cancel_user_collet');
    Route::post('user/collet', 'UserController@user_collet');
    
    Route::get('send/sms', 'UserController@send_sms');
    Route::get('check/code', 'UserController@check_code');
    
    Route::get('company/get', 'UserController@getCompany');

    Route::get('decrypt/data', 'UserController@DeCryptWxData');
    Route::get('check/session', 'UserController@checkSession');
    
    
});
