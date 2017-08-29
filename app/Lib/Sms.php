<?php

namespace App\Lib;

use App\Lib\Core\Config;
use App\Lib\Core\Profile\DefaultProfile;
use App\Lib\Core\DefaultAcsClient;
use App\Lib\Api\SendSmsRequest;
use App\Lib\Api\QuerySendDetailsRequest;


class Sms 
{
	public function __construct($accessKeyId, $accessKeySecret)
	{	
		Config::load();
		$product = "Dysmsapi";	
		$domain = "dysmsapi.aliyuncs.com";		
		$region = "cn-hangzhou";		
		$endPointName = "cn-hangzhou";		
		$profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);	
		DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);	
		$this->acsClient = new DefaultAcsClient($profile);
	}
	public function sendSms($signName, $templateCode, $phoneNumbers, $templateParam = null, $outId = null) {
		$request = new SendSmsRequest();
		$request->setPhoneNumbers($phoneNumbers);
		$request->setSignName($signName);
		$request->setTemplateCode($templateCode);
		if($templateParam) {
			$request->setTemplateParam(json_encode($templateParam));
		}

		if($outId) {
			$request->setOutId($outId);
		}

		$acsResponse = $this->acsClient->getAcsResponse($request);
		return $acsResponse;
	
	}
	
	
	public function queryDetails($phoneNumbers, $sendDate, $pageSize = 10, $currentPage = 1, $bizId=null) {
		$request = new QuerySendDetailsRequest();
		$request->setPhoneNumber($phoneNumbers);
		$request->setBizId($bizId);
		$request->setSendDate($sendDate);
		$request->setPageSize($pageSize);
		$request->setCurrentPage($currentPage);
		$acsResponse = $this->acsClient->getAcsResponse($request);
		return $acsResponse;
	}
	
	
	
}
