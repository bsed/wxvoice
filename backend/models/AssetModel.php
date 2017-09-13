<?php

namespace backend\models;

use Yii;
use backend\models\AuthAssignment;
use yii\base\model;
use yii\db\Query;

class AssetModel extends \yii\db\ActiveRecord
{
    public $_lastError = "";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'jingshouren'], 'required'],
            [['message', 'time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'time' => '日期',
            'jingshouren' => '经手人',
            'message' => '日常支出备注',
        ];
    }

    //创建数据
   public function create()
   {
       //事务
       $transaction = Yii::$app->db->beginTransaction();
       try{
           $this->setAttributes($this->attributes);
           if(!$this->save()){
               throw new \Exception('保存失败');
           }
           $transaction->commit();
           return true;
       }catch(\Exception $e){
           $transaction->rollBack();
           $this->_lastError = $e->getMessage();
           return false;
       }
   }






}
