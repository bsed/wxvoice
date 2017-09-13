<?php

namespace backend\models;

use Yii;
use backend\models\Members;

/**
 * This is the model class for table "bdtpocketget".
 *
 * @property int $id
 * @property int $pocket_id 所属红包
 * @property int $member_id 所属用户
 * @property string $get_price 领取金额
 * @property string $created 领取时间
 */
class Pocketget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtpocketget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pocket_id', 'member_id'], 'integer'],
            [['get_price'], 'number'],
            [['created'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'pocket_id' => '所属红包',
            'member_id' => '所属用户',
            'get_price' => '领取金额',
            'created' => '领取时间',
        ];
    }


    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }
}
