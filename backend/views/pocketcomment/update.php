<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pocketcomment */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Pocketcomment',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pocketcomments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="pocketcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
