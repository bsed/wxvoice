<?php
/**
 * Created by PhpStorm.
 * User: yanli
 * Date: 2017/2/22
 * Time: 9:17
 */
namespace backend\controllers;

use backend\models\options\OptionsModel;
use Yii;
use backend\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\models\adds\banner\BannerModel;


class BannerController extends Controller{

    public function actions()
    {
        return [

            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
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
        $model = new BannerModel();
        $cats = $model->getAllCats();
        $data = $model->find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
        if($_POST){
            $type = $_POST["BannerModel"]['type'];
            if($type == '0'){
                $where = "";
            }else {
                $where = ['type' => $type];
            }
            $list = $data->asArray()->where($where)->orderBy(['listorder' => SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
        }else{
            $type = 0;
            $list = $data->asArray()->orderBy(['listorder' => SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();

        }
        return $this->render('list', [
            'list'=>$list,
            'pages'=>$pages,
            'data'=>$cats,
            'model'=>$model,
            'type'=>$type,
        ]);
    }
    public function actionAdd()
    {
        $model = new BannerModel();
        $data = $model->getAllCats();
        if( $model->load(Yii::$app->request->post())){
            if( !$model->create() ){
                Yii::$app->session->setFlash('warning',$model->_lastError);
            }else{
                return $this->redirect(['banner/list']);
            }
        }
        return $this->render('add',[
            'model' => $model,
            'data' => $data,
        ]);
    }
    public function actionEdit()
    {
        $id = intval(Yii::$app->request->get('id'));
        $model = BannerModel::findOne($id);
        $info = $model::find()->where(['id' => $id])->one();
        $duotu = json_decode($info['value'], true);
        $type = $info['type'];
        $data = $model->getAllCats();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $post = Yii::$app->request->post();
            $model->save($post);
            return $this->redirect(['banner/list']);
        }
        return $this->render('edit', [
            'model'=>$info,
            'type' => $type,
            'data' => $data,
            'value'=>$duotu,
        ]);
    }
    public function actionDel($id)
    {
        $model = new BannerModel();
        $model->del($id);
        return $this->redirect(['banner/list']);

    }
    public function actionType()
    {
        $models = new OptionsModel();
        $info = $models::find()->where(['type' => 'bannertype'])->asArray()->one();
        $value = json_decode($info['value'], true);
        if($_POST){
            if(isset($_POST['type'])){
                $value = json_encode($_POST['type']);
            }else{
                $value = json_encode([]);
            }
            if($info){
                $update = OptionsModel::findOne($info['id']);
                $update->value=  $value;
                $update->save();
            }else{
                $models->type = 'bannertype';
                $models->value = $value;
                $models->save();
            }
            return $this->redirect(['banner/type']);
        }
        if(  isset($value['mingzi']) ){
            $count = count($value['mingzi']) - 1;
        }else{
            $count = 0;
        }

        return $this->render('type', [
            'info'=>$info,
            'count' => $count,
            'mingzi' => isset($value['mingzi'])?$value['mingzi']:'',
            'text' => isset($value['text'])?$value['text']:'',
        ]);
    }


}