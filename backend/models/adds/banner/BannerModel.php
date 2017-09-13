<?php

namespace backend\models\adds\banner;

use backend\models\options\OptionsModel;
use Yii;
use backend\models\AuthAssignment;
use yii\base\model;
use yii\db\Query;

class BannerModel extends \yii\db\ActiveRecord
{
    public $_lastError = "";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['des', 'link', 'images', 'listorder', 'value'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'name' => '标题',
            'des' => '描述',
            'link' => '链接',
            'images' => '图片',
            'listorder' => '排序',
            'value' => '多图上传',
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
            $connection->createCommand()->delete("banner", "id = $id ")->execute();
            $transaction->commit();
        }
        catch(Exception $ex)
        {
            $transaction->rollBack();
        }
    }
    public function getAllCats()
    {

        //以数组形式进行输出
        $res = OptionsModel::find()->where(['type'=>'bannertype'])->asArray()->one();
        $value = json_decode($res['value'] ,true);

        if(isset($value['mingzi'])){
            $count = count($value['mingzi']) - 1;
        }else{
            $count = 0;
        }

        $mingzi[] = [];
        $text[] = [];
        for($i=0;$i<=$count;$i++){
            if(isset($value['mingzi'])){
             $mingzi[$i] = $value['mingzi'][$i];
             $text[$i] = $value['text'][$i];
            }else{
                $mingzi[] = [];
                $text[] = [];
            }
        }
        if(!empty($mingzi[0])){
            $fcat = ['0'=>'请选择类型'];
            $scat = array_combine($mingzi, $text);
            $new = array_merge($fcat,$scat);
        }else{
           $new =  ['0'=>'暂无类型可选'];
        }

        return $new;
    }




}
