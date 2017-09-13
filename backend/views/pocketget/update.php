<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pocketget */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Pocketget',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pocketgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="pocketget-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
