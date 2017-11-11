<?php

/* @var $this \yii\web\View */
/* @var $content string */

// use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

// AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>综合管理系统</title>
    <meta name="keywords" content="综合管理系统">
    <meta name="description" content="综合管理系统">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico">

    <?=Html::cssFile('@web/css/bootstrap.min14ed.css')?>
    <?=Html::cssFile('@web/css/font-awesome.min93e3.css')?>
    <?=Html::cssFile('@web/css/animate.min.css')?>
    <?=Html::cssFile('@web/css/style.min862f.css')?>
    <?=Html::cssFile('@web/css/site.css')?>
    <?=Html::cssFile('@web/css/plugins/sweetalert/sweetalert.css')?>

    <?=Html::jsFile('@web/js/jquery.min.js')?>
    <?=Html::jsFile('@web/js/plugins/sweetalert/sweetalert.min.js')?>

    <?php $this->head() ?>
</head>
<body class="fixed-sidebar full-height-layout gray-bg">
<?php $this->beginBody() ?>
<?php if((Yii::$app->controller->module->defaultRoute!="site") ||(Yii::$app->controller->module->defaultRoute=="site" && Yii::$app->controller->module->requestedRoute!=""
        && Yii::$app->controller->module->requestedRoute!="site/login")):?>
    <nav class="breadcrumb fix_top hidden-sm hidden-xs" style="height: 35px;">
    </nav>
<?php endif;?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
