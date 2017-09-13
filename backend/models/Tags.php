<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bdttags".
 *
 * @property int $id
 * @property string $name 标签名称
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdttags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 100],
            [['sortorder'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => '标签名称',
            'sortorder' => '标签排序',
        ];
    }
}
