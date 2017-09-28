<?php

namespace backend\controllers;

use Yii;
use backend\models\Members;
use backend\models\Experts;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\controllers\BaseController;

/**
 * MembersController implements the CRUD actions for Members model.
 */
class MembersController extends BaseController
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
     * Lists all Members models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Members::find(),
        ]);
        $model = new Members();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
        $list = $data->asArray()->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', [
            'list'=>$list,
            'pages'=>$pages,
            'dataProvider' => $dataProvider,
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
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->photo = $post["filename"]['imgpath_0'];
            if(isset($post['tags'])){
                $model->tags = json_encode($post['tags']);
            }else{
                $model->tags = '';
            }

            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'colums' => $this->colums('bdtmembers'),
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
        $model->created = time();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->photo = $post["filename"]['imgpath_0'];
            if(isset($post['tags'])){
                $model->tags = json_encode($post['tags']);
            }else{
                $model->tags = '';
            }
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'colums' => $this->colums('bdtmembers'),
            ]);
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
        $find = Experts::find()->where(['member_id'=>$id])->one();

        if($find['id']){
           $del = $find->delete();
        }
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
