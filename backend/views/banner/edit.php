<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查看碎片';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr/>
            <div class="user-form">
                <?php $form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data"]]); ?>
                <?php if ($type) :?>
                    <?php $model->type = $type; ?>
                <?php endif;?>
                <?= $form->field($model, 'type')->dropDownList($data) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'des')->textArea(['rows' => '6']) ?>
                <?= $form->field($model, 'images')->widget('common\widgets\file_upload\FileUpload',[
                    'config'=>[
                        'imgUrl'=>$model['images'],
                    ]
                ]) ?>

                <!-- 消除浮动-->
                <div style="clear:both"></div>
                <!-- 消除浮动 END-->
                <!-- 预览-->
                <?php if($value):?>
                    <?php foreach($value as $v):?>
                        <div class="file-preview-frame kv-preview-thumb"  >
                            <label class="control-label" for="termmodel-value">已上传图片</label>
                            <div class="kv-file-content">
                                <img src="<?=constant('aurl');?><?=$v?>" style="width:auto;height:160px;">
                            </div><div class="file-thumbnail-footer">
                                <div class="file-footer-caption" title="0.jpg">0.jpg <br><samp>(32.17 KB)</samp></div>
                                <div class="file-actions">
                                    <div class="file-footer-buttons">
                                        <button type="button" class="kv-file-zoom btn btn-xs btn-default" title="删除">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
                <!-- 多图上传 END-->
                <?= $form->field($model, 'listorder')->textInput(['maxlength' => true, 'value'=>0]) ?>

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
