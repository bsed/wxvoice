<?php

namespace common\thirdpart\wechat\getTicket;

use Yii;
use yii\web\Controller;
use backend\models\options\OptionsModel;

class Tickets extends Controller
{

	private $appid; 
	private $appsecret;
	private $ticketUrl;
	
	    public function __construct()
    {

		$model = new OptionsModel();
		$type = 'wechat';
		$find = OptionsModel::find()->where(['type' =>$type])->one();

        $site = json_decode($find['value'], true);
		$this->appid = $site["appId"];
		$this->appsecret = $site["secretKey"];
		$this->ticketUrl = "../../common/thirdpart/wechat/getTicket/";
	}
	
	public function checkInfo($code)
	{
		 $cookies = Yii::$app->request->cookies;
		 $getCookies = $cookies->getValue('wechat', 'status0');
		  if($getCookies =='status0'){
			  $getCode = $this->getCode();
		  }
		  if($code != 0){
			  $getUserInfo = $this->getUserInfo($code);
			  return $getUserInfo;
		  }
	}
	/*
	*  getToken 
	*  cache:file
	*/
	public function getToken(){

         if(file_exists($this->ticketUrl.'token.txt') && strlen(file_get_contents($this->ticketUrl.'token.txt') !=0)){
			 $file = unserialize(file_get_contents($this->ticketUrl.'token.txt'));
				 if((time() - $file['time'] ) > 70 ){ 
                    $token = $this->token();
				 }else{
				    $token = $file;
				 }
			 
		 }else{
			 $token = $this->token();
		 }
		

		
	    return  $token["access_token"];
	}
	private function token()
	{
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appsecret}";
		$array = json_decode($this->getCurl($url),true);
		$time = array('time'=>time());
		$token = array_merge($array, $time);
		file_put_contents($this->ticketUrl.'token.txt', serialize($token));
		return $token;
	}
	
	/*
	*  网页授权获取用户基本信息
	*  cache:file
	*  1、引导用户进入授权页面同意授权，获取code
	*  2、通过code换取网页授权access_token（与基础支持中的access_token不同）
	*  3、如果需要，开发者可以刷新网页授权access_token，避免过期
	*  4、通过网页授权access_token和openid获取用户基本信息（支持UnionID机制）  
	*/
	
	public function getCode()
	{
		$redirect_url = "http://app.emifo.top/paotui/index.html";
//        snsapi_userinfo    snsapi_base
		$scope = 'snsapi_userinfo';
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$redirect_url}&response_type=code&scope={$scope}&state=1#wechat_redirect";

	     return $this->redirect($url);
	}
	
	public function getUserInfo($code)
	{
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
	    $info = json_decode($this->getCurl($url),true);
		$userInfoUrl = "https://api.weixin.qq.com/sns/userinfo?access_token={$info['access_token']}&openid={$info['openid']}&lang=zh_CN";
	    $data = $this->getCurl($userInfoUrl);
		
				 $cookies = Yii::$app->response->cookies;
		         $cookies->add(new \yii\web\Cookie([
				'name' => 'wechat',
				'value' => $info['openid'],
				'expire' => time() + 10 // 设置过期时间
	        ]));
		return $data;
	}
	
	/*
	* 获取jssdk,通过access_token来获取。由于获取jsapi_ticket的api调用次数非常有限，频繁刷新jsapi_ticket会导致api调用受限，影响自身业务
	*/
  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);
    $list = "['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','hideMenuItems',
            'showMenuItems','hideAllNonBaseMenuItem','showAllNonBaseMenuItem','translateVoice','startRecord','stopRecord',
			'onRecordEnd','playVoice', 'pauseVoice','stopVoice','uploadVoice','downloadVoice','chooseImage','previewImage',
			'uploadImage','downloadImage','getNetworkType','openLocation','getLocation','hideOptionMenu','showOptionMenu',
			'closeWindow','scanQRCode','chooseWXPay','openProductSpecificView','addCard','chooseCard','openCard','openAddress'
		     ]";
    $signPackage = array(
      "appId"     => $this->appid,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string,
	  'list'      => $list,
    );
    return $signPackage; 
  }
  
  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
	  
	   if(file_exists($this->ticketUrl.'JsApiTicket.txt')){
			$data = unserialize(file_get_contents($this->ticketUrl.'JsApiTicket.txt'));
			if ( (time()-$data['time']) > 7000 ) {
			    $accessToken = $this->getToken();
			    $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
				$array = json_decode($this->getCurl($url),true);
				$time = array('time'=>time());
				$JsApiTicket = array_merge($array, $time);
				file_put_contents($this->ticketUrl.'JsApiTicket.txt', serialize($JsApiTicket));
			} else {				
			    $JsApiTicket["ticket"] = $data['ticket'];
			}
	   }else{
		   	    $accessToken = $this->getToken();
			    $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
				$array = json_decode($this->getCurl($url),true);
				$time = array('time'=>time());
				$JsApiTicket = array_merge($array, $time);				
				file_put_contents($this->ticketUrl.'JsApiTicket.txt', serialize($JsApiTicket));
	   }
		return $JsApiTicket["ticket"];
  }
	
	private function getCurl($url){
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 500);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL,$url);
        $data = curl_exec($ch);
        curl_close($ch);
		if(!$data){
			return false; 
		}
        return $data;
	}
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
} 

