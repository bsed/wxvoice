<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '标签列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h3><?= Html::encode($this->title) ?></h3>
            <a href="<?=Url::toRoute(['tixian/index'])?>" style="float: right;" class="btn btn-primary btn-xs">标签列表</a>
            <br/>
            <div class="user-form">
                <?=$this->render('_form',['colums'=>$colums, 'model'=>$model])?>
            </div>
        </div>
    </div>
</div>
