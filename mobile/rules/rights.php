<?php

namespace mobile\rules;

use Yii;
use mobile\models\Members;
use mobile\models\Pockets;
use mobile\models\Pocketget;
use mobile\models\Articles;
use mobile\models\Concerns;
use mobile\models\Circlemembers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mobile\controllers\BaseController;
use common\tools\htmls;
use common\tools\Reward;
use mobile\models\Circles;
use dosamigos\qrcode\QrCode;

$action = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;

$member_id = Yii::$app->session['member_id'];
$feeuser = Yii::$app->session['feeuser'];
$froms = Yii::$app->request->get('from');

if(!$member_id){
    Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
    return $this->redirect('/members/login.html');
}
$memberInfo = Members::find()->asarray()->where(['id'=>$member_id])->one();
if(!empty($memberInfo)){
    if($memberInfo['disallowed'] == 1){
        echo "<script language=javascript>alert('您已被禁言，请遵守社区规则。');location.href='/site/index.html';</script>";
    }
}

if(!empty($_GET['circle_id'])){

        $ifCircle = Circles::find()->asarray()->where(['id'=>$_GET['circle_id']])->count();
        if(!$ifCircle){
            $circleModel = new Circlemembers();
            $circleInfo = $circleModel->find()->asarray()->where(['mid'=>$member_id,'cid'=>$_GET['circle_id']])->one();
            //判断是否是从分享中出来的
            if($froms != 'singlemessage') {
                if (!$circleInfo) {
                    return $this->redirect('/circle/circle_share_detail.html?id=' . $_GET['circle_id']);
                }
            }else{
                return $this->redirect('/site/index.html');
            }
        }

}else{

    if($action =='article_detail' || $action =='qanda_detail' || $action =='circle_file_release' || $action =='article_edit' || $action =='start_ask' || $controller =='pockets'){
        //如果有是详情页就判断这个文章是否属于会员，是的话可以免费阅读
        $id = Yii::$app->request->get('id');
        if(!empty($id)){
            $info = Articles::find()->asarray()->where(['id'=>$id])->one();
            if($info['member_id'] != $member_id){
                //判断是否是从分享中出来的
                if($froms != 'singlemessage'){
                    if(!$feeuser){
                        Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
                        return $this->redirect('/circle/feeuser.html');
                    }
                }else{
                    return $this->redirect('/site/index.html');
                }

            }
        }else{

            //判断是否是从分享中出来的
            if($froms != 'singlemessage'){
                if(!$feeuser){
                    Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
                    return $this->redirect('/circle/feeuser.html');
                }
            }else{
                return $this->redirect('/site/index.html');
            }
        }



    }

}





