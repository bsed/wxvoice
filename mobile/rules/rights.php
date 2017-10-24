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
//var_dump($action);
//exit();
$member_id = Yii::$app->session['member_id'];
$feeuser = Yii::$app->session['feeuser'];
if(!$member_id){
    Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
    return $this->redirect('/members/login.html');
}
$memberInfo = Members::find()->asarray()->where(['id'=>$member_id])->one();
if(!empty($memberInfo)){
    if($memberInfo['disallowed'] == 1){
        echo "<script language=javascript>alert('您已被禁言,请联系管理员！');location.href='/site/index.html';</script>";
    }
}

if(!empty($_GET['circle_id'])){

        $ifCircle = Circles::find()->asarray()->where(['id'=>$_GET['circle_id']])->count();
        if(!$ifCircle){
            $circleModel = new Circlemembers();
            $circleInfo = $circleModel->find()->asarray()->where(['mid'=>$member_id,'cid'=>$_GET['circle_id']])->one();
            if(!$circleInfo){
                return $this->redirect('/circle/circle_share_detail.html?id='.$_GET['circle_id']);
            }
        }

}else{
    if($action =='article_detail' || $action =='circle_file_release' || $action =='article_edit' || $action =='start_ask' || $controller =='pockets'){
            if(!$feeuser){
                Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
                return $this->redirect('/circle/feeuser.html');
            }
    }

}





