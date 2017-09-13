<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pockets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pockets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'give_type')->textInput() ?>

    <?= $form->field($model, 'total_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pocket_nums')->textInput() ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pocket_type')->textInput() ?>

    <?= $form->field($model, 'created')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
