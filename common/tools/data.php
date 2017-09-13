<?php

/**
 * Created by PhpStorm.
 * User: yanli
 * Date: 2017/2/26
 * Time: 14:41
 */
namespace  common\tools;

use backend\models\Members;
use Yii;
use yii\data\Pagination;


class data
{
    public static function getUserInfo($member_id)
    {

        $info = Members::find()->where(['id'=>$member_id])->asArray()->one();
        return $info;
    }

}