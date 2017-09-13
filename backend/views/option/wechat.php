<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '微信设置';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h3><?= Html::encode($this->title) ?></h3>
            <hr/>

            <div class="user-form">
        <?php $form = ActiveForm::begin(); ?>

        <!-- 微信基本设置 -->
        <?= $form->field($model, 'appId')->textInput(['maxlength' => true, 'value'=>isset($info['appId'])?$info['appId']:'' ])->label('APPID') ?>
        <?= $form->field($model, 'secretKey')->textInput(['maxlength' => true, 'value'=>isset($info['secretKey'])?$info['secretKey']:'' ])->label('SecretKey') ?>
        <?= $form->field($model, 'merchantId')->textInput(['maxlength' => true, 'value'=>isset($info['merchantId'])?$info['merchantId']:'' ])->label('MerchantId') ?>
        <?= $form->field($model, 'merchantKey')->textInput(['maxlength' => true, 'value'=>isset($info['merchantKey'])?$info['merchantKey']:'' ]) ?>
        <!-- 微信分享设置 -->
        <br/>
        <h3>微信分享设置</h3><hr/>
        <?= $form->field($model, 'shareTitle')->textInput(['maxlength' => true, 'value'=>isset($info['shareTitle'])?$info['shareTitle']:'' ])->label('分享标题') ?>
        <?= $form->field($model, 'shareDesc')->textInput(['maxlength' => true, 'value'=>isset($info['shareDesc'])?$info['shareDesc']:'' ])->label('分享描述') ?>
        <?= $form->field($model, 'shareImg')->widget('common\widgets\file_upload\FileUpload',[
            'config'=>[
                'logo'=>$info['shareImg'],
            ]]) ?>
        <?= $form->field($model, 'shareJumpToUrl')->textInput(['maxlength' => true, 'value'=>isset($info['shareJumpToUrl'])?$info['shareJumpToUrl']:'' ])->label('分享URL') ?>


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
