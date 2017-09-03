<?php

namespace Modules\User\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\UserGet;
use Modules\User\Http\Requests\UserInfoGet;
use Modules\User\Http\Requests\UserComboPost;
use DB;
use Hashids;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Storage;
use Mockery\Tests\React_ReadableStreamInterface;
use App\Lib\Sms;
use Cache;
use App\Lib\WXBizDataCrypt;
class UserController extends Controller
{
    
    
    public function getHash($id){
        return  hash_encode($id);
    }

    /**
     * get openid
     */
    public function getOpenid(Request $request)
    {
    	$inputs = $request->all();
    	$company_id = hash_decode($inputs['comkey']);
       
        //获取appid和appsecret   
        $companies = DB::table('companies')->where('id',$company_id)->first();
        if(empty($companies))
        {
            return error('comkey error');
        }
        
        //获取access-token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/jscode2session?appid=".$companies->appid."&secret=".$companies->appsecret."&js_code=".$request->code."&grant_type=authorization_code");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        if(empty($output))
        {
            return error('appid  appsecret error');
        }
        $out = json_decode($output);
		$openid = $out->openid;

		$user = DB::table('c_users')->where('openid',$openid)->first();
        if($user)
        {
        	DB::table('c_users')->where('id',$user->id)->update(['update_at'=>date('Y-m-d H:i:s',time())]);
        	return success('success',['user_id'=>hash_encode($user->id),'phone'=>$user->phone]);
        }

        
        //插入数据
        $data = [];
        $data['company_id'] 	= $company_id;

        $data['nickname'] 		= $inputs['nickname'];
        $data['sex'] 			= $inputs['sex'];
        $data['headimg'] 			= $inputs['headimg'];
        $data['openid'] 		= $openid; 
        $data['update_at'] 		= date('Y-m-d H:i:s',time());
  
        
        $uid = DB::table('c_users')->insertGetId($data);
        if($uid > 0)
        {
        	return success('success',['user_id'=>hash_encode($uid),'phone'=>'']);
        }
        return  error('fail');

    }
    public function getCom(Request $request){
        $company_id = hash_decode($request->input('comkey'));
        $company = DB::table('companies')->select(['name','logo','address','latitude','longitude','telephone','status','notice','shop_introduce'])->where('id',$company_id)->first();
        return success('success',['company',$company]);
    }
    

    /**
     * 获取首页内容
     */
    public function updateCompany()
    {
        $companys = DB::table('companies')->whereNull('en_id')->get();
        foreach ($companys as $company){
            $en_id = hash_encode($company->id);
            DB::table('companies')->where('id',$company->id)->update(['en_id'=>$en_id]);
        }
        return success('success');
    }
    
    /**
     * 获取首页内容
     */
    public function getIndexInfo(Request $request)
    {
        $company_id = hash_decode($request->input('comkey'));

        $lunbos= DB::table('app_lunbo')->select('imgurl','id')->where('company_id',$company_id)->get();
        foreach($lunbos as $lunbo)
        {
            $lunbo->id = hash_encode($lunbo->id);           
        }
        
        $albums = DB::table('albums')
        ->select('id','name','cover')
        ->whereNull('deleted_at')
        ->where('company_id',$company_id)
        ->where('hot',1)
        ->get();
         
        foreach($albums as $album)
        {
        	$album->id = hash_encode($album->id);
        	$album->cover = env('APP_CDN').$album->cover;
        }
        
        $goods = DB::table('products')
        ->select('id','name','cover','price','unit')
        ->whereNull('deleted_at')
        ->where('company_id',$company_id)
        ->where('hot',1)
        ->get();
         
        foreach($goods as $good)
        {
        	$good->id = hash_encode($good->id);
        }

        $shops = DB::table('app_abortus')->select('id','content','shop_img')->where('company_id',$company_id)->get();
        foreach($shops as $shop)
        {
            $shop->id = hash_encode($shop->id);
        }

        $company = DB::table('companies')->select(['name','logo','address','latitude','longitude','telephone','status','notice','shop_introduce'])->where('id',$company_id)->first();

        $data = ['company'=>$company,'albums'=>$albums,'runob'=>$lunbos,'us'=>$shops,'goods'=>$goods];       
        return success('success',$data);
   
    }

    /**
     * 用户预约商品
     */
    public function user_product(UserComboPost $request)
    {
        $inputs = $request->all();

        $company_id = hash_decode($inputs['comkey']);
        $product_id = hash_decode($inputs['_product_id']);           
        $user_id    = hash_decode($inputs['_user_id']);
        
        //判断是否已经预定
        $check = DB::table('c_user_product')->where('user_id',$user_id)->where('product_id',$product_id)->first();
        if($check)
        {
            return error('您已经预约过该商品了');
        }
        
        $data = ['user_id'=>$user_id,'product_id'=>$product_id,'company_id'=>$company_id];
        $add  = DB::table('c_user_product')->insert($data);
        if($add)
        {
            return success('预定成功!');
        }
        return success('预定失败!');
        
    }
    

