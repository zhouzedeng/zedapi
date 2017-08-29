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

    /**
     * get openid
     */
    public function getOpenid(Request $request)
    {
        $validator = validator($request->all(),
            [
                'code'=> 'required|string',
                'woniu_key'=>'required|string',
            ]
        );
        if($validator->fails())
        {
            return error('参数错误!');
        }
        $company_id = decrypt_company($request->appkey);
       
        //获取该公司的appid和appsecret
    
        $process = DB::table('little_process')->where('company_id',$company_id)->first();
        if(empty($process))
        {
            return error('appkey不合法');
        }
        
        //获取access-token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/jscode2session?appid=".$process->appid."&secret=".$process->appsecret."&js_code=".$request->code."&grant_type=authorization_code");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        if(empty($output))
        {
            return error('appid 或 appsecret 错误');
        }
        $out = json_decode($output);
		$s_id = uniqid();
        Cache::store('file')->put($s_id,$out->session_key,60*24*10);
        $data = [
        		'openid'=>$out->openid,
        		'session_id'=>$s_id
        ]; 
        return success('success',$data);
    }
    
    
    
    
    
    /**
     * 获取首页内容
     */
    public function getIndexInfo(Request $request)
    {
        $company_id = decrypt_company($request->input('appkey'));
        $albums = DB::table('albums')
        ->select('albums.id','albums.name as album_name','like','album_categories.name','cover')
        ->leftjoin('album_categories', 'album_categories.id','=','albums.category_id')
        ->whereNull('albums.deleted_at')
        ->where('company_id',$company_id)
        ->where('hot',1)
        ->get();
         
        foreach($albums as $album)
        {
            $album->id = hash_encode($album->id);
        }
        
        $combos = DB::table('combos')
        ->select('combos.id','combos.name as a_name','combo_categories.name','cover','price')
        ->leftjoin('combo_categories', 'combo_categories.id','=','combos.category_id')
        ->whereNull('combos.deleted_at')
        ->where('company_id',$company_id)
        ->where('hot',1)
        ->get();
        
        foreach($combos as $combo)
        {
            $combo->id = hash_encode($combo->id);
        }
        
        //更新活动状态
        $this->update_activity($company_id);
        $activities = DB::table('activity')
        ->select('id','cover','name','before_price','new_price','start_time','end_time','status','combo_id')
        ->where('company_id',$company_id)
        ->where('hot',1)
        ->get();
        foreach($activities as $activity)
        {
            $activity->id = hash_encode($activity->id);
            $activity->status_name = activity_status($activity->status);
            $activity->combo_id = hash_encode($activity->combo_id);
            $activity->before_price = format_price($activity->before_price);
            $activity->new_price = format_price($activity->new_price);
        }
        

        $lunbos= DB::table('app_lunbo')->select('imgurl','id','link','link_type')->where('company_id',$company_id)->where('type',1)->get();
        foreach($lunbos as $lunbo)
        {
            $lunbo->id = hash_encode($lunbo->id);
            $lunbo->link = hash_encode($lunbo->link);            
        }

        $uss = DB::table('app_abortus')->select('id','content')->where('company_id',$company_id)->get();
        foreach($uss as $us)
        {
            $us->id = hash_encode($us->id);
        }
        
        $gifts = DB::table('gift')->select('id','name','price','introduce','detail','created_at','update_at')->where('company_id',$company_id)->get();
        foreach($gifts as $gift)
        {
        	$gift->id = hash_encode($gift->id);
        }
        
        $data = ['gifts'=>$gifts,'activities'=>$activities,'albums'=>$albums,'combos'=>$combos,'runob'=>$lunbos,'us'=>$uss];       
        return success('success',$data);
   
    }
    
    
   /**
    * 
    * @param unknown $company_id
    */
    public function update_activity($company_id)
    {
    
        DB::table('activity')->where('company_id',$company_id)
        ->where('end_time', "<", date('Y-m-d H:i:s',time()))
        ->update(['status'=>2]);
    
        DB::table('activity')->where('company_id',$company_id)
        ->where('end_time', ">", date('Y-m-d H:i:s',time()))
        ->where('start_time', "<", date('Y-m-d H:i:s',time()))
        ->update(['status'=>1]);
    
    }
    /**
     * 存储C端用户信息
     * 
     */
    public function store(UserGet $request)
    {
        $inputs = $request->all();
        $company_id = decrypt_company($inputs['appkey']);
        $this->check_company($company_id);

        //插入数据
        $data = [];
        $data['company_id'] = $company_id;
        $data['phone'] = $inputs['phone'];
        $data['username'] = $inputs['username'];
        $data['sex'] = $inputs['sex'];
        $data['wx_openid'] = $inputs['openid'];
        $data['wx_headimgurl'] = $inputs['headimgurl'];
        $data['wx_nickname'] = $inputs['nickname'];
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $res = DB::table('c_users')->insert($data);
        if($res)
        {
            return success('success');
        }
        return  error('add user fail!');
    }
    
    
    /**
     * 存储C端访问游客
     *
     */
    public function visitor_store(Request $request)
    {
        $inputs = $request->all();
        validator($inputs,[
                'appkey'=>'require',
                'openid'=>'require|string',
                'headimgurl'=>'require|string',
                'nickname'=>'require|string',
                'sex'=>'require'
        ]);        
        $company_id = decrypt_company($inputs['appkey']);    
        //插入数据
        $data = [];      
        $data['sex'] = $inputs['sex'];
        $data['openid'] = $inputs['openid'];
        $data['headimgurl'] = $inputs['headimgurl'];
        $data['nickname'] = $inputs['nickname'];
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $data['update_at'] = date('Y-m-d H:i:s',time());
        $data['company_id'] = $company_id;
        
        $check = DB::table('c_visitor')->where('openid',$inputs['openid'])->first();
        if($check)
        {
        	$res = DB::table('c_visitor')->where('openid',$inputs['openid'])->update(['update_at'=>date('Y-m-d H:i:s',time())]);
        }
        else
        {
        	$res = DB::table('c_visitor')->insert($data);
        	
        }
        if($res)
        {
        	return success('success');
        }
        return  error('add user fail!');

    }

    /**
     * 通过微信openid获取用户信息
     * params: openid
     * 
     */
    public function getUsersByUnionid(UserInfoGet $request)
    {        
        $openid = $request->input('openid');
        $user = DB::table('c_users')->select(['id','username','wx_headimgurl'])->where('wx_openid',$openid)->first();
        if($user)
        {
            $userid = $user->id;
            $user->id = Hashids::encode($userid);
        }
        return success('success',$user);                
    }
    
    /**
     * 用户预约套系
     * params: userid\comboid\appkey
     */
    public function user_combo(UserComboPost $request)
    {
        $inputs = $request->all();
        //解密+检测
        $company_id = decrypt_company($inputs['appkey']);
        $check_company = $this->check_company($company_id);
        if(empty($check_company))
        {
            return error('companyid is invalid!');
        }
        
        $_comboid = $inputs['_comboid'];
        $comboid = Hashids::decode($_comboid);           
        $check_combo = $this->check_combo($comboid);
        if(empty($check_combo))
        {
            return error('comboid is invalid!');
        }
        
        
        $_userid = $inputs['_userid'];
        $userid  = Hashids::decode($_userid);
        
        //判断是否已经预约过
        $check = DB::table('c_user_combo')->where('user_id',$userid)->where('combo_id',$comboid)->first();
        if($check)
        {
            return error('您已经预约过该套系了');
        }
        
        $data = ['user_id'=>$userid[0],'combo_id'=>$comboid[0],'company_id'=>$company_id,'apply_time'=>date('Y-m-d H:i:s',time())];
        $add  = DB::table('c_user_combo')->insert($data);
        if($add)
        {
            return success('预约成功!');
        }
        return success('预约失败,服务器繁忙,请重试!');
        
    }
    

    
    /**
     * 用户取消套系预约
     * params: userid\comboid\appkey
     */
    public function cancel_user_combo(UserComboPost $request)
    {
    	$inputs = $request->all();
    	//解密+检测
    	$company_id = decrypt_company($inputs['appkey']);
    	$check_company = $this->check_company($company_id);
    	if(empty($check_company))
    	{
    		return error('companyid is invalid!');
    	}
    
    	$_comboid = $inputs['_comboid'];
    	$comboid = Hashids::decode($_comboid);
    	$check_combo = $this->check_combo($comboid);
    	if(empty($check_combo))
    	{
    		return error('comboid is invalid!');
    	}
    
    
    	$_userid = $inputs['_userid'];
    	$userid  = Hashids::decode($_userid);
    
    	//判断是否已经预约过
    	$check = DB::table('c_user_combo')->where('user_id',$userid)->where('combo_id',$comboid)->first();
    	if(empty($check))
    	{
    		return error('您还没有预约过该套系');
    	}
    
    	$data = ['user_id'=>$userid[0],'combo_id'=>$comboid[0],'company_id'=>$company_id];
    	$add  = DB::table('c_user_combo')->where($data)->delete();
    	if($add)
    	{
    		return success('取消预约成功!');
    	}
    	return success('取消预约失败,服务器繁忙,请重试!');
    
    }
    
    
    /**
     * 获取用户预约的套系列表
     * 参数:appkey,user_id
     */
    public function getUserCombos(Request $request)
    {
        $inputs = $request->all();
        validator($inputs,[
                'appkey'=>'require',
                'user_id'=>'require|string'
        ]);
        
        $company_id = decrypt_company($inputs['appkey']);
        $user_id = hash_decode($inputs['user_id']);
        $combos = DB::table('c_user_combo')       
                            ->select(['combo_id','cover','name','price','apply_time'])
                            ->leftJoin('combos', 'combos.id','=','c_user_combo.combo_id')
                            ->where(['user_id'=>$user_id,'company_id'=>$company_id])
                            ->paginate(10);
        foreach ($combos as $combo){
            $combo->created_at = date('m/d H:i:s',strtotime($combo->apply_time));
            $combo->price = ($combo->price)/100;
        	$combo->combo_id = hash_encode($combo->combo_id);
        }
   	    return success('success',$combos);
    }
    
    /**
     * 获取用户预约的活动列表
     * 参数:appkey,user_id
     */
    public function getUserActivity(Request $request)
    {
    	$inputs = $request->all();
    	validator($inputs,[
    			'appkey'=>'require',
    			'user_id'=>'require|string'
    	]);
    
    	$company_id = decrypt_company($inputs['appkey']);
    	$user_id = hash_decode($inputs['user_id']);
    	$activities = DB::table('c_user_activity')
    	->select(['activity_id','cover','name','new_price','before_price','created_at'])
    	->leftJoin('activity', 'activity.id','=','c_user_activity.activity_id')
    	->where(['user_id'=>$user_id,'c_user_activity.company_id'=>$company_id])
    	->paginate(10);
    	foreach ($activities as $activity){
    	       $activity->created_at = date('m/d H:i:s',strtotime($activity->created_at));
    		$activity->activity_id = hash_encode($activity->activity_id);
    		$activity->before_price = format_price($activity->before_price);
    		$activity->new_price = format_price($activity->new_price);
    	}
    	return success('success',$activities);
    }
    
    /**
     * 获取用户收藏列表
     * 参数:appkey,user_id
     */
    public function getUserCollet(Request $request)
    {
    	$inputs = $request->all();
    	validator($inputs,[
    			'appkey'=>'require',
    			'user_id'=>'require|string'
    	]);
    
    	$company_id = decrypt_company($inputs['appkey']);
    	$user_id = hash_decode($inputs['user_id']);
    	$collets = DB::table('c_user_collet')
    	->where('user_id',$user_id)
    	->select(['id','common_id','type','created_at'])    
    	->paginate(10);
    	foreach ($collets as $collet){
    	      if($collet->type == 2)
    	      {
    	          $combo = DB::table('combos')
    	          ->select(['name','price','cover'])
    	          ->where('id',$collet->common_id)
    	          ->first();  
    	          $collet->name = $combo->name;
    	          $collet->price = format_price($combo->price);
    	          $collet->cover = $combo->cover;
    	      }
    	      if($collet->type == 3)
    	      {
    	          $activity = DB::table('activity')
    	          ->select(['name','new_price','cover'])
    	          ->where('id',$collet->common_id)
    	          ->first();
    	          $collet->name = $activity->name;
    	          $collet->price = format_price($activity->new_price);
    	          $collet->cover = $activity->cover;
    	      }
    	    
    	      $collet->created_at = date('m/d H:i:s',strtotime($collet->created_at));
    		$collet->common_id = hash_encode($collet->common_id);
    	}
    	return success('success',$collets);
    }
    

    
    public function getCompany(Request $request){
    	$inputs = $request->all();
    	validator($inputs,[
    			'appkey'=>'required',
    	]);
    	$_company_id = $inputs['appkey'];
    	$company_id = decrypt_company($_company_id);
    	$company = DB::table('companies')
    					->select(['name','address','color','latitude','longitude','telephone'])
    					->leftJoin('little_process', 'little_process.company_id','=','companies.id')
    					->where('companies.id',$company_id)
    					->first();
    	if($company){
    		$company->color = "#".$company->color;
    	}
    	return success('success',$company);
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
