<?php

namespace backend\models;

use Yii;
use backend\models\Members;
use backend\models\Questions;

/**
 * This is the model class for table "bdtlistens".
 *
 * @property int $id
 * @property int $question_id 问题
 * @property int $member_id 收听人
 * @property string $created 收听时间
 */
class Listens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtlistens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'member_id'], 'integer'],
            [['created'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'question_id' => '问题',
            'member_id' => '收听人',
            'created' => '收听时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

}
