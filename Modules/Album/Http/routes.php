<?php

Route::group(['prefix' => 'api', 'namespace' => 'Modules\Album\Http\Controllers'], function()
{
    Route::get('album/{comkey}', 'AlbumController@albumList');   
    Route::get('album/photos/{_album_id}', 'AlbumController@albumPhotoList');   
});
