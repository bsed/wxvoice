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
        <?= $form->field($model, $v)->dropDownList($members) ?>
        <?php elseif($v == 'expert_id'):?>
        <?= $form->field($model, $v)->dropDownList($experters) ?>
    <?php elseif($v == 'freetime'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
    <?php elseif($v == 'answer_type'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '语音回答', '1' => '图文回答']) ?>
    <?php elseif($v == 'continue_ask'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
    <?php elseif($v == 'status'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '未回答', '1' => '已回答', '2'=>'已失效', '3'=>'已撤销']) ?>
    <?php elseif($v == 'tags'):?>
        <?= $form->field($model, $v)->widget('common\widgets\tags\TagWidget') ?>
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