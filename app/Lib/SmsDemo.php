<?php

ini_set("display_errors", "on");

require_once dirname(__DIR__) . '/api_sdk/vendor/autoload.php';

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

// 鍔犺浇鍖哄煙缁撶偣閰嶇疆
Config::load();

/**
 * Class SmsDemo
 *
 * @property \Aliyun\Core\DefaultAcsClient acsClient
 */
class SmsDemo
{

    /**
     * 鏋勯�犲櫒
     *
     * @param string $accessKeyId 蹇呭～锛孉ccessKeyId
     * @param string $accessKeySecret 蹇呭～锛孉ccessKeySecret
     */
    public function __construct($accessKeyId, $accessKeySecret)
    {

        // 鐭俊API浜у搧鍚�
        $product = "Dysmsapi";

        // 鐭俊API浜у搧鍩熷悕
        $domain = "dysmsapi.aliyuncs.com";

        // 鏆傛椂涓嶆敮鎸佸Region
        $region = "cn-hangzhou";

        // 鏈嶅姟缁撶偣
        $endPointName = "cn-hangzhou";

        // 鍒濆鍖栫敤鎴稰rofile瀹炰緥
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        // 澧炲姞鏈嶅姟缁撶偣
        DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

        // 鍒濆鍖朅csClient鐢ㄤ簬鍙戣捣璇锋眰
        $this->acsClient = new DefaultAcsClient($profile);
    }

    /**
     * 鍙戦�佺煭淇¤寖渚�
     *
     * @param string $signName <p>
     * 蹇呭～, 鐭俊绛惧悕锛屽簲涓ユ牸"绛惧悕鍚嶇О"濉啓锛屽弬鑰冿細<a href="https://dysms.console.aliyun.com/dysms.htm#/sign">鐭俊绛惧悕椤�</a>
     * </p>
     * @param string $templateCode <p>
     * 蹇呭～, 鐭俊妯℃澘Code锛屽簲涓ユ牸鎸�"妯℃澘CODE"濉啓, 鍙傝�冿細<a href="https://dysms.console.aliyun.com/dysms.htm#/template">鐭俊妯℃澘椤�</a>
     * (e.g. SMS_0001)
     * </p>
     * @param string $phoneNumbers 蹇呭～, 鐭俊鎺ユ敹鍙风爜 (e.g. 12345678901)
     * @param array|null $templateParam <p>
     * 閫夊～, 鍋囧妯℃澘涓瓨鍦ㄥ彉閲忛渶瑕佹浛鎹㈠垯涓哄繀濉」 (e.g. Array("code"=>"12345", "product"=>"闃块噷閫氫俊"))
     * </p>
     * @param string|null $outId [optional] 閫夊～, 鍙戦�佺煭淇℃祦姘村彿 (e.g. 1234)
     * @return stdClass
     */
    public function sendSms($signName, $templateCode, $phoneNumbers, $templateParam = null, $outId = null) {

        // 鍒濆鍖朣endSmsRequest瀹炰緥鐢ㄤ簬璁剧疆鍙戦�佺煭淇＄殑鍙傛暟
        $request = new SendSmsRequest();

        // 蹇呭～锛岃缃泬鐭俊鎺ユ敹鍙风爜
        $request->setPhoneNumbers($phoneNumbers);

        // 蹇呭～锛岃缃鍚嶅悕绉�
        $request->setSignName($signName);

        // 蹇呭～锛岃缃ā鏉緾ODE
        $request->setTemplateCode($templateCode);

        // 鍙�夛紝璁剧疆妯℃澘鍙傛暟
        if($templateParam) {
            $request->setTemplateParam(json_encode($templateParam));
        }

        // 鍙�夛紝璁剧疆娴佹按鍙�
        if($outId) {
            $request->setOutId($outId);
        }

        // 鍙戣捣璁块棶璇锋眰
        $acsResponse = $this->acsClient->getAcsResponse($request);

        // 鎵撳嵃璇锋眰缁撴灉
        // var_dump($acsResponse);

        return $acsResponse;

    }

    /**
     * 鏌ヨ鐭俊鍙戦�佹儏鍐佃寖渚�
     *
     * @param string $phoneNumbers 蹇呭～, 鐭俊鎺ユ敹鍙风爜 (e.g. 12345678901)
     * @param string $sendDate 蹇呭～锛岀煭淇″彂閫佹棩鏈燂紝鏍煎紡Ymd锛屾敮鎸佽繎30澶╄褰曟煡璇� (e.g. 20170710)
     * @param int $pageSize 蹇呭～锛屽垎椤靛ぇ灏�
     * @param int $currentPage 蹇呭～锛屽綋鍓嶉〉鐮�
     * @param string $bizId 閫夊～锛岀煭淇″彂閫佹祦姘村彿 (e.g. abc123)
     * @return stdClass
     */
    public function queryDetails($phoneNumbers, $sendDate, $pageSize = 10, $currentPage = 1, $bizId=null) {

        // 鍒濆鍖朡uerySendDetailsRequest瀹炰緥鐢ㄤ簬璁剧疆鐭俊鏌ヨ鐨勫弬鏁�
        $request = new QuerySendDetailsRequest();

        // 蹇呭～锛岀煭淇℃帴鏀跺彿鐮�
        $request->setPhoneNumber($phoneNumbers);

        // 閫夊～锛岀煭淇″彂閫佹祦姘村彿
        $request->setBizId($bizId);

        // 蹇呭～锛岀煭淇″彂閫佹棩鏈燂紝鏀寔杩�30澶╄褰曟煡璇紝鏍煎紡Ymd
        $request->setSendDate($sendDate);

        // 蹇呭～锛屽垎椤靛ぇ灏�
        $request->setPageSize($pageSize);

        // 蹇呭～锛屽綋鍓嶉〉鐮�
        $request->setCurrentPage($currentPage);

        // 鍙戣捣璁块棶璇锋眰
        $acsResponse = $this->acsClient->getAcsResponse($request);

        // 鎵撳嵃璇锋眰缁撴灉
        // var_dump($acsResponse);

        return $acsResponse;
    }

}

// 璋冪敤绀轰緥锛�

header('Content-Type: text/plain; charset=utf-8');

$demo = new SmsDemo(
    "yourAccessKeyId",
    "yourAccessKeySecret"
);

echo "SmsDemo::sendSms\n";
$response = $demo->sendSms(
    "鐭俊绛惧悕", // 鐭俊绛惧悕
    "SMS_0000001", // 鐭俊妯℃澘缂栧彿
    "12345678901", // 鐭俊鎺ユ敹鑰�
    Array(  // 鐭俊妯℃澘涓瓧娈电殑鍊�
        "code"=>"12345",
        "product"=>"dsd"
    ),
    "123"
);
print_r($response);

echo "SmsDemo::queryDetails\n";
$response = $demo->queryDetails(
    "12345678901",  // phoneNumbers 鐢佃瘽鍙风爜
    "20170718", // sendDate 鍙戦�佹椂闂�
    10, // pageSize 鍒嗛〉澶у皬
    1 // currentPage 褰撳墠椤电爜
    // "abcd" // bizId 鐭俊鍙戦�佹祦姘村彿锛岄�夊～
);

print_r($response);
