<?php

namespace backend\controllers;

use Yii;
use backend\models\Experts;
use backend\models\Members;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\controllers\BaseController;

/**
 * ExpertsController implements the CRUD actions for Experts model.
 */
class ExpertsController extends BaseController
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
     * Lists all Experts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Experts::find(),
        ]);
        $model = new Experts();
        $data = $model->find();

        if($_POST){
            //闭包传入参数
            $keys = $_POST['search'];
            $pages = new Pagination(['totalCount' =>1, 'pageSize' => '20']);
            $list = $data->asArray()->offset($pages->offset)
                ->with([ 'user' => function($query) use($keys){
                    $query->andWhere('vip=1')->andWhere(['like','nickname',$keys]);
                },])
                ->limit($pages->limit)->all();
        }else{
            $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
            $list = $data->asArray()->offset($pages->offset)
                ->with([ 'user' => function($query) {
                    $query->andWhere('vip=1');
                },])
                ->limit($pages->limit)->all();
        }


        return $this->render('index', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);


    }


    /**
     * Creates a new Experts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Experts();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'users' => $this->getUsers(),
                'colums' => $this->colums('bdtexperts'),
            ]);
        }
    }

    /**
     * Updates an existing Experts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
        //$model->tags = json_encode($post['tags']);
         //同时更新members表中的vip字段
            $member = Members::updateAll(['vip' => $post['Experts']["vip"]], 'id ='.$post['Experts']["member_id"]);
            $model -> created = strtotime($post['Experts']['created']);
         //同时更新members表中的vip字段END
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'users' => $this->getUsers(),
                'colums' => $this->colums('bdtexperts'),
            ]);
        }
    }

    /**
     * Deletes an existing Experts model.
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
     * 申请列表
     * ／
     */
    public  function actionApply(){

        $dataProvider = new ActiveDataProvider([
            'query' => Experts::find(),
        ]);
        $model = new Experts();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
        $list = $data->asArray()->offset($pages->offset)
            ->with([ 'user' => function($query) {
            $query->andWhere('vip=0');
             },])
            ->limit($pages->limit)->all();
        return $this->render('apply', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Finds the Experts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Experts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Experts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
