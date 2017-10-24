<?php

namespace mobile\controllers;

use Yii;
use mobile\models\Experts;
use mobile\models\Members;
use mobile\models\Articles;
use mobile\models\Circles;
use mobile\models\Comments;
use mobile\models\Dianzan;
use mobile\models\Concerns;
use mobile\models\Circlemembers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mobile\controllers\BaseController;
use common\tools\htmls;
use dosamigos\qrcode\QrCode;

/**
 * MembersController implements the CRUD actions for Members model.
 */
class ExpertController extends BaseController
{
    public function actions(){
        $view = Yii::$app->view;
        $view->params['site'] = htmls::site();
        $view->params['wechat'] = htmls::wechat();
        $view->params['js'] = $this->setJs();
    }
    /*
     * 查找专家
     */
   public function actionFound_expert(){
       require_once(dirname(dirname(__FILE__)).'/rules/rights.php');
       $type = htmls::getPiece('experttype');
      return $this->render('found_expert',['type'=>$type]);
   }
   /*
    * ajax请求数据
    */
   public function actionFind(){
       $model = new Experts();
       $file = Yii::$app->params['public'].'/attachment';
       $pernum = $_POST['pernum'];
       if($_POST['typeid'] == -1){
           $list = $model->find()->asarray()->with('user')->offset($_POST['start'])->limit($pernum)->all();
           $total = $model->find()->asarray()->count();
       }else{
           $list = $model->find()->asarray()->with('user')->where(['type'=>$_POST['typeid']])->offset($_POST['start'])->limit($pernum)->all();
           $total = $model->find()->asarray()->where(['type'=>$_POST['typeid']])->count();
       }

       $pages = ceil($total/$pernum);
       die(json_encode([
           'result'=>'success',
           'list'=>$list,
           'file'=>$file,
           'page'=>[
               'currentPage'=>intval($_POST['currentPage']),
               'start'=>$_POST['start'],
               'pernum'=>$pernum,
               'total'=>$total,
               'pages'=>$pages,
           ],
       ]));
   }
   /*
    * 会员主页
    */
   public function actionUser_page(){
       $model = new Experts();
       //判断是否登录
       $member_id = Yii::$app->session['member_id'];
       if(!$member_id){
           return $this->redirect('/members/login.html');
       }
       //查看是否是专家
       $info = $model->find()->asarray()->with('user')->where(['member_id'=>$_GET['id']])->one();
       $member = Members::find()->asarray()->where(['id'=>$_GET['id']])->one();
       //获取是否已经关注
       $foucs = Concerns::find()->asarray()->where(['mid'=>$member_id,'to_mid'=>$info['member_id']])->one();
       //获取粉丝的总数
       $circleMembers = new Concerns();
       $members = $circleMembers->find()->asarray()->where(['to_mid'=>$_GET['id']])->all();
       $fansNums = count($members);
       //获取关注了多少人
       $getMembers = $circleMembers->find()->asarray()->where(['mid'=>$_GET['id']])->all();
       $getNums = count($getMembers);
       //查看是否有圈子
       $circleModel = new Circles();
       $circleInfo = $circleModel->find()->where(['member_id'=>$_GET['id']])->select('id')->asarray()->one();
       if(!$member){
           return $this->redirect('/expert/found_expert.html');
       }
       if(!$info){
           $tags = [];
           $member = Members::find()->asarray()->where(['id'=>$_GET['id']])->one();
       }else{
           $member = [];
           $tags = json_decode($info['user']['tags'], true);
       }
       return $this->render('user_page',[
           'info'=>$info,
           'tags'=>$tags,
           'member'=>$member,
           'member_id'=>$member_id,
           'foucs'=>$foucs,
           'fansNums'=>$fansNums,
           'getNums'=>$getNums,
           'circleId'=>$circleInfo['id'],
       ]);
   }



}