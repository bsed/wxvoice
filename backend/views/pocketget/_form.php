<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pocketget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pocketget-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pocket_id')->textInput() ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'get_price')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, $v)->textInput(['value' => date("Y-m-d H:i:s", $model['created'])]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
