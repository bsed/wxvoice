<?php

namespace payments\wechat;

use yii;
use EasyWeChat\Foundation\Application;

class Wechat
{
	public function __construct(){
		$options = Yii::$app->params['wechat'];
		self::$app = new Application($options);
    }
	public function getApp(){
        return self::$app;
    }
	
	public function getIsWechat()
	{
		return strpos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") !== false;
	}
	

	
	
	
	
	
	
	
	
}