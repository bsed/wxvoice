<?php

namespace backend\models;

use Yii;
use backend\models\Members;

/**
 * This is the model class for table "bdtpockets".
 *
 * @property int $id
 * @property int $member_id
 * @property int $give_type 发放类型
 * @property string $total_money 总金额
 * @property int $pocket_nums 红包个数
 * @property string $message 留言
 * @property int $pocket_type
 * @property string $created 创建时间
 */
class Pockets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtpockets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'give_type', 'pocket_nums', 'pocket_type','status'], 'integer'],
            [['total_money'], 'number'],
            [['message', 'created','trade'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'member_id' => 'member_id',
            'give_type' => '发放类型',
            'total_money' => '总金额',
            'pocket_nums' => '红包个数',
            'message' => '留言',
            'pocket_type' => 'pocket_type',
            'created' => '创建时间',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }


}
