<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pocketcomment */

$this->title = Yii::t('backend', 'Create Pocketcomment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pocketcomments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pocketcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
