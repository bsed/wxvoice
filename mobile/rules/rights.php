<?php

namespace mobile\rules;

use Yii;
use mobile\models\Members;
use mobile\models\Pockets;
use mobile\models\Pocketget;
use mobile\models\Articles;
use mobile\models\Concerns;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mobile\controllers\BaseController;
use common\tools\htmls;
use common\tools\Reward;
use mobile\models\Circles;
use dosamigos\qrcode\QrCode;


$member_id = Yii::$app->session['member_id'];
$feeuser = Yii::$app->session['feeuser'];
if(!$member_id){
    Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
    return $this->redirect('/members/login.html');
}
$memberInfo = Members::find()->asarray()->where(['id'=>$member_id])->one();
if(!empty($memberInfo)){
    if($memberInfo['disallowed'] == 1){
        return $this->redirect('/site/index.html');
    }
}

if(isset($_GET['circle_id'])){
    //一，判断是否是自己创建的，不是的话再判断是否是已经购买这个圈子了
    $ifCircle = Circles::find()->asarray()->where(['id'=>$_GET['circle_id']])->count();
    if(!$ifCircle){
        $circleModel = new Circlemembers();
        $circleInfo = $circleModel->find()->asarray()->where(['mid'=>$member_id,'cid'=>$_GET['circle_id']])->one();
        if(!$circleInfo){
            return $this->redirect('/circle/circle_share_detail.html?id='.$_GET['circle_id']);
        }
    }
}else{
    if(!$feeuser){
        Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
        return $this->redirect('/circle/feeuser.html');
    }
}
//END




