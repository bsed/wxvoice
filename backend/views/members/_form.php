<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use common\widgets\tags;

?>
<?php $form = ActiveForm::begin(); ?>
<?php foreach($colums as $k=>$v):?>
    <?php if($v == 'photo'):?>
        <?= $form->field($model, $v)->widget('common\widgets\single_uploader\FileUpload') ?>
    <?php elseif($v == 'sex'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '女', '1' => '男']) ?>
    <?php elseif($v == 'vip'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
        <?php elseif($v == 'isguanjia'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
        <?php elseif($v == 'disallowed'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
        <?php elseif($v == 'tags'):?>
        <?php elseif($v == 'pwd'):?>
        <?php elseif($v == 'industry'):?>
        <?php elseif($v == 'areas'):?>
        <?php elseif($v == 'account'):?>
        <?php elseif($v == 'created'):?>
        <?php elseif($v == 'updated'):?>
        <?php elseif($v == 'slogan'):?>
        <?= $form->field($model, $v)->textarea(['maxlength' => true]) ?>
    <?php else:?>
        <?= $form->field($model, $v)->textInput(['maxlength' => true]) ?>
    <?php endif;?>
<?php endforeach;?>




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