    /**
     * 用户绑定、修改手机
     */
    public function update_tel(Request $request)
    {
        $inputs = $request->all();
        $tel = $inputs['tel'];
        $user_id    = hash_decode($inputs['_user_id']);
        
        
        $add  = DB::table('c_users')->where('id',$user_id)->update(['phone'=>$tel]);
        if($add)
        {
            return success('绑定成功!',['status'=>0]);
        }
        return success('绑定失败!',['status'=>-1]);
    
    }
    
    /**
     * 用户取消预定
     * params: userid\comboid\appkey
     */
    public function cancel_user_product(UserComboPost $request)
    {
    	$inputs = $request->all();
    	
    	$company_id = hash_decode($inputs['comkey']);
        $product_id = hash_decode($inputs['_product_id']);           
        $user_id    = hash_decode($inputs['_user_id']);
        //判断是否已经预定
        $check = DB::table('c_user_product')->where('user_id',$user_id)->where('product_id',$product_id)->first();
    	if(empty($check))
    	{
    		return success('取消预约成功!');
    	}
    
    	$data = ['user_id'=>$user_id,'product_id'=>$product_id,'company_id'=>$company_id];
    	$add  = DB::table('c_user_product')->where($data)->delete();
    	if($add)
    	{
    		return success('取消预约成功!');
    	}
    	return success('取消预约失败');
    
    }
    
    
    /**
     * 我的预定
     * 参数:appkey,user_id
     */
    public function getUserProduct(Request $request)
    {
        $inputs = $request->all();
        validator($inputs,[
                'comkey'=>'require',
                '_user_id'=>'require'
        ]);
       
        $company_id = hash_decode($inputs['comkey']);        
        $user_id    = hash_decode($inputs['_user_id']);
        
        $products = DB::table('c_user_product')       
                            ->select(['products.id', 'cover', 'name', 'old_price','price','unit','c_user_product.status','introduce'])
                            ->leftJoin('products', 'products.id','=','c_user_product.product_id')
                            ->where(['user_id'=>$user_id,'c_user_product.company_id'=>$company_id])
                            ->orderByDesc('c_user_product.id')
                            ->get();
        foreach ($products as $product){          
        	$product->_product_id = hash_encode($product->id);
        }

   	    return success('success',$products);
    }
    
    
    /****************************功能函数****************************************************/
    /**
     * 发送短信验证码
     * get
     * params:phone
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function send_sms(Request $request)
    {
    	$validator = validator($request->all(),
    			[
    					'phone'=> 'required|string',
    			]
    	);
    	if(empty(check_phone($request->phone))){
    		return error('参数错误!');
    	}
    	if($validator->fails())
    	{
    		return error('参数错误!');
    	}
    	$sms = new Sms($this->appid, $this->appkey);
    	$code = rand(1000, 9999);
    	$rs = $sms->sendSms($this->sign_name,$this->tpl_id,$request->phone,['code'=>$code]);
    	if($rs->Code == 'OK')
    	{
    		Cache::store('file')->put($request->phone,$code,1);
    		return success('success',$rs);
    	}
    		
    	return error($rs->Code);
    
    }
    
    
    
    /**
     * 检查验证码
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function check_code(Request $request)
    {
    	$validator = validator($request->all(),
    			[
    					'phone'=> 'required|string',
    					'code'=>'required'
    			]
    	);
    	if(empty(check_phone($request->phone))){
    		return error('参数错误!');
    	}
    	if($validator->fails())
    	{
    		return error('参数错误!');
    	}
    
    
    	$code = Cache::store('file')->get($request->phone);
    	if(empty($code))
    	{
    		return error('timeout');
    	}
    
    
    	if($request->code == $code)
    	{
    		Cache::store('file')->forget($request->phone);
    		return success('success');
    	}
    		
    	return error('验证码错误');
    
    }
    
    /*
     * checkSessionKey
     */
    public function checkSession(Request $request)
    {
    	$validator = validator($request->all(),
    			[
    					'session_id'=> 'string',
    			]
    	);
    	if($validator->fails())
    	{
    		return error('参数错误!');
    	}
    	$session_key = Cache::store('file')->get($request->session_id);
    	if(!empty($session_key))
    	{
    		return success('success');
    	}
    	else
    	{
    		return error('fail');
    	}
    	 
    }
    
    /**
     * 解密数据
     */
    public function DeCryptWxData(Request $request)
    {
    	$validator = validator($request->all(),
    			[
    					'encryptedData'=> 'required',
    					'session_id'=> 'string',
    					'appkey'=>'required|string',
    					'iv'=>'required|string'
    			]
    	);
    	if($validator->fails())
    	{
    		return error('参数错误!');
    	}
    
    	$company_id = decrypt_company($request->appkey);
    	$process = DB::table('little_process')->where('company_id',$company_id)->first();
    
    	$appid = $process->appid;
    	$iv = $request->input('iv');
    
    	$session_key = Cache::store('file')->get($request->session_id);
    
    
    	$encryptedData = $request->input('encryptedData');
    
    	$pc = new WXBizDataCrypt($appid, $session_key);
    	$errCode = $pc->decryptData($encryptedData, $iv, $data );
    	if ($errCode == 0)
    	{
    		return success('success',json_decode($data));
    	}
    	else
    	{
    		return error($errCode);
    	}
    }
    

}
