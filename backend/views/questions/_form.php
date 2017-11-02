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
        <?php elseif($v == 'question'):?>
        <?= $form->field($model, $v)->textArea(['rows' => '6']) ?>
    <?php elseif($v == 'member_id'):?>
        <?= $form->field($model, $v)->dropDownList($members) ?>
        <?php elseif($v == 'expert_id'):?>
        <?= $form->field($model, $v)->dropDownList($experters) ?>
    <?php elseif($v == 'circle_id'):?>
    <?php elseif($v == 'open'):?>
    <?php elseif($v == 'article'):?>
    <?php elseif($v == 'trade'):?>
    <?php elseif($v == 'themeid'):?>
    <?php elseif($v == 'asktime'):?>
    <?php elseif($v == 'typeid'):?>
    <?php elseif($v == 'haveread'):?>
    <?php elseif($v == 'imgs'):?>
    <?php elseif($v == 'answerimgs'):?>
    <?php elseif($v == 'from'):?>
    <?php elseif($v == 'publishtype'):?>
    <?php elseif($v == 'continue_ask'):?>
    <?php elseif($v == 'created'):?>
        <?= $form->field($model, $v)->textInput(['value' => date("Y-m-d H:i:s", $model['created'])]) ?>
    <?php elseif($v == 'answer_type'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '语音回答', '1' => '图文回答']) ?>
    <?php elseif($v == 'continue_ask'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>   
        <?php elseif($v == 'rec'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '否', '1' => '是']) ?>
    <?php elseif($v == 'status'):?>
        <?= $form->field($model, $v)->dropDownList(['0' => '未支付', '1' => '已支付', '2'=>'已回答']) ?>
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