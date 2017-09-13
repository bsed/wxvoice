<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pockets */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Pockets',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pockets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="pockets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
