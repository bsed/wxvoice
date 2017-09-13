<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '更新栏目';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet"
<script src="js/jquery.min.js?v=2.1.4"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr/>
            <div class="user-form">
                <?php $form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data"]]); ?>
                <?php if ($pid !=0) :?>
                    <?php $model->pid = $pid; ?>
                <?php endif;?>
                <?= $form->field($model, 'pid')->dropDownList($data) ?>
                <?php if ($type !="0") :?>
                    <?php $model->model = $type; ?>
                <?php endif;?>
                <?= $form->field($model, 'model')->dropDownList($model_type) ?>
                <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
                    'config'=>[
                    ]
                ]) ?>
                <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
                    'options'=>[
                        'initialFrameWidth' => 800,
                    ]
                ]) ?>


                <!-- 多图上传-->
                <div class="col-sm-9">
                    <?= $form->field($model, 'duotu[]')->widget(FileInput::classname(), [
                        'options' => [
                            'enctype'=>'multipart/form-data',
                            'accept' => 'image/*',
                            'multiple' => true,
                             ]

                    ]) ?>
                </div>

                <!-- 消除浮动-->
                <div style="clear:both"></div>
                <!-- 消除浮动 END-->
                <!-- 预览-->
                <?php if($duotu):?>
                <?php foreach($duotu as $v):?>
                <div class="file-preview-frame kv-preview-thumb"  >
                    <label class="control-label" for="termmodel-duotu">已上传图片</label>
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


                <!-- 消除浮动-->
                <div style="clear:both"></div>
                <!-- 消除浮动 END-->
                <!--自定义字段-->
                <?php if(!empty($names)):?>
                    <?php foreach ($names as $key=>$ziduan): ?>
                        <?php if(!empty($ziduan['text'])):?>
                            <?php foreach ($ziduan['text'] as $k=>$z): ?>
                                <div class="form-group ">
                                    <label class="control-label" for="shouyinmodel-gamefee"><?=$ziduan['mingzi'][$k]?></label>
                                    <input type="text" id="<?=$names[2]?>-<?=$z?>" class="form-control" name="type[<?=$z?>]">
                                    <div class="help-block"></div>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif;?>
                <!--自定义字段 END-->
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
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

