<?php
namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use EasyWeChat\Foundation\Application;
use common\tools\Wechat;

class WxController extends Controller
{
	
	public function actionCode()
	{
       $wechat = new Wechat();
	   $wechat->getApp();
		
	}
	
	
	
}