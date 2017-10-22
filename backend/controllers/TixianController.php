<?php

namespace backend\controllers;

use Yii;
use backend\models\Tixian;
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
        $list = $data->asArray()->orderBy('created DESC')->with('user')->where(['status'=>1])->offset($pages->offset)->limit($pages->limit)->all();
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
