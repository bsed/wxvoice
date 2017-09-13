<?php

namespace backend\models;

use Yii;
use backend\models\Members;

/**
 * This is the model class for table "bdtpocketcomment".
 *
 * @property int $id
 * @property int $pocket_id 所属红包
 * @property string $comment 评论
 * @property int $pocket_zan
 * @property string $created 创建时间
 */
class Pocketcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtpocketcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pocket_id', 'member_id'], 'integer'],
            [['comment', 'created'], 'string', 'max' => 255],
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
            'comment' => '评论',
            'member_id' => '会员',
            'created' => '创建时间',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }



}
