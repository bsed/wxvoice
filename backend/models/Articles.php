<?php

namespace backend\models;

use Yii;
use backend\models\Members;

/**
 * This is the model class for table "bdtarticles".
 *
 * @property int $id
 * @property int $member_id 用户
 * @property string $title 标题
 * @property string $content 分享内容
 * @property string $imgs 照片
 * @property string $voice 语音
 * @property string $video 视频
 * @property string $created 创建时间
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtarticles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'title'], 'required'],
            [['member_id','circle_id','counts','dianzan','type','themeid','voice_time','redid','rec','listorder'], 'integer'],
            [['content', 'pics', 'summary','from','publishtype'], 'string'],
            [['title', 'created'], 'string', 'max' => 100],
            [['voices', 'videos'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'member_id' => '用户',
            'title' => '标题',
            'summary' => '摘要',
            'counts' => '阅读数',
            'content' => '分享内容',
            'imgs' => '照片',
            'voices' => '语音',
            'videos' => '视频',
            'dianzan' => '点赞数',
            'voice_time' => '语音时长',
            'listorder' => '排序',
            'rec' => '是否推荐',
            'created' => '创建时间',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }

}
