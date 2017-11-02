<?php

namespace backend\models;

use Yii;
use backend\models\Members;

/**
 * This is the model class for table "bdtquestions".
 *
 * @property int $id
 * @property int $member_id 会员名称
 * @property int $expert_id 专家名称
 * @property string $question 问题
 * @property string $voice 语音问答
 * @property string $article 图文回答
 * @property int $status
 * @property string $askprice 问答价格
 * @property int $views 查看人数
 * @property string $continue_ask 继续追问
 * @property int $answer_type 回答类别
 * @property string $created 提问时间
 * @property string $asktime 回答时间
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtquestions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'expert_id', 'status', 'views', 'answer_type','typeid','circle_id','open','rec','themeid','haveread','voice_time','listorder','trade'], 'integer'],
            [['question', 'voice', 'article', 'continue_ask',], 'string'],
            [['askprice'], 'number'],
            [['created', 'asktime','article','asktime','imgs','answerimgs','from','publishtype'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'member_id' => '会员名称',
            'expert_id' => '专家名称',
            'question' => '问题',
            'voice' => '语音问答',
            'article' => '图文回答',
            'status' => '状态',
            'askprice' => '问答价格',
            'views' => '查看人数',
            'continue_ask' => '继续追问',
            'answer_type' => '回答类别',
            'created' => '提问时间',
            'asktime' => '回答时间',
            'rec' => '是否推荐',
            'listorder' => '排序',
            'voice_time' => '语音时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }
     public function getExpert()
    {
        return $this->hasOne(Members::className(), ['id' => 'expert_id']);
    }



}
