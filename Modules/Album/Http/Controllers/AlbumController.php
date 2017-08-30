<?php

namespace Modules\Album\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Model\Album;
use Hashids;
use DB;
class AlbumController extends Controller
{
	
    /**
     * 
     * @param unknown $comkey
     * @return \Illuminate\Http\Response
     */
    public function albumList($comkey) {            
    	$company_id =  hash_decode($comkey);
        $albums = DB::table('albums')
        					->select(['id', 'cover', 'name', 'photo_number'])
							->where('company_id',$company_id)
							->whereNull('deleted_at')
        					->get(20); 
           
        foreach ($albums  as $album) {
            $album->id = Hashids::encode($album->id);
        }
        return success('success',$albums);
    }  

    /**
     * 
     * @param unknown $_album_id
     * @return \Illuminate\Http\Response
     */
    public function albumPhotoList($_album_id)
    {
    	$album_id = Hashids::decode($_album_id);
    	if (!$album_id) {
    		return error('参数错误');
    	}
    	$album = DB::table('albums')->where('id', $album_id)->first();
    	if (!$album) {
    		return error('参数错误');
    	}
    	$photos = DB::table('album_photos')
    	->select(['id', 'url'])
    	->where('album_id',$album_id)
    	->whereNull('deleted_at')
    	->get();

    	foreach ($photos as $photo)
    	{
    		$photo->_photo_id  = hash_encode($photo->id);
    		$photo->url  = $photo->url;
    	}
    	return success('success', $photos);
    }
}
