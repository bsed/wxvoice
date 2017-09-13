<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pocketget */

$this->title = Yii::t('backend', 'Create Pocketget');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pocketgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pocketget-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
