<?php
namespace mobile\controllers;

use Yii;
use yii\web\Controller;
use EasyWeChat\Foundation\Application;

class BaseController extends Controller{

    public function actions()
    {
        if(stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
           // $this->startWx();
            $view = Yii::$app->view;
            $view->params['js'] = $this->setJs();
        }

    }

    /*
     * @网页授权，配置文件在params.php中
     * 使用了session保存访问的URL，之后获取信息后跳转到这个地址。
     */


    public function startWx(){

            $session = Yii::$app->session;
            if(!isset($_GET['code'])){
                $session->set('target_url', Yii::$app->request->getUrl());
            }
            $app = new Application(Yii::$app->params['wechat']);
            $oauth = $app->oauth;

            $getCookies = Yii::$app->request->cookies;
            $user = $getCookies->getValue('user');
            // 未登录，无相关信息
            if(empty($user)) {
                if (!isset($_GET['code'])) {
                    /*
                    * 这一步是去得到code ，换取access_token
                    * 设置cookies,证明已经授权成功，然后再将获取到的信息写入到另一个cookie中
                    */
                    $oauth->redirect()->send();
                } else {
                    $user = $app->oauth->user();
                    $user_id = $user->getId();
                    $getNickname = $user->getNickname();
                    $setCookies = Yii::$app->response->cookies;
                    $setCookies->add(new \yii\web\Cookie([
                        'name' => 'user',
                        'value' => $user["original"],
                        'expire' => time() + 3600*30,
                    ]));
                    $target_url = $session->get('target_url');
                    $login_url = '/members/login.html';
                    //新加了一个return, 有问题再去掉
                   //return $this->redirect(Yii::$app->params['wechat']['oauth']['callback'].$login_url);
                    return $this->redirect(Yii::$app->params['wechat']['oauth']['callback']);


                }
            }


        }

    /*
     * @网页分享设置，配置文件在params.php中
     * 使用了session保存访问的URL，之后获取信息后跳转到这个地址。
     */
    public function setJs(){
        $app = new Application(Yii::$app->params['wechat']);
        $js = $app->js;
        $ticket = $js->ticket();
        return $js;

    }
    /*
     * 这个单独获得token,在上面就可以获得token
     */
    public function accessToken(){
        $app = new Application(Yii::$app->params['wechat']);
        $accessToken = $app->access_token;
        $token = $accessToken->getToken();
        return $token;

    }
    /*
     *微信支付
     */
    public function wxPay(){
        $app = new Application(Yii::$app->params['wechat']);
        $payment = $app->payment;
        return $payment;
    }


}