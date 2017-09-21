<?php

namespace mobile\controllers;

use Yii;
use mobile\models\Members;
use mobile\models\Experts;
use mobile\models\Circles;
use mobile\models\Wxpayrecord;
use mobile\models\Circlemembers;
use common\tools\Uploadfile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mobile\controllers\BaseController;
use common\tools\htmls;
use dosamigos\qrcode\QrCode;

use mobile\components\NoCsrf;

//微信支付
use EasyWeChat\Payment\Order;

/**
 * MembersController implements the CRUD actions for Members model.
 */
class CircleController extends BaseController
{

    public function behaviors()
    {
        return [
            'csrf' => [
                'class' => NoCsrf::className(),
                'controller' => $this,
                'actions' => [
                    'notify',
                ]
            ]
        ];
    }
    /*
     * 我的圈子
     */
    public function actionCircle_my(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $model = new Circles();
        //会员信息
        $info = Members::find()->asarray()->where(['id'=>$member_id])->with('feeuser')->one();
        //作为VIP创建的圈子个数,从circles中查找
        $count = $model->find()->asarray()->where(['member_id'=>$member_id])->count();
        //加入的圈子
        $myCircle = CircleMembers::find()->asarray()->where(['mid'=>$member_id])->with('circle','user','incircle')->all();
        //所有圈子的列表
        $creatCircle = $model->find()->asarray()->where(['member_id'=>$member_id])->with('user')->count();

        //推荐圈子，除了已经关注的其他圈子, where 不等于一个数组 In, 使用hasMany 查出有多少会员
        $filter = [];
        if($myCircle){
            foreach($myCircle as $k=>$v){
                $filter[] = $v['cid'];
            }
        }
        $recCircles = $model->find()->asarray()->with('user','incircle')->where(['not in','id',$filter])->all();
        //我创建的圈子
        $MyCreated = $model->find()->asarray()->where(['member_id'=>$member_id])->with('user','incircle')->all();

        return $this->render('circle_my',[
            'info'=>$info,
            'count'=>$count,
            'myCircle'=>$myCircle,
            'MyCreated'=>$MyCreated,
            'recCircles'=>$recCircles,
        ]);
    }
    public function actionCircle_creat(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $model = new Circles();
        //判断是否是付费会员
        $feeuser = Yii::$app->session['feeuser'];
        if(!$feeuser){
            //判断专家创建了多少圈子，普通用户
            $count = $model->find()->asarray()->where(['member_id'=>$member_id])->count();
            if(!$count){
                return $this->redirect('/circle/circle_my.html?from=index');
            }
        }

        $post = Yii::$app->request->post();
        if($post){
           $model->member_id = Yii::$app->session['member_id'];
           $model->name = $post['name'];
           $model->des = $post['summary'];
           $model->logo = $post['logo'];
           $model->feetype = $post['feeType'];
           $model->joinprice = $post['joinPrice'];
           $model->created = time();
           $model->save();
           $id = $model->id;
           if($id){
               die(json_encode(['result'=>'success','id'=>$id]));
           }
        }
        return $this->render('circle_creat');
    }
    /*
     * 上传圈子图片
     */
    public function actionUpload(){
        $uploader = new Uploadfile();
        $base = Yii::getAlias("@public");
        $directory = '/circles/';
        $path = $base.$directory;
        $img = $directory.$uploader->base64_images($_POST['file'],$path);
        $file = Yii::$app->params['public'].'/attachment';
        die(json_encode(['result'=>'success','img'=>$img,'file'=>$file]));
    }

    /*
     * 圈子信息
     */
    public function actionCircle_page(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }

        //查找会员是否在指定的圈子中
        $circleModel = new Circlemembers();
        $circleInfo = $circleModel->find()->asarray()->where(['mid'=>$member_id,'cid'=>$_GET['id']])->one();
        //如果圈子收费，未加入了圈子，不是作者自己
        $model = new Circles();
        $info = $model->find()->asarray()->with('user')->where(['id'=>$_GET['id']])->one();
        if( ($info['user']['id'] != $member_id) &&  (!$circleInfo) ){
            return $this->redirect('/circle/circle_share_detail.html?id='.$_GET['id']);
        }

