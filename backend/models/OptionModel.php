<?php

namespace backend\models;

use Yii;
use backend\models\AuthAssignment;
use yii\base\model;
use yii\db\Query;

class OptionModel extends \yii\db\ActiveRecord
{

    public $_lastError = "";
    // 自定义字段

    //自定义字段 END
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '模型',
        ];
    }

    //新增
    public  function toSave(){
        $post = Yii::$app->request->post();
        if(empty($post['type'])){
            $value = json_encode([]);
        }else{
            $smallname = strtolower($post['modeltype']);
            $value = json_encode([$post['type'],'name'=>$post['modeltype'],'sname'=>$smallname]);
        }
        $this->name = $post['modeltype'];
        $this->value = $value;
        $this->save();
        return true;
    }
    public function toDel()
    {
        $id = Yii::$app->request->get('id');
        $connection=Yii::$app->db;
        $transaction=$connection->beginTransaction();
        try
        {
            $connection->createCommand()->delete("models", "id = '$id'")->execute();
            $transaction->commit();
            return true;
        }
        catch(Exception $ex)
        {
            $transaction->rollBack();
            return false;
        }
    }








}
