<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Listens */

$this->title = Yii::t('backend', 'Create Listens');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Listens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="listens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
