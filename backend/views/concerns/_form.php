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
    <?php elseif($v == 'concern_id'):?>
        <?= $form->field($model, $v)->dropDownList($members) ?>
    <?php elseif($v == 'to_concern_id'):?>
        <?= $form->field($model, $v)->dropDownList($experters) ?>
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