<?php
namespace frontend\controllers;


use Yii;
use frontend\controllers\BaseController;
use common\thirdpart\wechat\getTicket\Tickets;
use common\thirdpart\wechat\payment\JsApiPay;
use common\thirdpart\wechat\payment\Lib\WxPayUnifiedOrder;
use common\thirdpart\wechat\payment\Lib\WxPayApi;

use common\thirdpart\snoopy\snoopy;


class PaotuiController extends BaseController
{
	public $layout=false;
	
	public function actions()
	{
		$tickets = new Tickets();
		//$checkInfo = $tickets->checkInfo(Yii::$app->request->get('code', 0));
		$getJsApiTicket = $tickets->getSignPackage();
		$view = Yii::$app->getView();
        $view->params['appId'] = $getJsApiTicket['appId'];
        $view->params['nonceStr'] = $getJsApiTicket['nonceStr'];
        $view->params['timestamp'] = $getJsApiTicket['timestamp'];
        $view->params['url'] = $getJsApiTicket['url'];
        $view->params['signature'] = $getJsApiTicket['signature'];
        $view->params['list'] = $getJsApiTicket['list'];

	}
	
	public function actionIndex()
	{ 

 
		return $this->render('index');
	}
	
	public function actionBangwosong()
	{
		
        return $this->render('bangwosong');
	}

	public function actionWxpay()
	{
		$price = 0.01 * 100;
		$tools = new JsApiPay();
        $openId = $tools->GetOpenid();
        $input = new WxPayUnifiedOrder();
        $input->SetBody('测试');
        $input->SetOut_trade_no(date("YmdHis").rand(0,999));//订单号
        $input->SetTotal_fee($price);//金额
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 300));
        $input->SetNotify_url('http://www.emifo.top/paotui/bangwosong.html');//异步通知
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        try {
            $jsApiParameters = $tools->GetJsApiParameters($order);
        } catch (Exception $e) {
            throw  new NotFoundHttpException();
        }
		return $jsApiParameters;
		
	}
	
	public function actionCaiji()
	{
		$snoopy = new snoopy();
		$snoopy->fetchtext('http://www.emifo.top/news/6.html');	
  
	    echo $snoopy->results; 
		

		
	}


<script>
    //异步上传图片
$("#avatar").on("change", function () {
    var obj = document.getElementById("avatar");
    var length = obj.files.length;
    if(length != 0){
        var _csrf = '<?= Yii::$app->request->csrfToken ?>';
        var url = '<?=Url::toRoute(['paotui/api'])?>';
                        var files = $('#avatar').prop('files');
                        var data = new FormData();
                            data.append('photo', files[0]);
                            data.append('_csrf', _csrf);

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: data,
                            cache: false,
                            processData: false,
                            contentType: false
                        });

                    }
});

</script>
	
	
	
	
}