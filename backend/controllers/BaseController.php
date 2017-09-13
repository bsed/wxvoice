<?php

namespace backend\controllers;

use Yii;
use backend\models\Members;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

class BaseController extends Controller
{

    public function colums($table)
    {

        $colums=[];
        $sql ="SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$table'";
        $res = Yii::$app->getDb()->createCommand($sql)->query();
        foreach ($res as $column){
            if($column['COLUMN_NAME'] !='id'){
                $colums[]= $column['COLUMN_NAME'];
            }
        }
        return $colums;
    }


    public function getUsers(){
        $info = Members::find()->asArray()->all();
        $users = [];
        foreach($info as $k=>$v){
            $users[$v['id']] = $v['nickname'];
        }
        return $users;

    }

    public function getExperts(){
        $info = Members::find()->asArray()->where(['vip'=>1])->all();
        $users = [];
        foreach($info as $k=>$v){
            $users[$v['id']] = $v['nickname'];
        }
        return $users;

    }
    public function getMembers(){
        $info = Members::find()->asArray()->where(['vip'=>0])->all();
        $users = [];
        foreach($info as $k=>$v){
            $users[$v['id']] = $v['nickname'];
        }
        return $users;

    }



}