<?php
/**
 * Created by PhpStorm.
 * User: yanli
 * Date: 2017/1/20
 * Time: 12:33
 */
namespace backend\controllers;


use Yii;
use yii\base\Model;
use yii\web\Controller;
use backend\models\TermModel;
use yii\helpers\Url;

class TermController extends Controller{
    public function actions()
    {
        return [

            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "../../attachment/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],

            'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                    'imagePathFormat' => "", /* 上传保存路径,可以自定义保存路径和文件名格式 */
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
        $model = new TermModel();
        $arr = $model->getList();
        $items = [];
        foreach($arr as $k=>$v){
            $items[$v['id']]= $v;
            $items[$v['id']]['tags']= array('0'=>$v['id']);
        }


        $data = $this->generateTree($items);
        $json = json_encode($data);
        return $this->render('list',['json'=>$json]);
    }
    public function actionAdd()
    {
        $model = new TermModel();
         // 获取所有分类
        $data = $model::getAllCats();
        //获取当前分类的id,用于确定上级栏目，如果没有则为顶级栏目
        $cat_id = intval(Yii::$app->request->get('id'));
        //通过上一级添加的栏目，自带模型属性，且不能修改，只能先修改上一级的类别。
        $pid = $model->getPid($cat_id);

        $type = $model::find()->asArray()->where(['pid'=>$pid])->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if( !$model->create() ){
                Yii::$app->session->setFlash('warning',$model->_lastError);
            }else{
                return $this->redirect(['term/list']);
            }

        }
        $ModelType = [
             '0'=>'请选择模型',
             'article'=>'文章模型',
             'page'=>'单页模型',
             'others'=>'其他',
        ];
        return $this->render('add',
            [
                'model'=>$model,
                'data'=>$data,
                'cat_id'=>$cat_id,
                'model_type' =>$ModelType,
                'type' => $type,
            ]
        );
    }
    public function actionEdit()
    {

        $id = intval(Yii::$app->request->get('id'));
        //如果只使用new TermModel() 则会是新增，这里需要更新
        $model = TermModel::findOne($id);
        $pid = $model->getPid($id);
        $data = $model->getAllCats();

        $info = $model::find()->where(['id' => $id])->one();
        $duotu = json_decode($info['duotu'], true);

        //通过上一级添加的栏目，自带模型属性，且不能修改，只能先修改上一级的类别。
        $type = $model::find()->asArray()->where(['id'=>$id])->one();
        $ModelType = [
            'none'=>'请选择模型',
            'article'=>'文章模型',
            'page'=>'单页模型',
        ];
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            //同步上传
            $new_name = [];
            $count = count($_FILES['TermModel']['name']['duotu']);
            $empty = $_FILES['TermModel']['name']['duotu'][0];
            if($empty){
               foreach($duotu as $v){
                   if(file_exists($v)){
                       unlink($v);
                   }

               }
            }
            $time = date('Ymd');
            $dirName = '../../attachment/image/'.$time;
            if(!is_dir($dirName)){
                mkdir($dirName,0777,1);
            }
            for($i=0;$i <= $count-1; $i++){
                    if(is_uploaded_file($_FILES['TermModel']['tmp_name']['duotu'][$i])){
                            $extf = pathinfo($_FILES['TermModel']['name']['duotu'][$i], PATHINFO_EXTENSION);
                            $name = date('YmdHisHm',time()).'_'.mt_rand(710,9300).'.'.$extf;
                            if(!move_uploaded_file($_FILES['TermModel']['tmp_name']['duotu'][$i],$dirName.'/'.$name)){
                                echo 'alert("上传文件失败");history.go(-1);';
                                exit();
                            }
                            $new_name[] = '/image/'.$time.'/'.$name;
                        }

            }

            $save_name = json_encode($new_name);
            //同步上传END



            $post = Yii::$app->request->post();
            if($empty) {
                $model->duotu = $save_name;
            }else{
                $model->duotu = $info['duotu'];
            }
            $model->model = $post["TermModel"]['model'];
            $model->save($post);
            return $this->redirect(['term/edit&id='.$id]);
        }



        return $this->render('edit',
            [
                'model'=>$info,
                'data'=>$data,
                'pid'=>$pid,
                'duotu'=>$duotu,
                'type' => $type,
                'model_type' =>$ModelType,
            ]
        );

    }

   public function actionDel()
   {

       $id = Yii::$app->request->post('id');
       $toDel = TermModel::find()->where(['pid' => $id])->one();
       if($toDel){
           die(json_encode(['status'=>1]));
       }
       $connection=Yii::$app->db;
       $transaction=$connection->beginTransaction();
       try
       {
           $connection->createCommand()->delete("term", "id = '$id'")->execute();
           $transaction->commit();
       }
       catch(Exception $ex)
       {
           $transaction->rollBack();
       }
       die(json_encode(['status'=>2]));
   }



    function generateTree($items){
        $tree = array();
        foreach($items as $item){
            if(isset($items[$item['pid']])){
                $items[$item['pid']]['nodes'][] = &$items[$item['id']];
            }else{
                $tree[] = &$items[$item['id']];
            }
        }
        return $tree;
    }



}