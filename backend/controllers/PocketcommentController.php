<?php

namespace backend\controllers;

use Yii;
use backend\models\Pocketcomment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * PocketcommentController implements the CRUD actions for Pocketcomment model.
 */
class PocketcommentController extends Controller
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
     * Lists all Pocketcomment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pocketcomment::find(),
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => Pocketcomment::find(),
        ]);
        $model = new Pocketcomment();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '10']);
        if(isset($_GET['pocket_id'])){
            $list = $data->asArray()->offset($pages->offset)->with('user')->where(['pocket_id'=>$_GET['pocket_id']])->limit($pages->limit)->all();
        }else{
            $list = $data->asArray()->offset($pages->offset)->with('user')->limit($pages->limit)->all();
        }

        return $this->render('index', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pocketcomment model.
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
     * Creates a new Pocketcomment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pocketcomment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pocketcomment model.
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

    /**
     * Deletes an existing Pocketcomment model.
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
     * Finds the Pocketcomment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pocketcomment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pocketcomment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
