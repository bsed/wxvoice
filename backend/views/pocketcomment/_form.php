<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pocketcomment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pocketcomment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pocket_id')->textInput() ?>

    <?= $form->field($model, 'coment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pocket_zan')->textInput() ?>

    <?= $form->field($model, 'created')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
