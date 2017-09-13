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
use backend\models\PageModel;


class PageController extends Controller{

    public function actions()
    {

        return [

            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
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
        $model = new PageModel();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
        $list = $data->asArray()->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('list', [
            'list'=>$list,
            'pages'=>$pages,
        ]);
    }

    public function actionAdd()
    {
        $model = new PageModel();
        $data = $model::getAllCats('page');
        $cat_id = intval(Yii::$app->request->get('id'));
        if( $model->load(Yii::$app->request->post())){
            if( !$model->create() ){
                Yii::$app->session->setFlash('warning',$model->_lastError);
            }else{
                return $this->redirect(['page/list']);
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
        $model = PageModel::findOne($id);
        $data = PageModel::getAllCats('page');
        $info = $model::find()->where(['id' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $post = Yii::$app->request->post();
            $model->save($post);
            return $this->redirect(['page/list&id='.$id]);
        }
        return $this->render('edit', [
            'model'=>$info,
            'data' => $data,
        ]);
    }

    public function actionDel($id)
    {
        $model = new PageModel();
        $model->del($id);
        return $this->redirect(['article/list']);
    }

















}