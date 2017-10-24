<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use common\widgets\tags;

?>
<?php $form = ActiveForm::begin(); ?>

<?php foreach($colums as $k=>$v):?>
    <?php if($v == 'des'):?>
        <?= $form->field($model, $v)->textArea(['rows' => '6']) ?>
    <?php elseif($v == 'member_id'):?>
        <?= $form->field($model, $v)->dropDownList($users) ?>
    <?php elseif($v == 'freetime'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
    <?php elseif($v == 'vip'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
    <?php elseif($v == 'continue_ask'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
    <?php elseif($v == 'open'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
    <?php elseif($v == 'tags'):?>
        <?= $form->field($model, $v)->widget('common\widgets\tags\TagWidget') ?>
    <?php else:?>
        <?= $form->field($model, $v)->textInput(['maxlength' => true]) ?>
    <?php endif;?>
<?php endforeach;?>





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