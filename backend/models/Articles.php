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
            [['member_id'], 'integer'],
            [['content', 'imgs', 'summary'], 'string'],
            [['title', 'created'], 'string', 'max' => 100],
            [['voice', 'video'], 'string', 'max' => 255],
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
            'counts' => '阅读数'
            'content' => '分享内容',
            'imgs' => '照片',
            'voice' => '语音',
            'video' => '视频',
            'created' => '创建时间',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }

}
