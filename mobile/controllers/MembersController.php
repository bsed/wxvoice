<?php

namespace mobile\controllers;

use Yii;
use mobile\models\Members;
use mobile\models\Wxpayrecord;
use mobile\models\Experts;
use mobile\models\Concerns;
use mobile\models\Tixian;
use mobile\models\Circlemembers;
use mobile\models\Articles;
use mobile\models\Questions;
use mobile\models\Pocketget;
use mobile\models\Codes;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mobile\controllers\BaseController;
use common\tools\htmls;
use common\tools\Uploadfile;
use dosamigos\qrcode\QrCode;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;


class MembersController extends BaseController
{
    public function actions(){
        $view = Yii::$app->view;
        $view->params['site'] = htmls::site();
        $view->params['js'] = $this->setJs();
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Members models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Members::find(),
        ]);

        //判断是否是付费会员，如果不是就要求付费成为会员
        $member_id = Yii::$app->session['member_id'];
        $feeuser = Yii::$app->session['feeuser'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        //END
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }else{
            $model = new Members();
            $user = $model->find()->asarray()->where(['id'=>$member_id])->one();
            $modelExpert = new Experts();
            $expert = $modelExpert->find()->asarray()->where(['member_id'=>$member_id])->one();
            if(!$user){
                return $this->redirect('/members/login.html');
            }
            //是否是微信自带头像
            if(stripos($user['photo'], 'ttp')) {
                 $isWeixin = true;
            }else{
                $isWeixin = false;
            }
            $tags = json_decode($user['tags'], true);
            Yii::$app->session['member_id']=$user['id'];
            Yii::$app->session['nickname']=$user['nickname'];
            Yii::$app->session['phone']=$user['phone'];
        }

        //我的收入
        //查看专家的id ，主要用于问答的统计
        $expert = Experts::find()->where(['member_id'=>$member_id])->asarray()->one();
        if($expert){
            //回答收入
            $questionModel = new Questions();
            $QuestionPrice = $questionModel->find()->asarray()->where(['expert_id'=>$expert['id']])->sum('askprice');
        }else{
            $QuestionPrice = "0.00";
        }
        //红包收入
        $PocketgetModel = new Pocketget();
        $PocketPrice = $PocketgetModel->find()->where(['member_id'=>$member_id])->sum('get_price');
        //圈子收入，从加入的圈子中计算
        $CircleModel = new Circlemembers();
        $CirclePrice = $CircleModel->find()->asarray()->where(['qid'=>$member_id])->sum('price');
        if(!$CirclePrice){
            $CirclePrice = '0.00';
        }
        //总的收入等于回答收入+红包收入+圈子收入
        $total = $QuestionPrice + $PocketPrice + $CirclePrice;

        $model = new Concerns();
        //我关注的 查找mid
        $concern = $model->find()->asarray()->with('concerns')->where(['mid'=>$member_id])->count();
        //粉丝 查找to_mid
        $fans = $model->find()->asarray()->with('fans')->where(['to_mid'=>$member_id])->count();
        //判断是否是付费会员
        $feeuser = Wxpayrecord::find()->asarray()->where(['mid'=>$member_id,'pay_type'=>'feeuser'])->count();
        //如果加入了会员，则显示会员信息
        $circelMember = Circlemembers::find()->asarray()->where(['mid'=>$member_id])->one();
        //提现的金额
        $tixian = Tixian::find()->where(['mid'=>$member_id])->sum('price');
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'user' => $user,
            'tags' => $tags,
            'isWeixin' => $isWeixin,
            'concern' => $concern,
            'expert' => $expert,
            'fans' => $fans,
            'member_id' => $member_id,
            'feeuser' => $feeuser,
            'total' => $total,
            'tixian' => $tixian,
            'circelMember' => $circelMember,
        ]);
    }
    /**
     * members to login
     */
    public function actionLogin(){
        $model = new Members();
        if(stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
            $cookie = Yii::$app->request->cookies;
            $user = $cookie->getValue('user');
            if($user['openid']){
                $wxMember = $model->find()
                    ->where(['openid'=>$user['openid']])
                    ->with([
                        'feeuser' => function ($query){
                            $query->where(['pay_type'=>'feeuser']);
                        }
                    ])->one();
                //写到session中，就行了，就终止执行
                Yii::$app->session['member_id'] = $wxMember['id'];
                if($wxMember['feeuser']){
                    Yii::$app->session['feeuser'] = 1;
                }else{
                    Yii::$app->session['feeuser'] = 0;
                }
                Yii::$app->session['nickname'] = $wxMember['nickname'];
            }
            if(!$user){
                $this->startWx();
            }else{
                return $this->redirect('/members/wxlogin.html');
            }

        }
        $member_id = Yii::$app->session['member_id'];
        if($member_id){
            return $this->redirect('/members/index.html');
        }

        $post = Yii::$app->request->post();
        $url = Yii::$app->controller->action->id;//获取当前的控制器
        if($post){

            $user = Members::find()->asarray()
                ->where(['phone' => $post['phone']])
                ->with([
                    'feeuser' => function ($query){
                        $query->where(['pay_type'=>'feeuser']);
                    }
                ])->one();
            if($user){
                if(md5($post['pwd']) == $user['pwd']){
                    Yii::$app->session['member_id']=$user['id'];
                    if($user['feeuser']){
                        Yii::$app->session['feeuser'] = 1;
                    }else{
                        Yii::$app->session['feeuser'] = 0;
                    }
                    Yii::$app->session['nickname']=$user['nickname'];
                    $expertModel = new Experts();
                    $info = $expertModel->find()->asarray()->where(['member_id'=>$user['id']])->one();
                }
              die(json_encode(['result'=>'success']));
            }

        }
        return $this->render('login');
    }

    public function actionWxlogin(){
        $model = new Members();
        $member_id = Yii::$app->session['member_id'];
        $cookie = Yii::$app->request->cookies;
        $user = $cookie->getValue('user');
        //查询数据库中是否已有数据
        if(!$user){
            $this->startWx();
        }
       //写入之前，如果存在就直接返回到上一级页面，避免访问同一个url造成数据重复
       $count = $model->find()->asarray()->where(['openid'=>$user['openid']])->count();
        if($count){
            return $this->redirect(Yii::$app->session['tryinto']);
        }
        if($user['openid']){
            //写入数据库,openid,nickname,photo,sex
            $model->nickname = $user['nickname'];
            if(isset($user['headimgurl'])){
                //如果是微信,就下载头像到本地
                $base = Yii::getAlias("@public");
                $directory = '/wxhead/';
                $path = $base.$directory;
                $saveName = time().rand(100,999).rand(100,999).'.png';
                $filename = $path.$saveName;
                if (!file_exists($path) && !mkdir($path, 0777, true)) {
                    return false;
                }
                $photo = $this->saveWeixinFile($user['headimgurl'], $filename, $path, $saveName);
                $model->photo = $directory.$saveName;
            }else{
                $model->photo = '';
            }

            $model->phone = '';

            if(isset($user['openid'])){
                $model->openid = $user['openid'];
            }else{
                $model->openid = '';
            }
            $model->created = time();
            $info = $model->save();
            $id = $model->id;
            if($info){
                Yii::$app->session['member_id']=$id;
            }
            //END
           //判断是否是付费会员
              $wxMember = $model->find()->asarray()
                  ->where(['openid'=>$user['openid']])
                  ->with([
                      'feeuser' => function ($query){
                          $query->where(['pay_type'=>'feeuser']);
                      }
                  ])->one();
              if($wxMember['phone'] || $wxMember['openid']) {
                  Yii::$app->session['member_id'] = $wxMember['id'];
                  if($wxMember['feeuser']){
                      Yii::$app->session['feeuser'] = 1;
                  }else{
                      Yii::$app->session['feeuser'] = 0;
                  }

                  Yii::$app->session['nickname'] = $wxMember['nickname'];
                  return $this->redirect(Yii::$app->session['tryinto']);
              }else{
                  $session = \Yii::$app->session;
                  $session->removeAll();
              }
        }
        return $this->redirect('/members/index.html');
//        return $this->render('wxlogin',['user'=>$user]);
    }
    /*
     * 请求数据看 是否是付费的会员
     */
    public function actionIsfeeuser(){
        if($_POST){
            $member_id = Yii::$app->session['member_id'];
            if($member_id){
                $wxMember = Members::find()->asarray()
                    ->where(['id'=>$member_id])
                    ->with([
                        'feeuser' => function ($query){
                            $query->where(['pay_type'=>'feeuser'])->orderBy('created DESC');
                        }
                    ])->one();
                if($wxMember['vip'] == 1){
                    Yii::$app->session['feeuser'] = 1;
                    die(json_encode(['result'=>'success']));
                }
                if($wxMember['feeuser'][0]['status'] == 1){
                    //查看加入时间
                    $addTime = $wxMember['feeuser'][0]['created'];
                    if(time() - $addTime > 365*24*3600){
                        Yii::$app->session['feeuser'] = 0;
                        die(json_encode(['result'=>'error']));
                    }else{
                        Yii::$app->session['feeuser'] = 1;
                        die(json_encode(['result'=>'success']));
                    }

                }else{
                    Yii::$app->session['feeuser'] = 0;
                    die(json_encode(['result'=>'error']));
                }

                }
        }
    }

    /**
     * members to regist 待废弃
     */
    public function actionRegist(){

        $model = new Members();
        $post = Yii::$app->request->post();
        if($post){
            $model->nickname = $post['nickname'];
            $model->phone = $post['phone'];
            $model->pwd = md5($post['pwd']);
            if(isset($post['openid'])){
                $model->openid = $post['openid'];
            }else{
                $model->openid = '';
            }
            $model->created = time();
            $info = $model->save();
            $id = $model->id;
            if($info){
                Yii::$app->session['member_id']=$id;
                die(json_encode($info));
            }

        }
        return $this->render('regist');
    }
    /*
     *  查看是否绑定了手机
     */
    public function actionIfbindmobile(){
        $model = new Members();
        $member_id = Yii::$app->session['member_id'];
        $info = $model->find()->asarray()->where(['id' => $member_id])->one();
        die(json_encode(['result'=>'success','info'=>$info]));
    }
    /**
     * members to sets
     */
    public function actionMyset(){

        if(isset($_GET['loginout'])){
            $session = \Yii::$app->session;
            $session->removeAll();
            return $this->redirect('/members/login.html');
        }
        return $this->render('myset');
    }
    /*
     * 绑定与解绑手机号码
     */
    public function actionMyset_bind_phone(){


        return $this->render('myset_bind_phone',['mobile'=>1]);
    }
    public function actionPassword_edit()
    {
        $model = new Members();
        $post = Yii::$app->request->post();
        if($post){
            $member_id = Yii::$app->session['member_id'];
            $user = $this->findModel($member_id);
            if( ($user['pwd'] == $post['oldPassword']) && ($post['newPassword1'] == $post['newPassword2']) ){
                $model->updateAll(['pwd' => $post['newPassword2']], 'id ='.$member_id);
                die(json_encode(['result'=>'success']));
            }else{
                die(json_encode(['message'=>'修改失败']));
            }


        }
        return $this->render('password_edit');
    }
    public function actionAboutus_details(){
        return $this->render('aboutus_details');
    }
    public function actionFeedback(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        return $this->render('feedback');
    }
    public function actionPersonal_data(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }else{
            $user = $this->findModel($member_id);
            Yii::$app->session['member_id']=$user['id'];
            Yii::$app->session['nickname']=$user['nickname'];
            Yii::$app->session['phone']=$user['phone'];
        }
        $model = new Members();
        $post = Yii::$app->request->post();
        if($post){
            $member_id = Yii::$app->session['member_id'];
            $model->updateAll(['sex' => $post['sex']], 'id ='.$member_id);
        }
        return $this->render('personal_data',['user'=>$user]);
    }
    public function actionUser_photo_edit(){
        $model = new Members();
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $user = $this->findModel($member_id);
        return $this->render('user_photo_edit',['model'=>$model, 'user'=>$user]);
    }
    //头像上传测试用例
    public function actionUploader(){
        $model = new Members();
        $member_id = Yii::$app->session['member_id'];
        $info = $model->updateAll(['photo' => $_POST['photo']], 'id ='.$member_id);
        if($info){
            die(json_encode(['result'=>'success']));
        }

    }
    public function actionPersonal_data_name_edit(){
        $model = new Members();
        $post = Yii::$app->request->post();
        if($post){
            $member_id = Yii::$app->session['member_id'];
            if($post['index'] == 0){
                $model->updateAll(['nickname' => $post['nickname']], 'id ='.$member_id);
            }else{
                $model->updateAll(['slogan' => $post['nickname']], 'id ='.$member_id);
            }

            die(json_encode(['result'=>'success','index'=>$post['index']]));
        }
        return $this->render('personal_data_name_edit');
    }
   //所属行业
    public function actionPersonal_data_industry_edit(){

        return $this->render('personal_data_industry_edit');
    }
    //我的钱包
    public function actionMywallet(){
        $member_id = Yii::$app->session['member_id'];

        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        //查看专家的id ，主要用于问答的统计
        $expert = Experts::find()->where(['member_id'=>$member_id])->asarray()->one();
        if($expert){
            //回答收入
            $questionModel = new Questions();
            $QuestionPrice = $questionModel->find()->asarray()->where(['expert_id'=>$expert['id']])->sum('askprice');
        }else{
            $QuestionPrice = "0.00";
        }
        //红包收入
        $PocketgetModel = new Pocketget();
        $PocketPrice = $PocketgetModel->find()->where(['member_id'=>$member_id])->sum('get_price');
        //圈子收入，从加入的圈子中计算
        $CircleModel = new Circlemembers();
        $CirclePrice = $CircleModel->find()->asarray()->where(['qid'=>$member_id])->sum('price');
        if(!$CirclePrice){
            $CirclePrice = '0.00';
        }
        if(!$PocketPrice){
            $PocketPrice = '0.00';
        }
        //总的收入等于回答收入+红包收入+圈子收入
        $total = $QuestionPrice + $PocketPrice + $CirclePrice;
        //提现的金额
        $tixian = Tixian::find()->where(['mid'=>$member_id])->sum('price');
        //提现记录
        $tixianRecord = Tixian::find()->where(['mid'=>$member_id])->all();
        return $this->render('mywallet',[
            "QuestionPrice"=>$QuestionPrice,
            "PocketPrice"=>$PocketPrice,
            "CirclePrice"=>$CirclePrice,
            "total"=>$total,
            "tixian"=>$tixian,
            "tixianRecord"=>$tixianRecord,
        ]);
    }
    public function actionTixian(){
        //提交体现申请
        $mid = Yii::$app->session['member_id'];
        $info = Members::find()->asarray()->where(['id'=>$mid])->one();
        if($info['openid']){
            $model = new Tixian();
            $model -> mid = $mid;
            $model -> openid = $info['openid'];
            $model -> price = $_POST['price'];
            $model -> created = time();
            $model -> save();
            $id = $model->id;
            if($id){
                die(json_encode(['result'=>'success']));
            }else{
                die(json_encode(['result'=>'error']));
            }

        }else{
            die(json_encode(['result'=>'error']));
        }

    }
    public function actionMycoupon(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        return $this->render('mycoupon');
    }
    //我的关注
    public function actionMyrelations(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $mid = Yii::$app->session['member_id'];
        $model = new Concerns();

        //我关注的 查找mid
        $concern = $model->find()->asarray()->with('concerns')->where(['mid'=>$mid])->all();
        //粉丝 查找to_mid
        $fans = $model->find()->asarray()->with('fans')->where(['to_mid'=>$mid])->all();


        return $this->render('myrelations',[
            'concern'=>$concern,
            'fans'=>$fans,
        ]);
    }
    /*
     * 我答，我问，我听
     */
    public function actionMyhomepage(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $mid = Yii::$app->session['member_id'];
        $expert = Experts::find()->asarray()->where(['member_id'=>$mid])->one();
        $model = new Questions();
        //我的回答,
        $answer = $model->find()->asarray()->where(['expert_id'=>$expert['member_id']])->with('user')->orderBy('created DESC')->all();
        //我的提问
        $ask = $model->find()->asarray()->where(['member_id'=>$mid])->with('user')->orderBy('created DESC')->all();
        //我的收听
        return $this->render('myhomepage',[
            'answer'=>$answer,
            'ask'=>$ask,
            'member_id'=>$mid,
        ]);
    }
    //使用ajax分别请求数据,将我问，我答，合并
    public function actionMyanswer(){
        $type = $_POST['type'];
        if($type == 'ask'){
            $typeName = 'member_id';
            $typeId = $mid;
        }elseif($type == "answer"){
            $typeName = 'expert_id';
            $typeId = $expert;
        }

        $member_id = Yii::$app->session['member_id'];
        $expert = Yii::$app->session['expert'];
        $model = new Questions();
        $pernum = $_POST['pernum'];
        $list = $model->find()->asarray()->where([$typeName=>$typeId])->with('user')->offset($_POST['start'])->limit($pernum)->all();

        $total = $model->find()->asarray()->where([$typeName=>$typeId])->count();
        $pages = ceil($total/$pernum);
        $file = Yii::$app->params['public'].'/attachment';
        die(json_encode(
            [
                'result'=>'success',
                'file'=>$file,
                'mid'=>$mid,
                'data'=>[
                    'list'=>$list,
                    'page'=>[
                        'currentPage'=>$_POST['currentPage'],
                        'pages'=>$pages,
                        'pernum'=>$pernum,
                        'start'=>$_POST['start'],
                        'total'=>$total,
                    ],
                ]
            ]
        ));
    }

    /*
     * 申请成为专家
     */
    public function actionQanda_certify(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        //查看会员信息
        $info = Members::find()->asarray()->where(['id'=>$member_id])->one();
        //查看认证的信息
        $apply = Experts::find()->asarray()->where(['member_id'=>$member_id])->one();

        $type = htmls::getPiece('experttype');
        return $this->render('qanda_certify',['info'=>$info,'type'=>$type,'apply'=>$apply]);
    }
    public function actionApply(){
        if($_POST){
            $model = new Experts();
            $mid = Yii::$app->session['member_id'];
            $model->member_id = $mid;
            $model->honor = $_POST['honor'];
            $model->des = $_POST['des'];
            $model->price = $_POST['price'];
            $model->type = $_POST['type'];
            $model->card = $_POST['card'];
            $model->vip = 0;
            $model->created = time();
            $model->save();
            $id = $model->id;
            if($id){
                die(json_encode(['result'=>'success']));
            }
        }
    }
    public function actionChangeapply(){
        $model = new Experts();
        $mid = $_POST['mid'];
        $info = $model->updateAll([
            'honor'=>$_POST['honor'],
            'des'=>$_POST['des'],
            'price'=>$_POST['price'],
            'type'=>$_POST['type'],
            'card'=>$_POST['card'],
            'vip'=>0,
            'created'=>time(),
        ], "member_id ='{$mid}'");
        if($info){
            die(json_encode(['result'=>'success']));
        }else{
            die(json_encode(['result'=>'error']));
        }

    }
    /*
     * 上传图片认证图片
     */
    public function actionUpload(){
        $uploader = new Uploadfile();
        $base = Yii::getAlias("@public");
        $directory = '/expert/';
        $path = $base.$directory;
        $img = $directory.$uploader->base64_images($_POST['content'],$path);
        $file = Yii::$app->params['public'].'/attachment';
        die(json_encode(['result'=>'success','img'=>$img,'file'=>$file]));
    }
    /*
     * 上传头像
     */
    public function actionUploadheader(){
        $uploader = new Uploadfile();
        $base = Yii::getAlias("@public");
        $directory = '/wxhead/';
        $path = $base.$directory;
        $img = $directory.$uploader->base64_images($_POST['content'],$path);
        $file = Yii::$app->params['public'].'/attachment';
        die(json_encode(['result'=>'success','img'=>$img,'file'=>$file]));
    }

    //我的消息
    public function actionMynotice(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        return $this->render('mynotice');
    }
    //我的关注
    public function actionHouse_circle(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        return $this->render('house_circle');
    }
    //我发布的
    public function actionMyarticle(){
        $model = new Articles();
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $list = $model->find()->asarray()->where(['member_id'=>$member_id])->all();
        return $this->render('myarticle',['list'=>$list]);
    }
    //我的二维码
    public function actionMyqrcode(){
        $member_id = Yii::$app->session['member_id'];
        if(!$member_id){
            Yii::$app->session['tryinto'] = Yii::$app->request->getUrl();
            return $this->redirect('/members/login.html');
        }
        $user = $this->findModel($member_id);
        //如果不是vip，就不能进入二维码
        if($user['vip'] != 1){
            return $this->redirect('/members/index.html');
        }
        $tags = json_decode($user['tags'], true);
        return $this->render('myqrcode',['user'=>$user, 'tags'=>$tags]);
    }

    public function actionQrcode()
    {
        //二维码生成方法

        $domain = Yii::$app->request->hostInfo;
        $member_id = Yii::$app->session['member_id'];
        $url = $domain.'/questions/wen_questions.html?id='.$member_id.'&from=found&publishtype=ask';

        return QrCode::png($url);
    }
    /**
     * Displays a single Members model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Members model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Members();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Members model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /*
     * 发送验证码
     */
    public function actionCode(){
        if($_POST){
             $rand = rand(100000, 999999);
            $config = Yii::$app->params['alidayu'];
            $client  = new Client($config);
            $sendSms = new SendSms;
            $sendSms->setPhoneNumbers($_POST['phone']);
            $sendSms->setSignName('中国半导体论坛');
            $sendSms->setTemplateCode('SMS_90240024');
            $sendSms->setTemplateParam(['code' => $rand]);
            $sendSms->setOutId('demo');
            $sendInfo = $client->execute($sendSms);
            $model = new Codes();
            $model->code = $rand;
            $model->phone = $_POST['phone'];
            $model->created = time();
            $model->save();
            die(json_encode(['result'=>'success','msg'=>$sendInfo]));
        }
    }
    /*
     * 绑定手机号
     */
    public function actionBindphone(){
        //检验验证码是否正确
        $code = $this->Verify($_POST['code']);
        if(!$code){
            die(json_encode(['result'=>'error','msg'=>'验证码错误']));
        }
        $model = new Members();
        $member_id = Yii::$app->session['member_id'];
        $info =  $model->updateAll(['phone'=>$_POST['phone']], "id ='{$member_id}'");
        if($info){
            die(json_encode(['result'=>'success']));
        }
    }
    /*
     * 检查验证码,注册微信数据
     */
    public function actionDologin(){
        if($_POST){
            $code = $this->verify($_POST['code']);
            if(!$code){
                die(json_encode(['result'=>'error','msg'=>'验证码错误']));
            }
            $model = new Members();
            $post = Yii::$app->request->post();
            //检查手机号是否已被注册
            $check = $model->find()->asarray()->where(['phone'=>$post['phone']])->count();
            if($check){
                die(json_encode(['result'=>'error','msg'=>'该手机号已被注册']));
            }
            if($post){
                $model->nickname = $post['nickname'];
                if(isset($post['photo'])){
                    //如果是微信,就下载头像到本地
                    $base = Yii::getAlias("@public");
                    $directory = '/wxhead/';
                    $path = $base.$directory;
                    $saveName = time().rand(100,999).rand(100,999).'.png';
                    $filename = $path.$saveName;
                    if (!file_exists($path) && !mkdir($path, 0777, true)) {
                        return false;
                    }
                    $photo = $this->saveWeixinFile($post['photo'], $filename, $path, $saveName);
                    $model->photo = $directory.$saveName;
                }else{
                    $model->photo = '';
                }

                $model->phone = $post['phone'];
                if(isset($post['pwd'])){
                    $model->pwd = md5($post['pwd']);
                }else{
                    $model->openid = "";
                }

                if(isset($post['openid'])){
                    $model->openid = $post['openid'];
                }else{
                    $model->openid = '';
                }
                $model->created = time();
                $info = $model->save();
                $id = $model->id;
                if($info){
                    Yii::$app->session['member_id']=$id;
                    die(json_encode(['result'=>'success']));
                }

            }

        }
    }
    /*
     * 下载微信远程头像到本地,这样避免做判断
     */
    function saveWeixinFile($img, $filename, $path, $saveName){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch,CURLOPT_URL,$img);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $file_content = curl_exec($ch);
        curl_close($ch);
        $downloaded_file = fopen($path.$saveName, 'w');
        fwrite($downloaded_file, $file_content);
        fclose($downloaded_file);
        return true;
    }
    /*
     * 验证短信验证码
     */
    public function Verify($code){
        $model = new Codes();
        $info = $model->find()->where(['code'=>$code])->one();
        $time = time() - $info['created'];
        if($info['created']){
            if( $time > 180){
                return false;
            }else{
                $model->updateAll(['status'=>1], "code ='{$code}'");
                return true;
            }
        }else{
            return false;
        }


    }

    /**
     * Deletes an existing Members model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Members model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Members the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Members::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
