<?php

namespace mobile\models;

use Yii;
use mobile\models\Members;
use mobile\models\Circles;
use mobile\models\Circlemembers;

class Circlemembers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bdtcirclemembers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

        ];
    }
    public function getUser()
    {
        return $this->hasOne(Members::className(), ['id' => 'qid']);
    }
    public function getCircle()
    {
        return $this->hasOne(Circles::className(), ['id' => 'cid']);
    }
    public function getIncircle()
    {
        return $this->hasMany(Circlemembers::className(), ['id' => 'id']);
    }






}
