<?php

namespace backend\models;

use Yii;
use backend\models\Wxpayrecord;
use backend\models\Experts;

class Members extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtmembers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickname', 'slogan', 'photo'], 'string'],
            [['sex', 'vip', 'isguanjia','disallowed'], 'integer'],
            [['nickname'], 'string', 'max' => 155],
            [['slogan'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => '昵称',
            'photo' => '头像',
            'account' => '账号',
            'sex' => '性别',
            'slogan' => '个性签名',
            'industry' => '行业',
            'areas' => '所属地区',
            'pwd' => ' 密码',
            'phone' => '电话',
            'vip' => '是否专家',
            'isguanjia' => '是否圈管',
            'tags' => '标签',
            'created' => '注册时间',
            'updated' => ' 修改时间',
            'disallowed' => ' 是否禁言',
        ];
    }

    public function getWxpayrecord()
    {
        return $this->hasMany(Wxpayrecord::className(), ['mid' => 'id']);
     }
     public function getExpert(){
        return $this->hasOne(Experts::className(),['member_id'=>'id']);
     }


}
