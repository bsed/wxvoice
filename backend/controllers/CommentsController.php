<?php

namespace backend\controllers;

use Yii;
use backend\models\Comments;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\controllers\BaseController;

/**
 * CommentsController implements the CRUD actions for Comments model.
 */
class CommentsController extends BaseController
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
     * Lists all Comments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Comments::find(),
        ]);

        $model = new Comments();
        $data = $model->find();
        if($_POST){
            $keys = $_POST['search'];
            $pages = new Pagination(['totalCount' =>1, 'pageSize' => '20']);
            $list = $data->asArray()->where(['like','content',$keys])->offset($pages->offset)
                ->with('user')
                ->limit($pages->limit)->all();
        }else{
            $pages = new Pagination(['totalCount' =>20, 'pageSize' => '20']);
            $list = $data->asArray()->offset($pages->offset)
                ->with('user')
                ->limit($pages->limit)->all();
        }


        return $this->render('index', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comments model.
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
     * Creates a new Comments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'users' => $this->getUsers(),
                'colums' => $this->colums('bdtcomments'),
            ]);
        }
    }

    /**
     * Updates an existing Comments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->created = strtotime($post['Comments']['created']);
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'users' => $this->getUsers(),
                'colums' => $this->colums('bdtcomments'),
            ]);
        }
    }

    /**
     * Deletes an existing Comments model.
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
     * Finds the Comments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
