<?php

namespace backend\models;

use Yii;
use backend\models\Members;

/**
 * This is the model class for table "bdtexperts".
 *
 * @property int $id
 * @property int $member_id 会员
 * @property string $honor 头衔
 * @property string $tags 领域标签
 * @property string $des 简介
 * @property string $price 提问价格
 * @property int $continue_ask 继续追问
 * @property int $freetime 免费规则
 * @property int $open 开放计划
 * @property string $card 名片
 * @property string $created 创建时间
 * @property string $updated 更新时间
 */
class Experts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtexperts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id','open', 'vip','rec','listorder','type'], 'integer'],
            [['price'], 'number'],
            [['honor', 'des', 'card'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'member_id' => '会员',
            'honor' => '头衔',
            'des' => '简介',
            'price' => '提问价格',
            'open' => '开放计划',
            'card' => '名片',
            'type' => '类别',
            'rec' => '是否推荐',
            'listorder' => '排序',
            'vip' => '是否专家',
            'created' => '创建时间'
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }
}
