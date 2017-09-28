<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '网站设置';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content">
    <div class="user-create">
        <div class="ibox-content">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr/>

            <div class="user-form">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'value'=>isset($info['title'])?$info['title']:'']) ?>
                <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'value'=>isset($info['keywords'])?$info['keywords']:''])?>
                <?= $form->field($model, 'description')->textArea(['rows' => '3', 'value'=>isset($info['description'])?$info['description']:'']) ?>
                <?= $form->field($model, 'icp')->textInput(['maxlength' => true, 'value'=>isset($info['icp'])?$info['icp']:'']) ?>
                <!--关于我们-->
                <?= $form->field($model, 'aboutus')->widget('common\widgets\ueditor\Ueditor',[
                    'options'=>[
                        'initialFrameWidth' => 800,
                        'initialFrameHeight' => 300,
                        'initialContent' => isset($info['aboutus'])?$info['aboutus']:'',
                    ]
                ]) ?>
                <!--关于我们END-->
                <!--管理协议-->
                <?= $form->field($model, 'guanli')->widget('common\widgets\ueditor\Ueditor',[
                    'options'=>[
                        'initialFrameWidth' => 800,
                        'initialFrameHeight' => 300,
                        'initialContent' => isset($info['guanli'])?$info['guanli']:'',
                    ]
                ]) ?>
                <?= $form->field($model, 'guize')->widget('common\widgets\ueditor\Ueditor',[
                    'options'=>[
                        'initialFrameWidth' => 800,
                        'initialFrameHeight' => 300,
                        'initialContent' => isset($info['guize'])?$info['guize']:'',
                    ]
                ]) ?>

                <!--管理协议END-->
                <!--自定义字段-->
                <?php if(!empty($names)):?>
                    <?php foreach ($names as $key=>$ziduan): ?>
                        <?php if(!empty($ziduan['text'])):?>
                            <?php foreach ($ziduan['text'] as $k=>$z): ?>
                                <div class="form-group ">
                                    <label class="control-label" for="shouyinmodel-gamefee"><?=$ziduan['mingzi'][$k]?></label>
                                    <input type="text" id="<?=$names[2]?>-<?=$z?>" class="form-control" name="type[<?=$z?>]"
                                        <?php if(!empty($hasnames[$z])):?> value="<?=$hasnames[$z]?>"<?php endif;?>
                                    >
                                    <div class="help-block"></div>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif;?>
                <!--自定义字段 END-->
                <?= $form->field($model, 'logo')->widget('common\widgets\file_upload\FileUpload',[
                    'config'=>[
                        'logo'=>$info['logo'],
                    ]
                ]) ?>
                <?= $form->field($model, 'content')->textArea(['rows' => '6', 'value'=>$info['content']]) ?>



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
