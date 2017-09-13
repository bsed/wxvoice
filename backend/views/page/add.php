<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '新增文章';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr/>
            <div class="user-form">
                <?php $form = ActiveForm::begin(); ?>
                <?php if ($cat_id !=0) :?>
                    <?php $model->pid = $cat_id; ?>
                <?php endif;?>
                <?= $form->field($model, 'pid')->dropDownList($data) ?>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'des')->textArea(['rows' => '6']) ?>
                <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
                    'options'=>[
                        'initialFrameWidth' => 800,
                        'initialFrameHeight' => 300,
                    ]
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
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
