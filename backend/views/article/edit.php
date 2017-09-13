<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '新增文章';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h3><?= Html::encode($this->title) ?></h3>
            <hr/>
            <div class="user-form">
                <?php $form = ActiveForm::begin(); ?>
                <?php $model->pid = $model['pid']; ?>
                <?= $form->field($model, 'pid')->dropDownList($data) ?>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'des')->textArea(['rows' => '6']) ?>
                <?= $form->field($model, 'cover')->widget('common\widgets\single_uploader\FileUpload') ?>
                <?= $form->field($model, 'listorder')->textInput(['maxlength' => true, 'value'=>0]) ?>
                <?= $form->field($model, 'hits')->textInput(['maxlength' => true, 'value'=>0]) ?>
                <?= $form->field($model, 'ctime')->textInput(['value'=>date('Y-m-d H:i:s',$model['ctime'])]) ?>
                <?php $model->rec = $model['rec'] ?>
                <?= $form->field($model, 'rec')->radioList(['0'=>'否','1'=>'是']); ?>
                <?php $model->stick = $model['stick']?>
                <?= $form->field($model, 'stick')->radioList(['0'=>'否','1'=>'是']); ?>
                <?php $model->status = $model['status']?>
                <?= $form->field($model, 'status')->radioList(['0'=>'否','1'=>'是']); ?>
                <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
                    'options'=>[
                        'initialFrameWidth' => 800,
                        'initialFrameHeight' => 300,
                    ]
                ]) ?>
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
