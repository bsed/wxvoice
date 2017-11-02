<?php

namespace backend\controllers;

use Yii;
use backend\models\Experts;
use backend\models\Circles;
use backend\models\Members;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\controllers\BaseController;

/**
 * CirclesController implements the CRUD actions for Circles model.
 */
class CirclesController extends BaseController
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
     * Lists all Circles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Circles::find(),
        ]);
        $model = new Circles();
        $data = $model->find();

        if($_POST){
            //闭包传入参数
            $keys = $_POST['search'];
            $pages = new Pagination(['totalCount' =>1, 'pageSize' => '20']);
            $list = $data->asArray()->offset($pages->offset)
                ->where(['status'=>1])
                ->where(['like','name',$keys])
                ->limit($pages->limit)->all();
        }else{
            $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
            $list = $data->asArray()->offset($pages->offset)
                ->where(['status'=>1])
                ->limit($pages->limit)->all();
            
        }


        return $this->render('index', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);


    }


    /**
     * Creates a new Circles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Circles();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->save();
            return $this->redirect(['index']);
        } else {

            return $this->render('create', [
                'model' => $model,
                'users' => $this->getUsers(),
                'colums' => $this->colums('bdtcircles'),
            ]);
        }
    }

    /**
     * Updates an existing Circles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->created = time();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            //$model->tags = json_encode($post['tags']);
            //同时更新members表中的vip字段
            $circles = Circles::updateAll(['status' => $post['Circles']["status"]], 'id ='.$id);

            //同时更新members表中的vip字段END
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $users = $this->getUsers();
            return $this->render('update', [
                'model' => $model,
                'users' => $users,
                'colums' => $this->colums('bdtcircles'),
            ]);
        }
    }

    /**
     * Deletes an existing Circles model.
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
            'query' => Circles::find(),
        ]);
        $model = new Circles();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
        if($_POST){
            //闭包传入参数
            $keys = $_POST['search'];
            $pages = new Pagination(['totalCount' =>1, 'pageSize' => '20']);
            $list = $data->asArray()->offset($pages->offset)
                ->where(['status'=>0])
                ->where(['like','name',$keys])
                ->limit($pages->limit)->all();
        }else{
            $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
            $list = $data->asArray()->offset($pages->offset)
                ->where(['status'=>0])
                ->limit($pages->limit)->all();

        }
        return $this->render('apply', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Finds the Circles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Circles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Circles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
