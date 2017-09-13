<?php

namespace backend\models;

use Yii;
use backend\models\AuthAssignment;
use yii\base\model;
use yii\db\Query;
use backend\models\TermModel;

class PageModel extends \yii\db\ActiveRecord
{
    const TABLE = 'page';
    public $_lastError = "";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return self::TABLE;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','pid'], 'required'],
            [['des', 'pid', 'content'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => '父栏目',
            'title' => '标题',
            'des' => '描述',
            'content' => '内容',
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
    public function del($id){
        $connection=Yii::$app->db;
        $transaction=$connection->beginTransaction();
        try
        {
            $connection->createCommand()->delete(self::TABLE, "id = $id ")->execute();
            $transaction->commit();
        }
        catch(Exception $ex)
        {
            $transaction->rollBack();
        }
    }
    public static function getAllCats($name)
    {
        $cat = ['0'=>'顶级栏目'];
        //以数组形式进行输出
        $res = TermModel::find()->asArray()->all();
        $pid = [];
        foreach ($res as $re) {
            $pid[$re['pid']] = $re['pid'];
        }

        if($res){
            foreach ($res as $k=>$list){
                if($list['model'] == $name && $list['pid'] !=0 && !in_array($list['id'],$pid) ){
                    $cat[$list['id']] = $list['text'];
                }
            }
        }

        return $cat;
    }




}
