<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '新增栏目';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr/>
            <div class="user-form">
                <?php $form = ActiveForm::begin(); ?>
                <?php if ($cat_id !=0) :?>
                <?php $model->pid = $cat_id; ?>
                <?php endif;?>
                <?= $form->field($model, 'pid')->dropDownList($data) ?>
                <?php if ($type !=0) :?>
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
                <?= $form->field($model, 'duotu')->widget(FileInput::classname(), [
                    'options' => [
                            'enctype'=>'multipart/form-data',
                            'accept' => 'image/*',
                            'multiple' => true,
                    ],
                    'pluginOptions' => [
                        'fileActionSettings' => [

                        ],

                    ]
                ]) ?>
                </div>
                <div style="clear:both"></div>

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
