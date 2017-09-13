<?php
namespace common\thirdpart\wechat\payment;

use Yii;
use yii\base\Exception;
use common\thirdpart\wechat\payment\Lib\WxPayApi;
use common\thirdpart\wechat\payment\Lib\WxPayException;
use common\thirdpart\wechat\payment\Lib\WxPayJsApiPay;
use common\thirdpart\wechat\payment\WxPayConfig;


class JsApiPay
{
	 private static  function getConfig()
    {
       return WxPayConfig::getInstance();
    }
    
	public function GetOpenid()
	{
		$apiConfig = self::getConfig();
	
	    //通过cookies获得openid
		$cookies = Yii::$app->request->cookies;
		$openid = $cookies->getValue('wechat');
		return $openid;
	}
	
	public function GetJsApiParameters($UnifiedOrderResult)
	{
		if(!array_key_exists("appid", $UnifiedOrderResult)
		|| !array_key_exists("prepay_id", $UnifiedOrderResult)
		|| $UnifiedOrderResult['prepay_id'] == "")
		{
			throw new Exception("参数错误");
		}
		$jsapi = new WxPayJsApiPay();
		$jsapi->SetAppid($UnifiedOrderResult["appid"]);
		$timeStamp = time();
		$jsapi->SetTimeStamp($timeStamp);
		$jsapi->SetNonceStr(WxPayApi::getNonceStr());
		$jsapi->SetPackage("prepay_id=" . $UnifiedOrderResult['prepay_id']);
		$jsapi->SetSignType("MD5");
		$jsapi->SetPaySign($jsapi->MakeSign());
		$parameters = json_encode($jsapi->GetValues());
		return $parameters;
	}
	
	public function GetOpenidFromMp($code,$apiConfig)
	{
		$url = $this->__CreateOauthUrlForOpenid($code,$apiConfig);
		//初始化curl
		$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, 130);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//运行curl，结果以jason形式返回
		$res = curl_exec($ch);
		curl_close($ch);
		//取出openid
		$data = json_decode($res,true);
		$openid = $data['openid'];
		return $openid;
	}
	
	private function ToUrlParams($urlObj)
	{
		$buff = "";
		foreach ($urlObj as $k => $v)
		{
			if($k != "sign"){
				$buff .= $k . "=" . $v . "&";
			}
		}
		
		$buff = trim($buff, "&");
		return $buff;
	}
	
	private function __CreateOauthUrlForCode($redirectUrl,$apiConfig)
	{	    
		$urlObj["appid"] = $apiConfig['appid'];
		$urlObj["redirect_uri"] = "$redirectUrl";
		$urlObj["response_type"] = "code";
		$urlObj["scope"] = "snsapi_base";
		$urlObj["state"] = "STATE"."#wechat_redirect";
		$bizString = $this->ToUrlParams($urlObj);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
	}
	
	private function __CreateOauthUrlForOpenid($code,$apiConfig)
	{
		$urlObj["appid"] = $apiConfig['appid'];
		$urlObj["secret"] = $apiConfig['appsecret'];
		$urlObj["code"] = $code;
		$urlObj["grant_type"] = "authorization_code";
		$bizString = $this->ToUrlParams($urlObj);
		return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
	}
	
	
	
}