<?php

namespace backend\models;

use Yii;
use backend\models\Members;


class Circles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtcircles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id','feetype','status'], 'integer'],
            [['joinprice'], 'number'],
            [['name', 'logo', 'des'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => '圈子名称',
            'member_id' => '会员',
            'feetype' => '类型',
            'logo' => '圈子头像',
            'des' => '简介',
            'joinprice' => '圈子价格',
            'status' => '状态',
            'created' => '创建时间'
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }
}
