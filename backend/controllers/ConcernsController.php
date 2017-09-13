<?php

namespace backend\controllers;

use Yii;
use backend\models\Concerns;
use backend\models\Questions;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\controllers\BaseController;

/**
 * ConcernsController implements the CRUD actions for Concerns model.
 */
class ConcernsController extends BaseController
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
     * Lists all Concerns models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Concerns::find(),
        ]);
        $model = new Concerns();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '10']);
        $list = $data->asArray()->offset($pages->offset)->with(['user','expert'])->limit($pages->limit)->all();
        return $this->render('index', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Concerns model.
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
     * Creates a new Concerns model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Concerns();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'members' => $this->getMembers(),
                'experters' => $this->getMembers(),
                'colums' => $this->colums('bdtconcerns'),
            ]);
        }
    }

    /**
     * Updates an existing Concerns model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'members' => $this->getMembers(),
                'experters' => $this->getExperts(),
                'colums' => $this->colums('bdtconcerns'),
            ]);
        }
    }

    /**
     * Deletes an existing Concerns model.
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
     * Finds the Concerns model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Concerns the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Concerns::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
