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
    <?php elseif($v == 'created'):?>
        <div class="form-group field-optionsmodel-logo">
            <label class="control-label" for="optionsmodel-logo">认证时间</label>
            <input type="text" id="experts-created" class="form-control"  value="<?=date('Y-m-d',$model['created']);?>" maxlength="100" aria-invalid="false">
        </div>

     <?php elseif($v == 'card'):?>
        <div class="form-group field-optionsmodel-logo">
            <label class="control-label" for="optionsmodel-logo">认证资料</label>
            <div class="per_upload_con">
                <div class="per_real_img logo">
                    <img src="<?=Yii::$app->params['public'];?>/attachment/<?=$model['card']?>" style="width:500px;height:300px;">
                </div>
            </div>
        </div>
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