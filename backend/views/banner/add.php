<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '新增碎片';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr/>
            <div class="user-form">
                <?php $form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data"]]); ?>
                <?= $form->field($model, 'type')->dropDownList($data) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'des')->textArea(['rows' => '6']) ?>
                <?= $form->field($model, 'logo')->widget('common\widgets\file_upload\FileUpload',[
                    'config'=>[
                        'logo'=>'',
                    ]
                ]) ?>
                <div style="clear:both"></div>
                <?= $form->field($model, 'listorder')->textInput(['maxlength' => true, 'value'=>0]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '确定' : '更新', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                </div>
                <?php
                if( Yii::$app->getSession()->hasFlash('error') ) {
                    echo Alert::widget([
                        'options' => [
                            'class' => 'alert alert-danger',
                        ],
                        'body' => Yii::$app->getSession()->getFlash('error'),
                    ]);
                }
                ?>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