        //加入圈子的人数
        $allCircleMembers = $circleModel->find()->where(['cid'=>$_GET['id']])->all();
        $nums = count($allCircleMembers);
        return $this->render('circle_page',[
            'circle_info'=>$info,
            'nums'=>$nums,
        ]);
    }
    //查询圈子是否到期
    public function actionDeadtime(){
        //判断加入圈子的类型，主要判断按年付费的是否到期
        $info =Circles::find()->asarray()->where(['id'=>$_POST['id']])->one();
        if($info['feetype'] == 1){
            $member_id = Yii::$app->session['member_id'];
            $addCircleDate = Wxpayrecord::find()->where(['mid'=>$member_id,'pay_id'=>$_POST['id']])->asarray()->one();
            $addTime = $addCircleDate['created'];
            $nowTime = time();
            if($nowTime - $addTime > 365 * 24 * 7200){
                //删除circleMembers中的记录
                $info =Circlemembers::findOne(['mid'=>$member_id,'cid'=>$_POST['id']])->delete();
                if($info){
                    die(json_encode(['result'=>'dead','msg'=>'圈子到期了，请续费']));
                }

             }
        }else{
            die(json_encode(['result'=>'notyear','msg'=>'不是按年付费']));
        }

    }
    public function actionAddcircle(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $model = new Circlemembers();
        if(!$member_id){
            return false;
        }
        $post = Yii::$app->request->post();
        $model->mid = $member_id;
        $model->cid = $post['cid'];
        $model->qid = $post['qid'];
        $model->price = $post['price'];
        $model->created = time();
        $model->save();
        die(json_encode(['status'=>'success']));
    }

    public function actionCircle_qanda_questions(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $model = new Experts();
        $info = $model->find()->asarray()->where(['member_id'=>$_GET['mid']])->with('user')->one();
        return $this->render('circle_qanda_questions',['info'=>$info,'tags'=>json_decode($info['user']['tags'], true)]);
    }
    /*
     * 查看圈子成员
     */
    public function actionCircle_members(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $circleMembers = new Circlemembers();
        $members = $circleMembers->find()->asarray()->with('user')->where(['cid'=>$_GET['id']])->all();
        return $this->render('circle_members',['members'=>$members]);
    }
    /*
     * 查看圈子成员及相关信息
     */
    public function actionCircle_data_expert(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $model = new Circles();
        $info = $model->find()->asarray()->with('user')->where(['id'=>$_GET['id']])->one();
        //圈子成员头像
        $circleMembers = new Circlemembers();
        $members = $circleMembers->find()->asarray()->with('user')->where(['cid'=>$_GET['id']])->all();
        $nums = count($members);
        //个人信息
        $userModel = new Members();
        $user = $userModel->find()->where(['id'=>$member_id])->one();
        return $this->render('circle_data_expert',[
            'info'=>$info,
            'members'=>$members,
            'user'=>$user,
            'nums'=>$nums,
            'member_id'=>$member_id,
        ]);
    }
    /*
     * 退出圈子
     */
    public function actionExitcircle(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $model = new Circlemembers();
        $info = $model->findOne(['mid'=>$member_id,'cid'=>$_POST['id']])->delete();
        die(json_encode(['result'=>'success']));
    }
    public function actionCircle_data_name_edit(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        return $this->render('circle_data_name_edit');
    }
    /*
     * 付费加入圈子，其实免费的也可以，这里调用微信
     */
    public function actionCircle_share_detail(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $model = new Circlemembers();
        $info = $model->find()->asarray()->where(['cid'=>$_GET['id'],'mid'=>$member_id])->one();
        if(($info) ){
            return $this->redirect('/circle/circle_page.html?id='.$_GET['id']);
        }
        $model = new Circles();
        $info = $model->find()->asarray()->with('user')->where(['id'=>$_GET['id']])->one();
        //圈子成员
        $circleMembers = new Circlemembers();
        $members = $circleMembers->find()->asarray()->with('user')->where(['cid'=>$_GET['id']])->all();

        return $this->render('circle_share_detail',['info'=>$info,'members'=>$members]);
    }
    public function actionCircle_file_release(){
        //判断是否是付费会员，如果不是就要求付费成为会员, 使用ajax去请求
        $member_id = Yii::$app->session['member_id'];
        $feeuser = Yii::$app->session['feeuser'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        if(!$feeuser){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/circle/feeuser.html');
        }
        //END
        //获取话题类别
        $type = htmls::getPiece('topictype');
            return $this->render('circle_file_release',['type'=>$type]);
    }
    /*
     * 成为全局的付费会员
     */
    public function actionFeeuser(){
        $member_id = Yii::$app->session['member_id'];
        $preurl = Yii::$app->session['tryinto'];
        $feeUser = htmls::site();

        return $this->render('feeuser',[
            'mid'=> $member_id,
            'preurl'=> $preurl,
            'feeUser'=> $feeUser,
        ]);
    }
    /*
     * 圈子中的问答详情
     */
    public function actionCircle_qanda_detail(){
        //判断是否登录
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        return $this->render('circle_qanda_detail');
    }
    /*
     * 微信支付相关
     */
    public function actionWxpay(){
        $title = $_POST['title'];
        $price = $_POST['price'];
        $pay_id = $_POST['pay_id'];
        //当前用户的openid
        $cookie = Yii::$app->request->cookies;
        $user = $cookie->getValue('user');
        //获取微信配置
        $payment = $this->wxPay();
        $rand = time().rand(100,999).rand(1,999);

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => $title,
            'detail'           => $title,
            'out_trade_no'     => $rand,
            'total_fee'        => $price, // 单位：分
            'notify_url'       => 'http://maibeila.emifo.top/circle/notify.html',
            'openid'           => $user['openid'],
        ];
        $order = new Order($attributes);

        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }else{
            die($result->return_code);
        }

        $config = $payment->configForJSSDKPayment($prepayId, false);
        if($config){
            //在支付记录数据库中新增数据，状态为0,回调通知成功后再变为1
            $member_id = Yii::$app->session['member_id'];
            $model = new Wxpayrecord();
            $model->mid = $member_id;
            $model->pay_id = $pay_id;
            $model->price = $price/100;
            $model->pay_type = $title;
            $model->trade = $rand;
            $model->created = time();
            $model->status = 0;
            $model->save();

        }
        die(json_encode(['result'=>'success','config'=>$config]));

    }
    /*
     * notify_url
     */
    public function actionNotify(){
        $payment = $this->wxPay();
        $response = $payment->handleNotify(function($notify, $successful){
            if($successful){
                $model = new Wxpayrecord();
                $model->updateAll(['status' => 1], "trade ={$notify['out_trade_no']}");
                return true;
            }

        });
        $response->send();

    }





}