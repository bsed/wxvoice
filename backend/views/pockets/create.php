<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pockets */

$this->title = Yii::t('backend', 'Create Pockets');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pockets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pockets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
