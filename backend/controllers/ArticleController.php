<?php
/**
 * Created by PhpStorm.
 * User: yanli
 * Date: 2017/2/23
 * Time: 20:09
 */
namespace backend\controllers;

use Yii;
use backend\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\models\ArticleModel;


class ArticleController extends Controller{

    public function actions()
    {

        return [

            'upload'=>[
                'class' => 'common\widgets\single_uploader\UploadAction',
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],

            'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ],
        ];
    }

  public function actionIndex()
  {
      return $this->render('index');
  }

  public function actionList()
  {
      $model = new ArticleModel();
      $data = $model->find();
      $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
      $list = $data->asArray()->orderBy(['listorder' => SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
      return $this->render('list', [
          'list'=>$list,
          'pages'=>$pages,
      ]);
  }

 public function actionAdd()
 {


     $model = new ArticleModel();
     $data = $model::getAllCats('article');
     $cat_id = intval(Yii::$app->request->get('id'));
     if( $model->load(Yii::$app->request->post())){
         $model->cover = json_encode($_POST["filename"]);
         $model->ctime = time();
         if( !$model->create() ){
             Yii::$app->session->setFlash('warning',$model->_lastError);
         }else{
             return $this->redirect(['article/list']);
         }
     }
     return $this->render('add',[
         'model' => $model,
         'data' => $data,
         'cat_id' => $cat_id,

     ]);
 }

 public function actionEdit()
 {
     $id = intval(Yii::$app->request->get('id'));
     $model = ArticleModel::findOne($id);
     $data = ArticleModel::getAllCats('article');
     $info = $model::find()->where(['id' => $id])->one();
     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
         $post = Yii::$app->request->post();
         $model->cover = json_encode($_POST["filename"]);
         $model->ctime = strtotime($post['ArticleModel']['ctime']);
         $model->save($post);
         return $this->redirect(['article/edit.html?id='.$id]);
     }
     return $this->render('edit', [
         'model'=>$info,
         'data' => $data,
     ]);
 }

 public function actionDel($id)
 {
     $model = new ArticleModel();
     $model->del($id);
     return $this->redirect(['article/list']);
 }

















}