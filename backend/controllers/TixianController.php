<?php

namespace backend\controllers;

use Yii;
use backend\models\Tixian;
use mobile\models\Tixian as tixians;
use backend\models\Members;
use backend\models\Questions;
use mobile\models\Circlemembers;
use mobile\models\Wxpayrecord;
use backend\models\Pocketget;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\controllers\BaseController;

use EasyWeChat\Foundation\Application;

class TixianController extends BaseController
{
    /**
     * @inheritdoc
     */
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
    /*
     * 提现财务管理
     */
    public function actionCaiwu(){

        $model = new Members();
        $questionModel = new Questions();
        $PocketgetModel = new Pocketget();
        $CircleModel = new Circlemembers();
        $tixianModel = new tixians();
        $data = $model->find();

        if($_POST) {
            $keys = $_POST['search'];
            $pages = new Pagination(['totalCount' =>1, 'pageSize' => '100']);
            $list = $data->asArray()->where(['like','nickname',$keys])->orderBy('created DESC')->with('expert')->offset($pages->offset)->limit($pages->limit)->all();
        }else{
            $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '10']);
            $list = $data->asArray()->orderBy('created DESC')->with('expert')->offset($pages->offset)->limit($pages->limit)->all();
        }

        $QuestionPrice = [];
        $PocketPrice = [];
        $CirclePrice = [];
        $tixian = [];
        foreach($list as $k =>$v){
            //回答收入
            $answers = $questionModel->find()->asarray()->where(['expert_id'=>$v['expert']['id']])->sum('askprice');
            if(!$answers){
                $answers = number_format(0,2);
            }
            $QuestionPrice[]=$answers;
            //红包收入
            $PocketPrices = $PocketgetModel->find()->where(['member_id'=>$v['id']])->sum('get_price');
            if(!$PocketPrices){
                $PocketPrices = number_format(0,2);
            }
            $PocketPrice[] = $PocketPrices;
            //圈子收入，从加入的圈子中计算
            $CirclePrices = $CircleModel->find()->asarray()->where(['qid'=>$v['id']])->sum('price');
            if(!$CirclePrices){
                $CirclePrices = number_format(0,2);
            }
            $CirclePrice[] = $CirclePrices;
            //提现金额
            $tixians = $tixianModel->find()->where(['mid'=>$v['id']])->andWhere(['status'=>1])->sum('price');
            if(!$tixians){
                $tixians = number_format(0,2);
            }
            $tixian[] = number_format($tixians,2);

        }

        $total = $QuestionPrice + $PocketPrice + $CirclePrice;
        //汇总金额
        $answersSum = $questionModel->find()->asarray()->sum('askprice');
        $CirclePricesSum = $CircleModel->find()->asarray()->sum('price');
        $PocketPricesSum = $PocketgetModel->find()->sum('get_price');
        $totalSum = $answersSum + $CirclePricesSum + $PocketPricesSum;
        $tixiansSum = $tixianModel->find()->andWhere(['status'=>1])->sum('price');


        return $this->render('caiwu', [
            'list'=>$list,
            'total'=>$total,
            'totalSum'=>$totalSum,
            'tixiansSum'=>$tixiansSum,
            'tixian'=>$tixian,
            'pages'=>$pages,
        ]);
    }
    /*
     * 流水管理
     */
    public function actionLiushui(){//圈子收入、会费收入在circle、feeuser
        //找到圈子的收入
        $model = new Wxpayrecord();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '10']);
        $list = $data->asArray()->orderBy('created DESC')->with('users')->where(['pay_type'=>'feeuser'])->orWhere(['pay_type'=>'circle'])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('liushui',[
            'list'=>$list,
            'pages'=>$pages,
        ]);
    }
    /**
     * Lists all Tixian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tixian::find(),
        ]);

        $model = new Tixian();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '10']);
        if($_POST) {
            $keys = $_POST['search'];
            $pages = new Pagination(['totalCount' =>1, 'pageSize' => '100']);
            $list = $data->asArray()
                ->orderBy('created DESC')
                ->with([ 'user' => function($query) use($keys){
                    $query->andWhere(['like','nickname',$keys]);
                },])
                ->where(['status'=>1])
                ->offset($pages->offset)
                ->limit($pages->limit)->all();

        }else{
            $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '10']);
            $list = $data->asArray()->orderBy('created DESC')->with('user')->where(['status'=>1])->offset($pages->offset)->limit($pages->limit)->all();
        }

        return $this->render('index', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionApply()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tixian::find(),
        ]);

        $model = new Tixian();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '10']);
        $list = $data->asArray()->orderBy('created DESC')->with('user')->where(['status'=>0])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('apply', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tixian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
            'colums' => $this->colums('bdttixian'),
        ]);
    }


    public function actionCreate()
    {
        $model = new Tixian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'colums' => $this->colums('bdttixian'),
            ]);
        }
    }

    /**
     * Updates an existing Tixian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'colums' => $this->colums('bdttixian'),
            ]);
        }
    }
    public function actionPay($id, $openid, $price){
        //调用微信 进行打款操作
        $app = new Application(Yii::$app->params['wechat']);
        $merchantPay = $app->merchant_pay;
        $merchantPayData = [
            'partner_trade_no' => time().rand(100,999), //随机字符串作为订单号，跟红包和支付一个概念。
            'openid' => $openid,
            'check_name' => 'NO_CHECK',
            're_user_name'=>'半导体用户',
            'amount' => $price * 100,  //单位为分
            'desc' => '企业付款',
            'spbill_create_ip' =>$_SERVER['REMOTE_ADDR'],
        ];
        $result = $merchantPay->send($merchantPayData);
        //$result['result_code']是否为SUCCESS 来判断是否成功，如果失败则信息再$result['err_code_des']内。
        if($result['result_code'] == 'SUCCESS'){
            $model = new Tixian();
            $model->updateAll(['status' => 1, 'updated'=>time()], 'id ='.$id);
            return $this->redirect(['index']);
        }else{
            $result['result_code'];
        }

    }
    /**
     * Deletes an existing Tixian model.
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
     * Finds the Tixian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tixian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tixian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
