<?php

namespace backend\controllers;

use Yii;
use backend\models\Pocketget;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * PocketgetController implements the CRUD actions for Pocketget model.
 */
class PocketgetController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pocketget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pocketget::find(),
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => Pocketget::find(),
        ]);
        $model = new Pocketget();
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
     * Displays a single Pocketget model.
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
     * Creates a new Pocketget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pocketget();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pocketget model.
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
     * Deletes an existing Pocketget model.
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
     * Finds the Pocketget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pocketget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pocketget::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
