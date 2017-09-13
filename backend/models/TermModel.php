<?php

namespace backend\models;

use Yii;
use backend\models\AuthAssignment;
use yii\base\model;
use yii\db\Query;

class TermModel extends \yii\db\ActiveRecord
{
    public $file;
    public static function tableName()
    {
        return 'term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid','text', 'model'], 'required'],
            [['label_img','content','duotu', 'id'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => '栏目名',
            'pid' => '父栏目',
            'model' => '模型类别',
            'label_img' => '封面图',
            'content' => '栏目介绍',
            'duotu' => '多图上传',
        ];
    }
    public function create()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $model = new TermModel();
            $model->setAttributes($this->attributes);
            if(!$model->save()){
                throw new \Exception('文章保存失败');
            }
            $transaction->commit();
            return true;
        }catch(\Exception $e){
            $transaction->rollBack();
            $this->_lastError = $e->getMessage();
            return false;
        }

    }
    public function getList()
    {
        $items = self::find()->asArray()->all();
        return $items;
    }
    public static function getAllCats()
    {
        $cat = ['0'=>'顶级栏目'];
        //以数组形式进行输出
        $res = self::find()->asArray()->all();
        if($res){
            foreach ($res as $k=>$list){
                $cat[$list['id']] = $list['text'];
            }
        }

        return $cat;
    }
    public  function getPid($id)
    {
        $res = self::find()->where(['id' => $id])->one();
        return $res['pid'];
    }















}