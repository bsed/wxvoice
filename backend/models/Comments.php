<?php

namespace backend\models;

use Yii;
use backend\models\Members;


class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtcomments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id','to_member_id','article_id'], 'integer'],
            [['content', 'voice', 'voice_time', 'pics'], 'string'],
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
            'to_member_id' => '被评论者',
            'article_id' => '被评论主题',
            'content' => '评论的内容',
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
