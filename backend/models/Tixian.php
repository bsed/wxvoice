<?php

namespace backend\models;

use Yii;
use mobile\models\Members;
use mobile\models\Dianzan;
use mobile\models\Comments;

class Tixian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdttixian';
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
            'mid' => '用户名',
            'price' => '金额',
            'openid' => '用户识别码',
            'status' => '打款状态',
            'created' => '申请时间',
            'updated' => '打款时间',
        ];
    }


    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'mid']);
    }



}
