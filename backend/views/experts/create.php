<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查看会员';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h3><?= Html::encode($this->title) ?></h3>
            <hr/>
            <div class="user-form">
                <?=$this->render('_form',['colums'=>$colums, 'model'=>$model, 'users'=>$users])?>
            </div>
        </div>
    </div>
</div>
