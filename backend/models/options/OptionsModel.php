<?php

namespace backend\models\options;

use Yii;
use backend\models\AuthAssignment;
use yii\base\model;
use yii\db\Query;

class OptionsModel extends \yii\db\ActiveRecord
{

    public $_lastError = "";
    public $title;
    public $keywords;
    public $description;
    public $logo;
    public $content;
    public $icp;
    public $shareImg;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }

    public function rules()
    {
        return [
            [['title','logo','keywords','description','icp','content'],'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '网站名称',
            'logo' => '徽标',
            'keywords' => '关键词',
            'description' => '描述',
            'icp' => '备案号',
            'content' => '统计代码',
            'ak' => 'Appid',
            'sk' => 'Secretkey',
            'hk' => '商户号',
            'hs' => '商户密钥',
        ];
    }

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
