<?php
/**
 * Created by PhpStorm.
 * User: yanli
 * Date: 2017/1/13
 * Time: 10:43
 */
namespace backend\controllers;


use backend\models\AuthItem;
use backend\models\Menu;
use backend\models\OptionModel;
use backend\models\options\OptionsModel;
use yii\data\Pagination;
use backend\models\User;
use backend\models\AuthAssignment;
use yii\web\NotFoundHttpException;
use Yii;

class OptionController extends \yii\web\Controller{
    public function actions()
    {
        return [

            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',
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
        $data = OptionModel::find();
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '5']);
        $list = $data->asArray()->orderBy(['id' => SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('list',['list'=>$list,'pages'=>$pages]);
    }
    public function actionEdit()
    {
        $model = new OptionModel();
        //  获取modles下的文件名
        $filenames = $this->get_filenamesbydir(Yii::getAlias("@app")."/models");
        foreach ($filenames as $value) {
            $arr[] = substr(strrchr($value, "/"), 1);
        }
        foreach ($arr as $value) {
            $models[] = substr($value,0,strrpos($value,'.'));
        }
        //获取models 表中的数据，以便取差

        //  获取modles下的文件名 END

        $id = Yii::$app->request->get('id');
        $model = OptionModel::findOne($id);
        $info = OptionModel::find()->asArray()->where(['id' => $id])->one();

         if($_POST){
             $model->toSave();
             return $this->redirect(['list']);
         }

        $data = json_decode($info['value'],true);
         if(!empty($data)){
             $text = $data[0]['text'];
             $mingzi = $data[0]['mingzi'];
         }else{
             $text = [];
             $mingzi = [];
         }
        return $this->render('edit',[
            'models'=>$models,
            'info'=>$info['name'],
            'text'=>$text,
            'mingzi'=> $mingzi,
        ]);
    }

    public function actionModelnames()
    {
        $model = new OptionModel();

        $filenames = $this->get_filenamesbydir(Yii::getAlias("@app")."/models");
        foreach ($filenames as $value) {
            $arr[] = substr(strrchr($value, "/"), 1);
        }
        $filemodels = [];
        foreach ($arr as $value) {
            $filemodels[] = substr($value,0,strrpos($value,'.'));
        }
        //获取models 表中的数据，以便取差
        $data = OptionModel::find()->asArray()->select('name')->all();
        $datamodels = [];
        foreach($data as $v){
            $datamodels[] = $v['name'];
        }
        $models = array_diff($filemodels,$datamodels);
        if($_POST){
            $model->toSave();
            return $this->redirect(['list']);
        }
        return $this->render('modelnames',['models'=>$models]);
    }

    public function actionDel()
    {
        $auth = Yii::$app->authManager;
        $item = $auth->getRoles();
        $itemArr =array();
        foreach($item as $v){
            $itemArr[] .= $v->name;
        }
        foreach($itemArr as $key=>$value)
        {
            $item_one[$value]=$value;
        }

        $model = new OptionModel();
        $model->toDel();
        return $this->redirect(['list']);
    }


    //获取指定目录下的所有文件
    function get_filenamesbydir($dir){
        $files =  array();
        $this->get_allfiles($dir,$files);
        return $files;
    }
    function get_allfiles($path,&$files) {
        if(is_dir($path)){
            $dp = dir($path);
            while ($file = $dp ->read()){
                if($file !="." && $file !=".."){
                    $this->get_allfiles($path."/".$file, $files);
                }
            }
            $dp ->close();
        }
        if(is_file($path)){
            $files[] =  $path;
        }
    }

/*
 * 前台网站设置
 *
 *
 * */
     public function actionWebSite()
     {
         $model = new OptionsModel();
         $type = 'website';
         $find = OptionsModel::find()->where(['type' =>$type])->one();
         $info = json_decode($find['value'], true);
         //获取自定义字段增加
         $data = OptionModel::find()->asArray()->where(['name' =>'OptionsModel'])->one();
         $ziduan = json_decode($data["value"],true);
         if(!empty($ziduan)){
             $names = [];
             foreach($ziduan as $k=>$v){
                 $names[] = $v;
             }
         }else{
             $names[] = [];
         }
         $hasnames = json_decode($find["value"],true);
         //获取自定义字段END



         if( $model->load(Yii::$app->request->post()) ){

             $post = Yii::$app->request->post();
             if(empty($post['type'])){
                 $new = $post['OptionsModel'];
             }else{
                 $new = array_merge($post['OptionsModel'], $post["type"]);
             }


             $model->type = $type;
             $model->value = json_encode($new);


             if(!$find){
                 if( !$model->create() ){
                     Yii::$app->session->setFlash('warning',$model->_lastError);
                 }else{
                     return $this->redirect(['option/web-site']);
                 }
             }else{
                 $update = OptionsModel::findOne($find['id']);
                 $update->value= json_encode($new);
                 $update->save();
                 return $this->redirect(['option/web-site']);
             }


         }

         return $this->render('website',[
             'model'=>$model,
             'info' => $info,
             'logo' => $info['logo'],
             'names' => $names,
             'hasnames' => $hasnames,
         ]);
     }

    /*
     * 微信设置
     * 可以通过自定义字段，不断扩充字段类型。使用 json 格式保存在options/wechat中
     * @Appid
     * @Secretkey
     * @商户号
     * @商户密钥
     * */
    public function actionWechatSite()
    {
        $model = new OptionsModel();
        $type = 'wechat';
        $find = OptionsModel::find()->where(['type' =>$type])->one();
        $info = json_decode($find['value'], true);


        //获取自定义字段增加
        $data = OptionModel::find()->asArray()->where(['name' =>'OptionsModel'])->one();
        $ziduan = json_decode($data["value"],true);
        if(!empty($ziduan)){
            $names = [];
            foreach($ziduan as $k=>$v){
                $names[] = $v;
            }
        }else{
            $names[] = [];
        }
        $hasnames = json_decode($find["value"],true);
        //获取自定义字段END



        if( $model->load(Yii::$app->request->post()) ){	
            $post = Yii::$app->request->post();
            if(empty($post['type'])){
                $new = $post['OptionsModel'];
            }else{
                $new = array_merge($post['OptionsModel'], $post["type"]);
            }


            $model->type = $type;
            $model->value = json_encode($new);

			
            if(!$find){
                if( !$model->create() ){
                    Yii::$app->session->setFlash('warning',$model->_lastError);
                }else{
                    return $this->redirect(['option/web-site']);
                }
            }else{
                $update = OptionsModel::findOne($find['id']);
                $update->value= json_encode($new);
                $update->save();
                return $this->redirect(['option/wechat-site']);
            }


        }

        return $this->render('wechat',[
            'model'=>$model,
            'info' => $info,
            'names' => $names,
            'hasnames' => $hasnames,
        ]);
    }







}